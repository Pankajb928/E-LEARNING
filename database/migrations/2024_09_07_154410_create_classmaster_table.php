<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassmasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classmaster', function (Blueprint $table) {
            $table->string('classCode', 100); // Class Code
            $table->string('section', 100); // Section
            $table->integer('totalStudents'); // Total number of students
            $table->integer('AvaiableStudent'); // Available students
            $table->string('ClassTeacher'); // Class teacher name
            $table->boolean('isActive')->default(1); // Status (1 = active, 0 = inactive)
            $table->timestamps(); // created_at and updated_at
            $table->string('created_by')->nullable(); // Who created the record
            $table->string('updated_by')->nullable(); // Who updated the record
            $table->ipAddress('ipAddress')->nullable(); // IP address

            // Define composite primary key
            $table->primary(['classCode', 'section']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classmaster');
    }
}
