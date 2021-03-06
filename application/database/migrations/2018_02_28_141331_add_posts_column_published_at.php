<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostsColumnPublishedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dateTime('published_at')->nullable();
        });

        Schema::table('gameplays', function (Blueprint $table) {
            $table->dateTime('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('published_at');
        });

        Schema::table('gameplays', function (Blueprint $table) {
            $table->dropColumn('published_at');
        });
    }
}
