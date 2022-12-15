<?php

use App\Models\Course;
use App\Models\Period;
use App\Models\Subject;
use App\Models\User;
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
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->float('note');
            $table->foreignIdFor(User::class, 'student_id');
            $table->foreignIdFor(User::class, 'teacher_id');
            $table->foreignIdFor(Course::class);
            $table->foreignIdFor(Period::class);
            $table->foreignIdFor(Subject::class);
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
        Schema::dropIfExists('qualifications');
    }
};
