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
        Schema::create('model_has_domains', function (Blueprint $table) {
            $table->integer('domain_id')->unsigned();
            $table->string('model_type');
            $table->bigInteger('model_id')->unsigned();

            $table->primary(['domain_id', 'model_id', 'model_type']);
            $table->foreign('domain_id', 'fk_model_has_domains_domain_id')->references('id')->on('domains')->onUpdate('cascade')->onDelete('cascade');
            $table->index(['model_id', 'model_type'], 'model_has_domains_model_id_model_type_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_has_domains');
    }
};
