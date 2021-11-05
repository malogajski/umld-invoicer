<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->unsigned();
            $table->foreign('parent_id')->references('id')->on('invoices');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->float('quantity')->default(0);
            $table->float('price')->default(0);
            $table->float('tax')->default(0);
            $table->float('total_without_tax')->default(0);
            $table->float('total_tax')->default(0);
            $table->float('total')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
}
