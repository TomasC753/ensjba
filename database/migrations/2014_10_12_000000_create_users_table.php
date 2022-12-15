<?php

use App\Models\Tutor;
use App\Models\Course;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastName');
            $table->string('dni')->unique();
            $table->date('date_birth');
            $table->enum('gender', ['masculino', 'femenino', 'otro']);
            $table->enum('type', ['primario', 'secundario', 'terciario'])->nullable();
            $table->string('country');
            $table->string('andress');
            $table->string('phone_number')->nullable();
            $table->string('house_phone_number')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('active')->default(false);
            $table->foreignId('current_team_id')->nullable();
            $table->foreignIdFor(Tutor::class)->nullable();
            $table->foreignIdFor(Course::class, 'lastCourse_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
};
