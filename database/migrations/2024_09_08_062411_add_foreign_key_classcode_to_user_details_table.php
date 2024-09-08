<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyClasscodeToUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function (Blueprint $table) {
            // Add classCode column first if not exists
            if (!Schema::hasColumn('user_details', 'classCode')) {
                $table->string('classCode', 100)->nullable()->after('role_id');
            }

            // Add foreign key constraint to classCode, referencing classmaster table
            $table->foreign('classCode')
                  ->references('classCode')
                  ->on('classmaster')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
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
            // Drop the foreign key constraint
            $table->dropForeign(['classCode']);
            // Optionally, drop the classCode column if you want to remove it during rollback
            $table->dropColumn('classCode');
        });
    }
}
