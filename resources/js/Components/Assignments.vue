<template>
    <section class="space-y-6">
        <AssignmentsList v-if="filters.active.length" :assignments="filters.active" title="Active assignments"></AssignmentsList>
        <AssignmentsList v-if="filters.completed.length" :assignments="filters.completed" title="Completed assignments"></AssignmentsList>

        <AssignmentCreate @add="add"></AssignmentCreate>
    </section>

</template>

<script>
import AssignmentsList from "@/Components/AssignmentsList.vue";
import AssignmentCreate from "@/Components/AssignmentCreate.vue";

export default {
    name: "Assignments",
    components: {
      AssignmentsList,
      AssignmentCreate
    },
    data () {
        return {
            assignments: [
                {id: 1, name: 'First assignments', completed: false, tag: 'science'},
                {id: 2, name: 'Second assignments', completed: false, tag: 'biology'},
                {id: 3, name: 'Third assignments', completed: false, tag: 'design'}
            ],
        }
    },
    computed: {
        filters () {
            return {
                active: this.assignments.filter((assignment) => {return !assignment.completed}),
                completed: this.assignments.filter((assignment) => {return assignment.completed})
            }
        }
    },
    methods: {
        add (name) {
            this.assignments.push({
                name: name,
                completed: false,
                id: this.assignments.length++
            });
        }
    }
}
</script>

<style scoped>

</style>
