<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AutoCompleteOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:complete-auto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically complete orders that have been in "Dikirim" status for more than 20 days.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = 20;
        $cutoff = now()->subDays($days);

        $orders = \App\Models\Order::where('status', 'Dikirim')
            ->where('shipped_at', '<=', $cutoff)
            ->get();

        $count = $orders->count();
        
        foreach ($orders as $order) {
            $order->update([
                'status' => 'Selesai',
                'completed_at' => now()
            ]);
        }

        $this->info("Successfully completed {$count} orders.");
    }
}
