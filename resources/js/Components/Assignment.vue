<template>
    <li>
        <label class="p-2 flex justify-between items-center">
            {{assignment.name}}
            <input type="checkbox" v-model="assignment.completed" class="ml-2">
        </label>
    </li>
</template>

<script>
export default {
    name: "Assignment",
    props: {
        assignment: Object
    }
}
</script>

<style scoped>

</style>
