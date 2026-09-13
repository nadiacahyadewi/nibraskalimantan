<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
   <!-- Halaman Utama -->
   <url>
      <loc>{{ url('/') }}</loc>
      <lastmod>{{ now()->toAtomString() }}</lastmod>
      <changefreq>daily</changefreq>
      <priority>1.0</priority>
   </url>
   
   <!-- Halaman Produk -->
   <url>
      <loc>{{ url('/produk') }}</loc>
      <lastmod>{{ now()->toAtomString() }}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
   </url>

   <!-- Halaman Tentang Kami -->
   <url>
      <loc>{{ url('/tentang') }}</loc>
      <lastmod>{{ now()->toAtomString() }}</lastmod>
      <changefreq>monthly</changefreq>
      <priority>0.5</priority>
   </url>

   <!-- Dynamic Products -->
   @foreach ($products as $product)
       <url>
           <loc>{{ route('product.show', $product->id) }}</loc>
           <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
           <changefreq>weekly</changefreq>
           <priority>0.8</priority>
           @if($product->images && $product->images->count() > 0)
               @foreach($product->images as $image)
                   <image:image>
                       <image:loc>{{ asset($image->url) }}</image:loc>
                       <image:title>{{ $product->name }}</image:title>
                   </image:image>
               @endforeach
           @endif
       </url>
   @endforeach

   <!-- Dynamic Categories -->
   @foreach ($categories as $category)
       <url>
           <loc>{{ url('/produk?category_id=' . $category->id) }}</loc>
           <changefreq>weekly</changefreq>
           <priority>0.7</priority>
       </url>
   @endforeach

   <!-- Dynamic Brands -->
   @foreach ($brands as $brand)
       <url>
           <loc>{{ url('/produk?brand_id=' . $brand->id) }}</loc>
           <changefreq>weekly</changefreq>
           <priority>0.7</priority>
       </url>
   @endforeach
</urlset>
