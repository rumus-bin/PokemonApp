<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Inertia/Pagination.vue';

defineProps({pokemons: Array});

const form = useForm();

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('pokemons.destroy', id));
    }

}


</script>

<template>
    <Head title="Acquire test task" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Aciquire test task index page
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

<!--                        <div className="flex items-center justify-between mb-6">-->
<!--                            <Link-->
<!--                                className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"-->
<!--                                :href="route('posts.create')"-->
<!--                            >-->
<!--                                Create Post-->
<!--                            </Link>-->
<!--                        </div>-->

                        <table className="table-fixed w-full">
                            <thead>
                            <tr className="bg-gray-100">
                                <th className="px-4 py-2 w-20">Source ID</th>
                                <th className="px-4 py-2 w-20">Sprite</th>
                                <th className="px-4 py-2">Name</th>
                                <th className="px-4 py-2">Height</th>
                                <th className="px-4 py-2">Weight</th>
                                <th className="px-4 py-2">Type</th>
                                <th className="px-4 py-2">Order</th>
                                <th className="px-4 py-2">Base experience</th>
<!--                                <th className="px-4 py-2">Abilities</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="pokemon in pokemons.data">
                                <td className="border px-4 py-2">{{ pokemon.source_id }}</td>
                                <td className="border px-4 py-2">
                                    <img :src="pokemon.sprite_url" alt="sprite">
                                </td>
                                <td className="border px-4 py-2">{{ pokemon.name }}</td>
                                <td className="border px-4 py-2">{{ pokemon.height }}</td>
                                <td className="border px-4 py-2">{{ pokemon.weight }}</td>
                                <td className="border px-4 py-2">{{ pokemon.is_default }}</td>
                                <td className="border px-4 py-2">{{ pokemon.order }}</td>
                                <td className="border px-4 py-2">{{ pokemon.base_experience }}</td>
<!--                                <td className="border px-4 py-2">{{ pokemon.abilities }}</td>-->
                                <td className="border px-4 py-2">
<!--                                    <Link-->
<!--                                        tabIndex="1"-->
<!--                                        className="px-4 py-2 text-sm text-white bg-blue-500 rounded"-->
<!--                                        :href="route('posts.edit', post.id)"-->
<!--                                    >-->
<!--                                        Edit-->
<!--                                    </Link>-->

                                    <button
                                        @click="destroy(pokemon.id)"
                                        tabIndex="-1"
                                        type="button"
                                        className="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <pagination :pagination="pokemons"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
