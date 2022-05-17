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
        Schema::create('hadith_questions', function (Blueprint $table) {
            $table->id();
            $table->longText('question');
            $table->longText('choiceA');
            $table->longText('choiceB');
            $table->longText('choiceC');
            $table->string('correct');
            $table->unsignedBigInteger('hadith_id')->nullable();
            $table->foreign('hadith_id')->references('id')->on('hadiths')->cascadeOnDelete();
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
        Schema::dropIfExists('hadith_questions');
    }
};
