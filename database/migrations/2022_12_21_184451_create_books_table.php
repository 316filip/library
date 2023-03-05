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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->integer('length');
            $table->string('language');
            $table->string('translator')->nullable();
            $table->string('illustrator')->nullable();
            $table->longText('description')->nullable();
            $table->string('house');
            $table->integer('year');
            $table->integer('publication')->nullable();
            $table->string('place')->nullable();
            $table->string('image')->nullable();
            $table->string('ISBN')->nullable();
            $table->integer('amount');
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
        Schema::dropIfExists('books');
    }
};
