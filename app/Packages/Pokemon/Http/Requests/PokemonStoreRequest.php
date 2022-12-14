<?php

namespace Pokemon\Http\Requests;

use App\Packages\Pokemon\Repositories\Services\PokemonResourceDto;
use Pokemon\Models\Pokemon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int|null $id
 * @property int $height
 * @property int $weight
 * @property int $source_id
 * @property string $name
 * @property int $order
 * @property string $sprite_url
 * @property string $base_experience
 */
class PokemonStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            Pokemon::NAME => ['string', 'required', 'max:255'],
            Pokemon::WEIGHT => ['numeric', 'required'],
            Pokemon::HEIGHT => ['numeric', 'required'],
            Pokemon::SOURCE_ID => ['numeric', 'required'],
            Pokemon::ORDER => ['numeric', 'required'],
            Pokemon::SPRITE_URL => ['string', 'required'],
            Pokemon::BASE_EXPERIENCE => ['numeric', 'required']
        ];
    }

    public function makeResourceDto(): PokemonResourceDto
    {
        return new PokemonResourceDto(
            $this->id,
            $this->name,
            $this->source_id,
            $this->height,
            $this->weight,
            $this->order,
            false,
            $this->base_experience,
            $this->sprite_url
        );
    }
}
