<template>
    <div>
        <button
            @click="flash('Hello', 'It\'s works!!!', 'info')"
            class="border rounded p-2 mt-4"
        >
            Click me
        </button>
    </div>
</template>

<script setup>
    import {useFlash} from "@/composibles/useFlash";

    let {flash} = useFlash();
</script>

<style scoped>

</style>
