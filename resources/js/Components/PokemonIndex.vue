<template>
    <div class="w-full flex justify-center">
<!--        <input-->
<!--            type="text"-->
<!--            placeholder="Enter pokemon name here"-->
<!--            class="mt-10 p-2 border-blue-500 border-2"-->
<!--            v-model="text"-->
<!--        />-->
    </div>
    <section v-if="pokemonsLength" class="mt-10 p-4 grid grid-cols-3 justify-center">
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
<!--        <pagination :pagination="totalData" @page-changed="getPokemons"></pagination>-->
    </div>
</template>
<script>
import {reactive, toRefs, computed, onMounted} from "vue";
// import Pagination from "@/Components/Inertia/Pagination.vue ";

export default {
    name: 'Home',
    // components: {Pagination},
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
