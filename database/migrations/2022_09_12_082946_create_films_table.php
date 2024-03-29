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
            $table->string('film_category_id');
            $table->foreignId('media_link_id')->constrained('media_links');
            $table->string('name',50);
            $table->text('description');
            $table->foreignId('language_id')->constrained('languages');
            $table->string('film_rule_id');
            $table->foreignId('production_id')->constrained('productions');
            $table->integer('duration');
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
