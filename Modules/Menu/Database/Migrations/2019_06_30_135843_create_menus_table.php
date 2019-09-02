<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('active', ['Y', 'N'])->default('N');
            $table->string('code');

            $table->timestamps();
        });

        Schema::create('menus_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');

            $table->unique(['menu_id','locale']);
            $table->foreign('menu_id')->references('id')->on('menus')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('menuitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->enum('active', ['Y', 'N'])->default('N');
            $table->string('gabarit');
            $table->integer('bg')->unsigned()->default(0);
            $table->integer('bd')->unsigned()->default(0);
            $table->integer('niveau')->unsigned()->default(1);
            $table->integer('parent_id')->unsigned()->nullable();
            $table->enum('visible', ['Y', 'N'])->default('N');
            $table->enum('cliquable', ['Y', 'N'])->default('N');
            $table->enum('format', ['submenu', 'big_submenu'])->default('submenu');

            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('menuitems')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('menuitems_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('menuitem_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title_menu');
            $table->string('title_page');
            $table->string('link')->nullable();
            $table->string('target')->nullable();

            $table->unique(['menuitem_id','locale']);
            $table->foreign('menuitem_id')->references('id')->on('menuitems')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('menus');
        Schema::dropIfExists('menus_translations');
        Schema::dropIfExists('menuitems');
        Schema::dropIfExists('menuitems_translations');
        Schema::enableForeignKeyConstraints();
    }
}
