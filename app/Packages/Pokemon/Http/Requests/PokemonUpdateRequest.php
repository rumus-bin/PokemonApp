<?php

namespace Pokemon\Http\Requests;

use Pokemon\Models\Pokemon;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $id
 * @property int $height
 * @property int $weight
 * @property int $source_id
 * @property string $name
 * @property int $order
 * @property string $sprite_url
 * @property string $base_experience
 */
class PokemonUpdateRequest extends PokemonStoreRequest
{
    public function rules(): array
    {
        return parent::rules()[Pokemon::ID] = ['numeric', 'required', 'exists:' . Pokemon::TABLE_NAME . ',id'];
    }
}
