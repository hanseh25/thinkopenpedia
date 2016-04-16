<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_consultation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('generalconsultation_id', 60);
            $table->string('healthcareservice_id', 60);
            $table->string('medicalcategory_id', 60);
            $table->binary('complaint');
            $table->binary('complaint_history');
            $table->binary('physical_examination');
            $table->binary('remarks');

            $table->softDeletes();
            $table->timestamps();
            $table->unique('generalconsultation_id');
        });

         Schema::create('vital_physical', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vitalphysical_id', 60);
            $table->string('healthcareservice_id', 60);
            $table->string('bloodpressure_systolic', 60);
            $table->string('bloodpressure_diastolic', 60);
            $table->string('bloodpressure_assessment', 60);
            $table->string('heart_rate', 60);
            $table->string('pulse_rate', 60);
            $table->string('respiratory_rate', 60);
            $table->string('temperature', 60);
            $table->string('height', 60);
            $table->string('weight', 60);
            $table->string('BMI_category', 60);
            $table->string('waist', 60);
            $table->boolean('pregnant')->nullable();
            $table->boolean('weight_loss')->nullable();
            $table->boolean('with_intact_uterus')->nullable();

            $table->softDeletes();
            $table->timestamps();
            $table->unique('vitalphysical_id');
        });

        Schema::create('examination', function (Blueprint $table) {
            $table->increments('id');
            $table->string('examination_id', 60);
            $table->string('healthcareservice_id', 60);
            $table->string('Pallor', 60);
            $table->string('Rashes', 060);
            $table->string('Jaundice', 60);
            $table->string('Good_Skin_Turgor', 60);
            $table->string('skin_others', 60);
            $table->string('Anicteric_Sclerae', 60);
            $table->string('Pupils', 60);
            $table->string('Aural_Discharge', 60);
            $table->string('Intact_Tympanic_Membrane', 60);
            $table->string('Nasal_Discharge', 60);
            $table->string('Tonsillopharyngeal_Congestion', 60);
            $table->string('Hypertrophic_Tonsils', 60);
            $table->string('Palpable_Mass_B', 60);
            $table->string('Exudates', 60);
            $table->string('heent_others', 60);
            $table->string('Symmetrical_Chest_Expansion', 60);
            $table->string('Clear_Breathsounds', 60);
            $table->string('Crackles_Rales', 60);
            $table->string('Wheezes', 60);
            $table->string('chest_others', 60);
            $table->string('Adynamic_Precordium', 60);
            $table->string('Rhythm', 60);
            $table->string('Heaves', 60);
            $table->string('Murmurs', 60);
            $table->string('heart_others', 60);
            $table->string('anatomy_heart_Others', 60); 
            $table->string('Flat', 60);
            $table->string('Globular', 60);
            $table->string('Flabby', 60);
            $table->string('Muscle_Guarding', 60);
            $table->string('Tenderness', 60);
            $table->string('Palpable_Mass', 60);
            $table->string('abdomen_others', 60);
            $table->string('Normal_Gait', 60);
            $table->string('Full_Equal_Pulses', 60);
            $table->string('extreme_others', 60);

            $table->softDeletes();
            $table->timestamps();
            $table->unique('examination_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('general_consultation');
        Schema::drop('vital_physical');
        Schema::drop('examination');
    }
}
