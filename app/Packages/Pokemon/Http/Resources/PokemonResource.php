<?php

namespace Pokemon\Http\Resources;

use Pokemon\Models\Pokemon;
use Illuminate\Contracts\Support\Arrayable as ArrayableAlias;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property-read Pokemon $resource
 */
class PokemonResource extends JsonResource
{
    /**
     * @param $request
     * @return array|ArrayableAlias|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            Pokemon::ID => $this->resource->id,
            Pokemon::NAME => $this->resource->name,
            Pokemon::WEIGHT => $this->resource->weight,
            Pokemon::HEIGHT => $this->resource->height,
            Pokemon::SOURCE_ID => $this->resource->source_id,
            Pokemon::SPRITE_URL => $this->resource->sprite_url,
            Pokemon::ORDER => $this->resource->base_experience,
            Pokemon::IS_DEFAULT => $this->resource->is_default,
            Pokemon::RELATION_ABILITIES_KEY => $this->resource->abilities,
        ];
    }
}
