<template>
    <div>
        <div v-if="showAbility" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
            <div class="relative w-auto my-6 mx-auto max-w-6xl">
                <!--content-->
                <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    <div class="flex items-start justify-between p-5 rounded-t">
                        <h3>Abilities</h3>
                        <button
                            class="p-1 ml-auto bg-transparent border-0 text-black float-right text-3xl
                            leading-none font-semibold outline-none focus:outline-none" v-on:click="closeAbility()"
                        >
                          <span class=" text-red-300 h-6 w-6 text-2xl block outline-none focus:outline-none">
                            ×
                          </span>
                        </button>
                    </div>
                    <!--body-->
                    <div v-for="ability in abilities" class="relative mt-200 p-6 flex-auto border-b border-solid border-yellow-400">
                        <p class="my-4 text-blue-500 text-lg leading-relaxed">
                            Name: {{ability.name}}
                        </p>
                        <p class="my-4 text-blue-500 text-lg leading-relaxed">
                            Url: {{ability.url}}
                        </p>
                        <p class="my-4 text-blue-500 text-lg leading-relaxed">
                            Type: {{ability.is_hidden ? "Hidden" : "Not hidden"}}
                        </p>
                    </div>
                    <!--footer-->
                    <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
<!--                        <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="toggleModal()">-->
<!--                            Save Changes-->
<!--                        </button>-->
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showAbility" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
</template>

<script>
import {reactive, toRefs} from "vue";

export default {
        name: "Abilities",
        props: ["showAbility", "abilities"],
        setup (props, {emit}) {
            const state = reactive({
                closeAbility
            });
            function closeAbility () {
                emit('closeAbility');
            }

            return {... toRefs(state)}
        }
}
</script>
