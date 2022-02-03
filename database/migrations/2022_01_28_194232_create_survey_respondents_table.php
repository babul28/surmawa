<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyRespondentsTable extends Migration
{
    public function up()
    {
        Schema::create('survey_respondents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('respondent_id');
            $table->foreignUuid('survey_id')->constrained('surveys')->onDelete('cascade');
            $table->string('name');
            $table->string('nim');
            $table->string('gender');
            $table->text('answers');
            $table->text('summary');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('survey_respondents');
    }
}
