<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaccine extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->string('vaccine');
            $table->string('site');
            $table->string('date');
            $table->timestamps();
        });

        Schema::create('generics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('generics_id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('vaccine_id')->default(0);
            $table->integer('generics_id');
            $table->integer('generic_brands_id');
            $table->string('frequency');
            $table->string('amount_dose');
            $table->string('date');
            $table->string('notes');
            $table->string('next_checkup');
            $table->string('strength');
            $table->string('preparation');
            $table->string('others')->nullable();
            $table->timestamps();
        });

        Schema::create('growth_progresses', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('age');
            $table->integer('child_weight');
            $table->integer('child_height');
            $table->integer('head');
            $table->integer('chest');
            $table->longText('notes')->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('vaccines');
        Schema::dropIfExists('generics');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('prescriptions');
        Schema::dropIfExists('growth_progresses');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
