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
        Schema::create('hadiths', function (Blueprint $table) {
            $table->id();
            $table->longText('sanad');
            $table->longText('matn');
            $table->longText('description');
            $table->string('source');
            $table->string('degree');
            $table->unsignedBigInteger('cluster_id')->nullable();
            $table->foreign('cluster_id')->references('id')->on('clusters')->cascadeOnDelete();
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
        Schema::dropIfExists('hadiths');
    }
};
