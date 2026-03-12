<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->format('Y-m-d');
        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
        $startOfMonth = now()->startOfMonth()->format('Y-m-d');
        $startOfYear = now()->startOfYear()->format('Y-m-d');

        // Helper function for calculation
        $calculateProfit = function ($startDate, $endDate = null) {
            $endDate = $endDate ?? now()->format('Y-m-d');
            
            $pemasukan = \App\Models\Finance::where('type', 'pemasukan')
                ->whereBetween('date', [$startDate, $endDate])
                ->sum('amount');
                
            $pengeluaran = \App\Models\Finance::where('type', 'pengeluaran')
                ->whereBetween('date', [$startDate, $endDate])
                ->sum('amount');
                
            return $pemasukan - $pengeluaran;
        };

        $profitToday = $calculateProfit($today, $today);
        $profitWeek = $calculateProfit($startOfWeek);
        $profitMonth = $calculateProfit($startOfMonth);
        $profitYear = $calculateProfit($startOfYear);

        $query = \App\Models\Finance::query()->orderBy('date', 'desc')->orderBy('created_at', 'desc');
        
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
            $profitFiltered = $calculateProfit($request->start_date, $request->end_date);
        } elseif ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
            $profitFiltered = $calculateProfit($request->start_date, now()->format('Y-m-d')); // Calculate up to today by default
        } elseif ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
            // We use a very early date as a fallback if only end date is provided
            $profitFiltered = $calculateProfit('2000-01-01', $request->end_date); 
        } else {
            $profitFiltered = null; // No filter active
        }

        $finances = $query->paginate(15)->withQueryString();

        return view('admin.finance.index', compact(
            'profitToday', 'profitWeek', 'profitMonth', 'profitYear', 'profitFiltered', 'finances'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'date' => 'required|date',
        ]);

        \App\Models\Finance::create($validated);

        return redirect()->route('admin.finance.index')->with('success', 'Catatan keuangan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $finance = \App\Models\Finance::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'date' => 'required|date',
        ]);

        $finance->update($validated);

        return redirect()->route('admin.finance.index')->with('success', 'Catatan keuangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $finance = \App\Models\Finance::findOrFail($id);
        $finance->delete();

        return redirect()->route('admin.finance.index')->with('success', 'Catatan keuangan berhasil dihapus.');
    }
}
