<?php

namespace Pokemon\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property-read int $id
 * @property string $name
 * @property int $source_id
 * @property int $height
 * @property int $weight
 * @property int $order
 * @property int $base_experience
 * @property boolean $is_default
 * @property string|null $sprite_url
 * @property-read  Collection<Ability> $abilities
 */
class Pokemon extends Model
{
    public const TABLE_NAME = 'pokemons';

    public const ID = 'id';
    public const NAME = 'name';
    public const SOURCE_ID = 'source_id';
    public const HEIGHT = 'height';
    public const WEIGHT = 'weight';
    public const ORDER = 'order';
    public const BASE_EXPERIENCE = 'base_experience';
    public const IS_DEFAULT = 'is_default';
    public const SPRITE_URL = 'sprite_url';

    public const RELATION_ABILITIES_KEY = 'abilities';

    protected $table = self::TABLE_NAME;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::NAME,
        self::SOURCE_ID,
        self::HEIGHT,
        self::WEIGHT,
        self::ORDER,
        self::BASE_EXPERIENCE,
        self::IS_DEFAULT,
        self::SPRITE_URL
    ];

    public function abilities(): HasMany
    {
        return $this->hasMany(Ability::class);
    }
}
