<?php

namespace Pokemon\Http\Controllers\Api;

use App\Packages\Pokemon\Repositories\Services\PokemonDbService;
use Pokemon\Http\Requests\PokemonStoreRequest;
use Pokemon\Http\Requests\PokemonUpdateRequest;
use Pokemon\Http\Resources\PokemonResource;
use Pokemon\Models\Pokemon;
use Pokemon\Repositories\PokemonRepository;
use Pokemon\Tools\Model\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PokemonApiController extends Controller
{
    public function __construct(
        private PokemonRepository $pokemonRepository,
        private PokemonDbService $dbService
    ) {
    }

    /**
     * @param Request $request
     * @return JsonResponse
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
        $pokemonDto = $request->makeResourceDto();
        $pokemonStored = $this->dbService->storeResource($pokemonDto);

        return response()->json($pokemonStored);
    }

    /**
     * Display the specified resource.
     *
     * @param  Pokemon  $pokemon
     * @return PokemonResource
     */
    public function show(Pokemon $pokemon): PokemonResource
    {
        return new PokemonResource($pokemon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PokemonUpdateRequest $request
     * @return PokemonResource
     */
    public function update(PokemonUpdateRequest $request): PokemonResource
    {
        $pokemonDto = $request->makeResourceDto();
        $pokemon = $this->dbService->storeResource($pokemonDto);

        return new PokemonResource($pokemon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $this->pokemonRepository->deleteById($request->id);

        return response()->json(['code' => 204]);
    }
}
