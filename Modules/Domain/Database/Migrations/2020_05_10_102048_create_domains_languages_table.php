<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('domain_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->enum('active', ['Y', 'N'])->default('N');
            $table->enum('default', ['Y', 'N'])->default('N');
            $table->integer('order')->default(1);
            $table->string('url_redirect')->nullable();
            $table->string('url_blog')->nullable();
            $table->string('url_facebook')->nullable();
            $table->string('url_instagram')->nullable();
            $table->string('url_linkedin')->nullable();
            $table->string('url_pinterest')->nullable();
            $table->string('url_twitter')->nullable();
            $table->string('url_youtube')->nullable();

            $table->timestamps();

            $table->foreign('domain_id', 'fk_domain_language_domain_id')->references('id')->on('domains')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('language_id', 'fk_domain_language_language_id')->references('id')->on('languages')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['domain_id','language_id'], 'u_domain_language_domain_id_language_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domains_languages');
    }
}
