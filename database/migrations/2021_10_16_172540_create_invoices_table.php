<?php

use App\Enums\Invoices\InvoiceStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->integer('associate_id');
            $table->date('date');
            $table->date('due_date');
            $table->integer('user_id')->default(auth()->id());
            $table->string('note')->nullable();
            $table->enum('status', InvoiceStatus::asArray());
            $table->date('date_received')->nullable();
            $table->date('date_sent')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
