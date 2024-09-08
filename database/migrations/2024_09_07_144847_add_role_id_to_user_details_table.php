<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleIdToUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function (Blueprint $table) {
            // Add role_id column after the email column
            $table->integer('role_id')->unsigned()->default(3)->after('email');

            // Define the foreign key constraint
            $table->foreign('role_id')->references('role_id')->on('rolemaster')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_details', function (Blueprint $table) {
            // Drop foreign key constraint and column
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
}
