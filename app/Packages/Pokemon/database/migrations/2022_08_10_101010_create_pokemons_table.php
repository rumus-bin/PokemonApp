<?php

use Pokemon\Models\Pokemon;
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
    public function up(): void
    {
        Schema::create(Pokemon::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(Pokemon::NAME);
            $table->integer(Pokemon::SOURCE_ID)->unique();
            $table->integer(Pokemon::HEIGHT);
            $table->integer(Pokemon::WEIGHT);
            $table->integer(Pokemon::ORDER);
            $table->integer(Pokemon::BASE_EXPERIENCE);
            $table->boolean(Pokemon::IS_DEFAULT);
            $table->string(Pokemon::SPRITE_URL)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(Pokemon::TABLE_NAME);
    }
};
