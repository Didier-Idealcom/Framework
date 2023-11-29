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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('active', ['Y', 'N'])->default('N')->after('id');
            $table->string('firstname', 100)->nullable()->after('active');
            $table->string('lastname', 100)->nullable()->change();
            $table->string('email', 100)->change();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['active', 'firstname', 'last_login_at', 'last_login_ip']);
            $table->string('lastname', 255)->nullable(false)->change();
            $table->string('email', 255)->change();
        });
    }
};
