<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNumberTypeToInvoicesTable extends Migration
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
                \App\Models\Invoices\Invoice::withTrashed()->update(['number' => DB::raw('id')]);
            }

            $table->integer('number')->change();
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
            $table->string('number')->change();
        });
    }
}
