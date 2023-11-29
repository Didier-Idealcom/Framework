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
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('active', ['Y', 'N'])->default('N');
            $table->string('alpha2', 2);
            $table->string('alpha3', 3);
            $table->string('locale', 10);
            $table->string('name');
            $table->string('format_date_small');
            $table->string('format_date_long');
            $table->string('format_date_time');

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
        Schema::dropIfExists('languages');
    }
};
