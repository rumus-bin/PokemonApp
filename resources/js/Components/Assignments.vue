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
            assignments: [],
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
    },
    created() {
        axios('http://localhost:3001/assignments')
            .then(res => this.assignments = res.data);
    }
}
</script>

<style scoped>

</style>
