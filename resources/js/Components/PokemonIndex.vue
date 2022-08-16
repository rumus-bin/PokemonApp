<template>
    <div class="w-full flex justify-center">
<!--        <input-->
<!--            type="text"-->
<!--            placeholder="Enter pokemon name here"-->
<!--            class="mt-10 p-2 border-blue-500 border-2"-->
<!--            v-model="text"-->
<!--        />-->
    </div>
    <div v-if="pokemonsLength">
        <section  class="mt-10 p-4 grid grid-cols-3 justify-center">
            <div v-for="(pokemon, id) in pokemonsData" :key="id"
                 class="relative items-center w-full px-5 py-12 mx-auto md:px-12 lg:px-24 max-w-7xl"
            >
                <div class="grid w-full grid-cols-1 gap-2 mx-auto">
                    <div class="p-6 items-center justify-center">
                        <img
                            class="object-cover object-center w-full mb-8 lg:h-30 md:h-30 rounded-xl"
                            :src="pokemon.sprite_url"
                            :alt="pokemon.name"
                        >

                        <h1
                            class="mx-auto mb-8 text-2xl font-semibold leading-none tracking-tighter text-neutral-600 lg:text-3xl"
                        >
                            {{ pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1) }}
                        </h1>

                        <p class="text-sm text-green-500">Base experience: {{ pokemon.base_experience }}</p>
                        <p class="text-sm text-gray-400">Weight: {{ pokemon.weight }}</p>
                        <p class="text-sm text-gray-400">Height: {{ pokemon.height }}</p>
                        <p class="text-sm text-pink-700">Abilities: {{ pokemon.abilities.length }}</p>

                        <div class="mt-4">
                            <a
                                href="#"
                                class="inline-flex items-center mt-4 font-semibold text-blue-600 lg:mb-0 hover:text-neutral-600"
                                title="read more"
                            >
                                Read More »
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <!-- Button trigger modal -->
            <button type="button" class="px-6
      py-2.5
      bg-blue-600
      text-white
      font-medium
      text-xs
      leading-tight
      uppercase
      rounded
      shadow-md
      hover:bg-blue-700 hover:shadow-lg
      focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-blue-800 active:shadow-lg
      transition
      duration-150
      ease-in-out" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Launch demo modal
            </button>
            <!-- Modal -->
            <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                 id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog relative w-auto pointer-events-none">
                    <div
                        class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                        <div
                            class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                            <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Modal title</h5>
                            <button type="button"
                                    class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body relative p-4">
                            Modal body text goes here.
                        </div>
                        <div
                            class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                            <button type="button" class="px-6
          py-2.5
          bg-purple-600
          text-white
          font-medium
          text-xs
          leading-tight
          uppercase
          rounded
          shadow-md
          hover:bg-purple-700 hover:shadow-lg
          focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0
          active:bg-purple-800 active:shadow-lg
          transition
          duration-150
          ease-in-out" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="px-6
      py-2.5
      bg-blue-600
      text-white
      font-medium
      text-xs
      leading-tight
      uppercase
      rounded
      shadow-md
      hover:bg-blue-700 hover:shadow-lg
      focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-blue-800 active:shadow-lg
      transition
      duration-150
      ease-in-out
      ml-1">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


<!--        <ul class="divide-y divide-gray-200">-->
<!--            <li v-for="(pokemon, id) in pokemonsData" :key="id" class="py-4 flex">-->
<!--                <img class="h-50 w-50 rounded-full" :src="pokemon.sprite_url" alt="" />-->
<!--                <div class="ml-3">-->
<!--                    <p class="text-lg font-medium text-blue-800">-->
<!--                        {{ pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1) }}-->
<!--                    </p>-->
<!--                    <p class="text-sm text-green-500">Base experience: {{ pokemon.base_experience }}</p>-->
<!--                    <p class="text-sm text-gray-400">Weight: {{ pokemon.weight }}</p>-->
<!--                    <p class="text-sm text-gray-400">Height: {{ pokemon.height }}</p>-->
<!--                    <p class="text-sm text-pink-700">Abilities: {{ pokemon.abilities.length }}</p>-->
<!--                </div>-->
<!--            </li>-->
<!--            <pagination :pagination="totalData" @page-changed="getPokemons"></pagination>-->
<!--        </ul>-->

    <div v-else class="mt-10 p-4 flex flex-wrap justify-center">
        <div class="text text-red-400">
            No Pokemons in your DB! Please execute command
            <code lang="php" class="text text-blue-400 ">php artisan acquire:fetch_data_from_pokemon_api</code>
        </div>
    </div>
    <div v-if="pokemonsLength" class="mt-10 p-4 flex flex-wrap justify-center">
        <pagination :pagination="totalData" @page-changed="getPokemons"></pagination>
    </div>
</template>
<script>
import {reactive, toRefs, computed, onMounted} from "vue";
import Pagination from "@/Components/Inertia/Pagination.vue ";

export default {
    name: 'Home',
    components: {Pagination},
    setup() {
        const state = reactive({
            pokemonsDataChunks: [],
            totalData: {},
            urlIdLookUp: {},
            text: "",
            pokemonsLength: 0,
            pokemonsData: [],
            getPokemons
            // filteredPokemons: computed(() => updatePokemons())
        });
        onMounted(getPokemons);

        // function updatePokemons() {
        //     if (!state.text) {
        //         return [];
        //     }
        //
        //     return state.pokemons.filter((pokemon) => pokemon.name.includes(state.text))
        // }

        function getPokemons(page = 1) {
            axios.get('/pokemons/api/v1/pokemons?page=' + page)
                .then((response) => {
                    // console.log(response.data.data)
                    state.totalData = response.data
                    state.pokemonsLength = response.data.data.length;
                    state.pokemonsData = response.data.data;
                    // state.urlIdLookUp = data.results.reduce(
                    //     (acc, cur, idx) =>
                    //     acc = {...acc, [cur.name]:idx+1},
                    //     {}
                    // )
                });
        }

        function sliceIntoChunks(setOfElements, chunkSize) {
            const res = [];
            for (let i = 0; i < setOfElements.length; i += chunkSize) {
                const chunk = setOfElements.slice(i, i + chunkSize);
                res.push(chunk);
            }
            return res;
        }




        return {... toRefs(state)}
    }
}
</script>
