<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categoryId = $request->query('category');
        
        $query = Product::with(['images', 'variants', 'categoryData']);

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->latest()->paginate(10);
        $products->appends(['search' => $search, 'category' => $categoryId]);
        
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories', 'search', 'categoryId'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        // Sanitize prices (remove dots from IDR format)
        if ($request->has('price')) {
            $request->merge(['price' => str_replace('.', '', $request->price)]);
        }
        if ($request->has('variants')) {
            $variants = $request->variants;
            foreach ($variants as $key => $variant) {
                if (isset($variant['price'])) $variants[$key]['price'] = str_replace('.', '', $variant['price']);
                if (isset($variant['discount_price'])) $variants[$key]['discount_price'] = str_replace('.', '', $variant['discount_price']);
                if (isset($variant['purchase_price'])) $variants[$key]['purchase_price'] = str_replace('.', '', $variant['purchase_price']);
            }
            $request->merge(['variants' => $variants]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'color' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'variants' => 'required|array|min:1',
            'variants.*.size' => 'required|string|max:255',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.discount_price' => 'nullable|numeric|min:0',
            'variants.*.purchase_price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($validated);

        if ($request->has('variants')) {
            foreach ($request->variants as $variantData) {
                $product->variants()->create([
                    'size' => $variantData['size'],
                    'price' => $variantData['price'],
                    'discount_price' => $variantData['discount_price'] ?? null,
                    'purchase_price' => $variantData['purchase_price'],
                    'stock' => $variantData['stock']
                ]);
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        // Sanitize prices (remove dots from IDR format)
        if ($request->has('price')) {
            $request->merge(['price' => str_replace('.', '', $request->price)]);
        }
        if ($request->has('variants')) {
            $variants = $request->variants;
            foreach ($variants as $key => $variant) {
                if (isset($variant['price'])) $variants[$key]['price'] = str_replace('.', '', $variant['price']);
                if (isset($variant['discount_price'])) $variants[$key]['discount_price'] = str_replace('.', '', $variant['discount_price']);
                if (isset($variant['purchase_price'])) $variants[$key]['purchase_price'] = str_replace('.', '', $variant['purchase_price']);
            }
            $request->merge(['variants' => $variants]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'color' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'remove_images' => 'nullable|array',
            'variants' => 'required|array|min:1',
            'variants.*.id' => 'nullable|exists:product_variants,id',
            'variants.*.size' => 'required|string|max:255',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.discount_price' => 'nullable|numeric|min:0',
            'variants.*.purchase_price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        // Sync Variants
        if ($request->has('variants')) {
            $submittedVariantIds = [];
            foreach ($request->variants as $variantData) {
                if (isset($variantData['id']) && $variantData['id']) {
                    // Update existing variant
                    $variant = ProductVariant::find($variantData['id']);
                    if ($variant && $variant->product_id == $product->id) {
                        $variant->update([
                            'size' => $variantData['size'],
                            'price' => $variantData['price'],
                            'discount_price' => $variantData['discount_price'] ?? null,
                            'purchase_price' => $variantData['purchase_price'],
                            'stock' => $variantData['stock']
                        ]);
                        $submittedVariantIds[] = $variant->id;
                    }
                } else {
                    // Create new variant
                    $newVariant = $product->variants()->create([
                        'size' => $variantData['size'],
                        'price' => $variantData['price'],
                        'discount_price' => $variantData['discount_price'] ?? null,
                        'purchase_price' => $variantData['purchase_price'],
                        'stock' => $variantData['stock']
                    ]);
                    $submittedVariantIds[] = $newVariant->id;
                }
            }
            // Delete variants that were removed from the form
            $product->variants()->whereNotIn('id', $submittedVariantIds)->delete();
        }

        // Handle image removal
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageId) {
                $image = ProductImage::find($imageId);
                if ($image && $image->product_id === $product->id) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        // Delete all images from storage
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
