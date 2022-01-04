<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->bigInteger('state_id')->after('name')->change();
            $table->string('state_code');
            $table->bigInteger('country_id');
            $table->char('country_code', 2);
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
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('state_code');
            $table->dropColumn('country_id');
            $table->dropColumn('country_code');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('flag');
            $table->dropColumn('wikiDataId');
        });
    }
}
