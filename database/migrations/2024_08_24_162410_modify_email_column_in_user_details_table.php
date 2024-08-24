<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyEmailColumnInUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_details', function (Blueprint $table) {
            // Modify the email column
            $table->string('email', 100) ->nullable()->change();
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
            // Revert the email column to its original state if needed
            // Assuming the original was VARCHAR(255) with default charset and collation
            $table->string('email', 255)
                ->charset('utf8mb4')
                ->collation('utf8mb4_unicode_ci')
                ->nullable()
                ->change();
        });
    }
}
