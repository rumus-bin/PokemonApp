<?php

namespace Pokemon\Http\Controllers\Api;

use App\Packages\Pokemon\Repositories\Services\PokemonDbService;
use App\Packages\Pokemon\Repositories\Services\PokemonResourceDto;
use Pokemon\Http\Requests\PokemonStoreRequest;
use Pokemon\Http\Requests\PokemonUpdateRequest;
use Pokemon\Http\Resources\PokemonResource;
use Pokemon\Models\Pokemon;
use Pokemon\Repositories\PokemonRepository;
use Pokemon\Tools\Model\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;

class PokemonApiController extends Controller
{
    public function __construct(
        private PokemonRepository $pokemonRepository,
        private PokemonDbService $dbService
    ) {
    }

    /**
     * @param Request $request
     * @return InertiaResponse
     */
    public function index(Request $request): JsonResponse
    {
        $paginator = new Paginator($request->get('page'), $request->get('per_page'));
        $pokemons = $this->pokemonRepository->findAll(paginator: $paginator, relations: ['abilities']);
        if (empty($pokemons['data'])) {
            return response()->json($pokemons);
        }

        return response()->json(PokemonResource::collection($pokemons->items()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PokemonStoreRequest $request
     * @return JsonResponse
     */
    public function store(PokemonStoreRequest $request): JsonResponse
    {
         $pokemonDto = new PokemonResourceDto(
             $request->id ?? null,
                 $request->name,
                 $request->source_id,
                 $request->height,
                 $request->weight,
                 $request->order,
                 false,
             $request->base_experience,
             $request->sprite_url

         );
        $pokemonStored = $this->dbService->storeResource($pokemonDto);

        return response()->json($pokemonStored);
    }

    /**
     * Display the specified resource.
     *
     * @param  Pokemon  $pokemon
     * @return PokemonResource
     */
    public function show(Pokemon $pokemon)
    {
        return new PokemonResource($pokemon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PokemonUpdateRequest $request
     * @param  Pokemon  $pokemon
     * @return PokemonResource
     */
    public function update(PokemonUpdateRequest $request, Pokemon $pokemon)
    {
        $pokemon->name = $request->name;
        $pokemon->weight = $request->weight;
        $pokemon->height = $request->height;
        $pokemon->source_id = $request->source_id;
        $pokemon->order = $request->order;
        $pokemon->base_experience = $request->base_experience;
        $pokemon->sprite_url = $request->sprite_url;

        $pokemon = $this->pokemonRepository->store($pokemon);

        return new PokemonResource($pokemon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Pokemon  $pokemon
     * @return JsonResponse
     */
    public function destroy(Pokemon $pokemon)
    {
        $this->pokemonRepository->delete($pokemon);

        return response()->json(['code' => 204]);
    }
}
