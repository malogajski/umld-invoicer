<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalsToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->float('invoice_sub_total')->default(0);
            $table->float('tax_amount')->default(0);
            $table->float('total_amount')->default(0);
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
            $table->removeColumn('invoice_sub_total');
            $table->removeColumn('tax_amount');
            $table->removeColumn('total_amount');
        });
    }
}
