<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulaires', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('active', ['Y', 'N'])->default('N');
            $table->string('code');
            $table->string('tracking')->nullable();

            $table->timestamps();
        });

        Schema::create('formulaires_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('formulaire_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('resume')->nullable();

            $table->unique(['formulaire_id','locale'], 'u_form_trans_formulaire_id_locale');
            $table->foreign('formulaire_id', 'fk_form_trans_formulaire_id')->references('id')->on('formulaires')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('formulaires_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('formulaire_id')->unsigned();
            $table->enum('active', ['Y', 'N'])->default('N');
            $table->integer('order')->default(1);
            $table->string('code');
            $table->string('type');

            $table->timestamps();

            $table->foreign('formulaire_id', 'fk_form_field_formulaire_id')->references('id')->on('formulaires')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('formulaires_fields_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('formulaire_field_id')->unsigned();
            $table->string('locale')->index();
            $table->string('label_admin');
            $table->string('label_front');
            $table->string('placeholder')->nullable();
            $table->string('date_format')->nullable();
            $table->string('help')->nullable();
            $table->string('error')->nullable();
            $table->string('error_min')->nullable();
            $table->string('error_max')->nullable();
            $table->string('error_extension')->nullable();
            $table->string('error_filesize')->nullable();
            $table->string('error_dimension')->nullable();
            $table->string('error_date_format')->nullable();

            $table->unique(['formulaire_field_id','locale'], 'u_form_field_trans_formulaire_field_id_locale');
            $table->foreign('formulaire_field_id', 'fk_form_field_trans_formulaire_field_id')->references('id')->on('formulaires_fields')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('formulaires_fields_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('formulaire_field_id')->unsigned();
            $table->enum('active', ['Y', 'N'])->default('N');
            $table->integer('order')->default(1);
            $table->string('code');

            $table->timestamps();

            $table->foreign('formulaire_field_id', 'fk_form_field_value_formulaire_field_id')->references('id')->on('formulaires_fields')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('formulaires_fields_values_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('formulaire_field_value_id')->unsigned();
            $table->string('locale')->index();
            $table->string('value');

            $table->unique(['formulaire_field_value_id','locale'], 'u_form_field_value_trans_formulaire_field_value_id_locale');
            $table->foreign('formulaire_field_value_id', 'fk_form_field_value_trans_formulaire_field_value_id')->references('id')->on('formulaires_fields_values')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('formulaires');
        Schema::dropIfExists('formulaires_translations');
        Schema::dropIfExists('formulaires_fields');
        Schema::dropIfExists('formulaires_fields_translations');
        Schema::dropIfExists('formulaires_fields_values');
        Schema::dropIfExists('formulaires_fields_values_translations');
        Schema::enableForeignKeyConstraints();
    }
}
