<?php

namespace Pokemon\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ability extends Model
{
    public const TABLE_NAME = 'abilities';

    public const NAME = 'name';
    public const URL = 'url';
    public const IS_HIDDEN = 'is_hidden';
    public const SLOT = 'slot';
    public const POKEMON_ID = 'pokemon_id';

    protected $table = self::TABLE_NAME;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::NAME,
        self::URL,
        self::IS_HIDDEN,
        self::SLOT,
        self::POKEMON_ID
    ];

    public function pokemon(): BelongsTo
    {
        return $this->belongsTo(Pokemon::class, self::POKEMON_ID);
    }
}
