<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use App\Models\Transaction;

class UpdateTransactionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-transaction-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix Transaction Realtime';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ambil transaksi yang pending
        $transactions = Transaction::where('status', 'pending')->get();

        // foreach ($transactions as $transaction) {
        //     echo '';
        // }

        foreach ($transactions as $transaction) {
            $response = \Midtrans\Transaction::status($transaction->transaction_code);

            if (is_array($response) && isset($response['transaction_status'])) {
                if ($response['transaction_status'] === 'expire' || $response['transaction_status'] === 'cancel') {
                    $transaction->status = 'failed';
                    $transaction->save();
                }
            } else {
                // Tangani kasus jika data tidak sesuai dengan yang diharapkan
                $this->error('Response data is not in the expected format.');
            }
        }
    }
}