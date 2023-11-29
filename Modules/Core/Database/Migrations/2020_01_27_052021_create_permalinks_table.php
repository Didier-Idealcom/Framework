<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permalinks', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('active', ['Y', 'N'])->default('N');
            $table->string('entity_type')->nullable();
            $table->integer('entity_id')->unsigned()->nullable();
            $table->integer('redirect')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('redirect')->references('id')->on('permalinks')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('permalinks_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permalink_id')->unsigned();
            $table->string('locale')->index();
            $table->string('slug');
            $table->string('full_path');

            $table->unique(['permalink_id', 'locale']);
            $table->foreign('permalink_id')->references('id')->on('permalinks')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permalinks');
        Schema::dropIfExists('permalinks_translations');
    }
};
