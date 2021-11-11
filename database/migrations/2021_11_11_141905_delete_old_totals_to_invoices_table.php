<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteOldTotalsToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $invoices = \App\Models\Invoices\Invoice::all();
            if (count($invoices) > 0) {
                \App\Models\Invoices\Invoice::withTrashed()->update(
                    [
                        'sub_total' => DB::raw('invoice_sub_total'),
                        'tax_total' => DB::raw('tax_amount'),
                        'total'     => DB::raw('total_amount'),
                    ],
                );
            }

            $table->dropColumn('invoice_sub_total');
            $table->dropColumn('tax_amount');
            $table->dropColumn('total_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->float('invoice_sub_total')->after('date_sent')->default(0);
            $table->float('tax_amount')->after('invoice_sub_total')->default(0);
            $table->float('total_amount')->after('tax_amount')->default(0);

            $invoices = \App\Models\Invoices\Invoice::all();
            if (count($invoices) > 0) {
                \App\Models\Invoices\Invoice::withTrashed()->update(
                    [
                        'invoice_sub_total' => DB::raw('sub_total'),
                        'tax_amount'        => DB::raw('tax_total'),
                        'total_amount'      => DB::raw('total'),
                    ],
                );
            }
        });
    }
}
