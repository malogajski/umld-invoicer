<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('tax_id')->unique();
            $table->string('number_id')->unique();
            $table->string('address');
            $table->foreignId('city_id')->references('id')->on('cities');
            $table->foreignId('country_id')->references('id')->on('countries');
            $table->string('email')->unique();
            $table->string('web')->nullable();
            $table->string('responsible_person');
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('logo_img')->nullable();
            $table->string('default_language')->default('en');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hosts');
    }
}
