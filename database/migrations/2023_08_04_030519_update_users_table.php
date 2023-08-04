<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('dob');
            $table->string('phone_number', 20);
            $table->string('role')->default('user');
            $table->string('gender');
            $table->string('avatar')->nullable();
            $table->softDeletes();
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
            $table->dropColumn('dob');
            $table->dropColumn('phone_number');
            $table->dropColumn('role');
            $table->dropColumn('gender');
            $table->dropColumn('avatar');
            $table->dropSoftDeletes();
        });
    }
}
