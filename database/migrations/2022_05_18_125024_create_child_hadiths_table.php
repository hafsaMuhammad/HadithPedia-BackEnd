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
        Schema::create('child_hadiths', function (Blueprint $table) {
            $table->id();
            $table->longText('matn');
            $table->longText('description');
            $table->string('image');
            $table->string('iamgePath');
            $table->string('audio');
            $table->string('audioPath');
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
        Schema::dropIfExists('child_hadiths');
    }
};
