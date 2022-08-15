import {createRouter, createWebHistory} from "vue-router";
import PokemonIndex from "@/Components/PokemonIndex.vue";

const routes = [
    {
        path: '/pokemons',
        name: 'PokemonsIndex',
        component: PokemonIndex
    },
    {
        path: '/about_pokemon/:pokemon_id',
        name: 'About',
        component: () => import('../Components/AboutPokemon.vue')
    }

];

const router  = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
})

export default router;
