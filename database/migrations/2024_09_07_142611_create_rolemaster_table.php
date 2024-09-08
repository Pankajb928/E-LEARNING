<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon; 

class CreateRolemasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rolemaster', function (Blueprint $table) {
            $table->integer('role_id')->primary(); // Non auto-incrementing primary key
            $table->string('role_name', 100); // VARCHAR(100) for role_name
            $table->timestamp('created_on')->nullable(); // Custom timestamp field
        });

        // Insert data with created_on timestamps
        DB::table('rolemaster')->insert([
            ['role_id' => 1, 'role_name' => 'Admin', 'created_on' => Carbon::now()],
            ['role_id' => 2, 'role_name' => 'Teacher', 'created_on' => Carbon::now()],
            ['role_id' => 3, 'role_name' => 'Student', 'created_on' => Carbon::now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rolemaster');
    }
}
