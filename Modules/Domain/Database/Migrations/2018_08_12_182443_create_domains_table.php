<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('active', ['Y', 'N'])->default('N');
            $table->string('title');
            $table->string('name');
            $table->string('extension');
            $table->string('folder');
            $table->string('analytics');
            $table->string('search_console');
            $table->string('google_maps');
            $table->datetime('maintenance_start');
            $table->datetime('maintenance_end');
            $table->string('maintenance_message');

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
        Schema::dropIfExists('domains');
    }
}
