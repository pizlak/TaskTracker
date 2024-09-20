<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->integer('day_of_birth')->nullable();
            $table->string('month_of_birth')->nullable();
            $table->integer('years_of_birth')->nullable();
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
            $table->dropColumn('last_name');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('day_of_birth');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('month_of_birth');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('years_of_birth');
        });
    }
}
