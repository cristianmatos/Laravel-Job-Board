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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('slug');
            $table->foreignId('job_type_id')->constrained('job_types');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('level', ['junior', 'senior']);
            $table->longText('description');
            $table->mediumText('how_apply')->nullable();
            $table->string('application_link');
            $table->double('compensation_min')->nullable();
            $table->double('compensation_max')->nullable();
            $table->boolean('allow_remote')->default(false);
            $table->string('location')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('DRAFT');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
