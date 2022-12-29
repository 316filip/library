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
            $table->string('subtitle');
            $table->integer('length');
            $table->string('language');
            $table->string('translator');
            $table->string('illustrator');
            $table->longText('description');
            $table->string('house');
            $table->year('year');
            $table->integer('publication')->nullable();
            $table->string('place');
            $table->string('image')->nullable();
            $table->string('ISBN');
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
