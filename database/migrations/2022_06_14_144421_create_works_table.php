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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->unique();
            $table->string('slug')->nullable();
            $table->text('desc')->nullable();
            $table->string('file')->nullable();
            //0 for not published, 1 for published (accepted) , 2 for rejected
            $table->integer('status')->default(0);
            $table->text('reject_reason')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
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
        Schema::dropIfExists('works');
    }
};
