<template>
    <div class="p-14">
        <h2>Hello from app Vue</h2>
        <assignments-list title="Assignments list" />
    </div>
</template>

<script>
import AssignmentsList from "@/Components/AssignmentsList.vue";
export default {
   name: "App",
    components: {
       AssignmentsList
    },
    data () {
       return {
           assignments: [
               {id: 1, title: "First Assignment", completed: false},
               {id: 2, title: "Second Assignment", completed: false},
               {id: 3, title: "Third Assignment", completed: false},
           ]
       }
    }
}
</script>

<style scoped>

</style>
