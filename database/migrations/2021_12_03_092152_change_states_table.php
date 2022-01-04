<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('states', function (Blueprint $table) {
            $table->char('country_code', 2)->nullable();
            $table->string('fips_code')->nullable();
            $table->string('iso2')->nullable();
            $table->string('type')->nullable();
            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->tinyInteger('flag')->default(1);
            $table->string('wikiDataId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('states', function (Blueprint $table) {
            $table->dropColumn('country_code');
            $table->dropColumn('fips_code');
            $table->dropColumn('iso2');
            $table->dropColumn('type');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('flag');
            $table->dropColumn('wikiDataId');
        });
    }
}
