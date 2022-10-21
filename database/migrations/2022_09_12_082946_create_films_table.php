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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_category_id')->constrained('film_categories');
            $table->foreignId('image_id')->constrained('images');
            $table->string('name',50);
            $table->text('description');
            $table->foreignId('language_id')->constrained('languages');
            $table->foreignId('film_rule_id')->constrained('film_rules');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
};
