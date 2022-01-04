<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->char('iso3', 3)->nullable();
            $table->char('numeric_code', 3)->nullable();
            $table->char('iso2', 2)->nullable();
            $table->string('capital')->nullable();
            $table->string('currency')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('tld')->nullable();
            $table->string('native')->nullable();
            $table->string('region')->nullable();
            $table->string('subregion')->nullable();
            $table->text('timezones')->nullable();
            $table->text('translations')->nullable();
            $table->decimal('latitude', 10,8);
            $table->decimal('longitude', 11,8);
            $table->string('emoji')->nullable();
            $table->string('emojiU')->nullable();
            $table->tinyInteger('flag')->nullable();
            $table->string('wikiDataId')->nullable();

            $table->dateTime('created_at')->after('wikiDataId')->nullable()->change();
            $table->dateTime('updated_at')->after('created_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('iso3');
            $table->dropColumn('numeric_code');
            $table->dropColumn('iso2');
            $table->dropColumn('capital');
            $table->dropColumn('currency');
            $table->dropColumn('currency_symbol');
            $table->dropColumn('tld');
            $table->dropColumn('native');
            $table->dropColumn('region');
            $table->dropColumn('subregion');
            $table->dropColumn('timezones');
            $table->dropColumn('translations');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('emoji');
            $table->dropColumn('emojiU');
            $table->dropColumn('flag');
            $table->dropColumn('wikiDataId');
        });
    }
}
