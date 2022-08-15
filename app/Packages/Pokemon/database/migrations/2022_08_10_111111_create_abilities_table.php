<?php

use Pokemon\Models\Ability;
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
        Schema::create(Ability::TABLE_NAME, static function (Blueprint $table) {
            $table->id();
            $table->string(Ability::NAME);
            $table->string(Ability::URL);
            $table->boolean(Ability::IS_HIDDEN);
            $table->integer(Ability::SLOT);
            $table->foreignId( Ability::POKEMON_ID)
                ->constrained(Pokemon::TABLE_NAME)
                ->cascadeOnDelete();
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
        Schema::table(Ability::TABLE_NAME, static function (Blueprint $table) {
            $table->dropForeign([Ability::POKEMON_ID]);
        });
        Schema::dropIfExists(Ability::TABLE_NAME);
    }
};
