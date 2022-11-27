<template>
    <section class="space-y-6 flex gap-8">
        <AssignmentsList
            v-if="filters.active.length"
            :assignments="filters.active"
            title="Active assignments"
        >
            <AssignmentCreate @add="add"></AssignmentCreate>
        </AssignmentsList>
        <AssignmentsList
            v-show="canShow"
            v-if="filters.completed.length"
            :assignments="filters.completed"
            title="Completed assignments"
            can-toggle
            @toggleView="canShow = !canShow"
        >

        </AssignmentsList>

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
            canShow: true
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
