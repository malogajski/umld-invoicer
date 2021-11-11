<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldOrdersToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->float('sub_total')->after('date_sent')->default(0);
            $table->float('tax_total')->after('sub_total')->default(0);
            $table->float('discount_total')->after('tax_total')->default(0);
            $table->float('total')->after('discount_total')->default(0);
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
            $table->dropColumn('sub_total');
            $table->dropColumn('tax_total');
            $table->dropColumn('discount_total');
            $table->dropColumn('total');
        });
    }
}
