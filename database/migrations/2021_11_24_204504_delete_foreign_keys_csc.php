<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteForeignKeysCsc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('associates', function (Blueprint $table) {
//            $table->dropForeign('associates_state_id_foreign');
//        });

//        Schema::table('cities', function (Blueprint $table) {
//            $table->dropForeign('cities_state_id_foreign');
//        });

//        Schema::dropIfExists('cities');
//        Schema::dropIfExists('states');
//        Schema::dropIfExists('countries');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->foreign('state_id', 'associates_state_id_foreign')->references('id')->on('states');
        });

        Schema::table('associates', function (Blueprint $table) {
            $table->foreign('state_id', 'cities_state_id_foreign')->references('id')->on('city_id');
        });
    }
}
