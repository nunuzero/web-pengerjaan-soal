<?php

use App\Models\Package;
use App\Models\Question;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('package_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Package::class);
            $table->foreignIdFor(Question::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_questions');
    }
};
