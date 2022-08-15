<?php

namespace Pokemon\Console\Commands;

use Pokemon\Models\Pokemon;
use Pokemon\PokemonManager;
use Pokemon\Repositories\PokemonRepository;
use Pokemon\Services\Http\HttpPokemonClient;
use Illuminate\Console\Command;

class FetchPokemon extends Command
{
    public const ONLY_THAT_ID_OPTION = 'only_that_id';

    public const NAME = 'pokemon:fetch_data_from_pokemon_api' . ' {--' .self::ONLY_THAT_ID_OPTION . '=}';
    public const ITERATIONS_LIMIT = 150;

    public const REQUEST_TIMEOUT = 4;

    public function __construct(
        private PokemonRepository $pokemonRepository
    ) {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = self::NAME;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch pokemon data with abilities by id from  resource https://pokeapi.co' .
        ' and store it DB if not exists 151 first items by default or specific if you specify the id in the option ' .
        '--only_that_id={input_specific_pokemon_id_here}';

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $sourceId = $this->option(self::ONLY_THAT_ID_OPTION);
        if ($sourceId) {
            $this->fetchOneById($sourceId);
            return;
        }
        $this->fetchAll();
    }

    private function fetchAll(): void
    {
        $storedPokemonsInBd = 0;
        $iteration = 0;
        $bar = $this->output->createProgressBar(self::ITERATIONS_LIMIT);
        try {
            while ($iteration <= self::ITERATIONS_LIMIT) {
                $iteration++;
                $bar->advance();
                $existsPokemon = $this->pokemonRepository->findByField(Pokemon::SOURCE_ID, $iteration)->first();
                if ($existsPokemon !== null) {
                    $this->info("Pokemon with source_id:" . $iteration . " exists in DB, continue!");
                    continue;
                }
                $pokemonManager = new PokemonManager(new HttpPokemonClient());
                $pokemonManager->storeDataInDbForSourceId($iteration);
                $storedPokemonsInBd++;
                sleep(self::REQUEST_TIMEOUT);
            }
            $this->info("Total stored pokemons data is:" . $storedPokemonsInBd);
        } catch (\Throwable $exception) {
            $this->error($exception->getMessage());
        } finally {
            $bar->finish();
        }
    }

    private function fetchOneById(int $sourceId): void
    {
        $existsPokemon = $this->pokemonRepository->findByField(Pokemon::SOURCE_ID, $sourceId)->first();
        if ($existsPokemon !== null) {
            $this->info("Pokemon with source_id:" . $sourceId . " exists in DB, interrupt execution!");
            return;
        }
        try {
            $pokemonManager = new PokemonManager(new HttpPokemonClient());
            $pokemonManager->storeDataInDbForSourceId($sourceId);
            $this->info('Pokemon with source id:' . $sourceId . ' successfully received and saved in DB');
        } catch (\Throwable $exception) {
            $this->error($exception->getMessage());
        }
    }
}
