<?php

use App\Enums\Codebooks\AssociateStatus;
use App\Enums\Codebooks\AssociateType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('associates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', AssociateType::asArray());
            $table->string('description')->nullable();
            $table->string('address');
            $table->integer('city_id');
            $table->string('country_id');
            $table->string('registration_number');
            $table->string('pib');
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('web')->nullable();
            $table->string('responsible_person');
            $table->enum('status', AssociateStatus::asArray());
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
        Schema::dropIfExists('associates');
    }
}
