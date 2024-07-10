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
        Schema::create('complaint_comments', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->unsignedBigInteger('comment_by');
            $table->foreign('comment_by')->references('id')->on('users');
            $table->unsignedBigInteger('complaint_id');
            $table->foreign('complaint_id')->references('id')->on('complaints');
            $table->tinyInteger('of_the_accused')->comment("0-> complainant's comment, 1 -> accused's comment");
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
        Schema::dropIfExists('complaint_comments');
    }
};
