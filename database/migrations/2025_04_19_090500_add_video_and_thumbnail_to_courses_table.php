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
        Schema::table('courses', function (Blueprint $table) {
            // Adding the video and thumbnail columns
            $table->string('video')->nullable(); // Video column (nullable)
            $table->string('thumbnail')->nullable(); // Thumbnail column (nullable)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            // Dropping the video and thumbnail columns
            $table->dropColumn('video');
            $table->dropColumn('thumbnail');
        });
    }
};
