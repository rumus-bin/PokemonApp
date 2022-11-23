<template>
    <form @submit.prevent="add">
        <div class="border border-grey-600 text-black">
            <input v-model="newAssigment" placeholder="New assigment ... " class="p-2" />
            <button type="submit" class="bg-white p-2 border-l">Add</button>
        </div>

    </form>
</template>

<script>
export default {
    name: "AssignmentCreate",
    // props: {
    //     assignments: Array
    // },
    data() {
        return {
            newAssigment: ''
        }
    },
    methods: {
        add () {
            if (!this.newAssigment) {
                return;
            }
            this.$emit('add', this.newAssigment)
            this.newAssigment = '';
        }
    }
}
</script>

<style scoped>

</style>
