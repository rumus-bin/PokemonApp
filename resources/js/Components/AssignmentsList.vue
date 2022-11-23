<template>
    <section>
        <h2 class="text-base text-2xl">{{ title }}</h2>
        <ul class="border border-gray-600 divide-y">
            <Assignment
                v-for="assignment in assignments"
                :key="assignment.id"
                :assignment="assignment"
            >
            </Assignment>
        </ul>
    </section>
</template>

<script>
import Assignment from "@/Components/Assignment.vue";
export default {
    name: "AssignmentsList",
    components: {
      Assignment
    },
    props: {
        assignments: Array,
        title: String
    }

}
</script>

<style scoped>

</style>
