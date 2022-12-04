<template>
    <div class="flex justify-end">
        <button @click="changeTheme"><i class="gg-dark-mode"></i></button>
    </div>

    <section class="space-y-6 flex gap-8 justify-items-stretch">
        <Button />
        <AssignmentsList
            :theme="theme"
            v-if="filters.active.length"
            :assignments="filters.active"
            title="Active assignments"
        >
            <AssignmentCreate @add="add"></AssignmentCreate>
        </AssignmentsList>
        <AssignmentsList
            :theme="theme"
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
import Button from "@/Components/Button.vue";

export default {
    name: "Assignments",
    components: {
        AssignmentsList,
        AssignmentCreate,
        Button
    },
    data () {
        return {
            assignments: [],
            canShow: true,
            theme: 'dark'
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
        },
        changeTheme() {
            this.theme = this.theme === 'dark' ? 'light' : 'dark';
        }
    },
    created() {
        axios('http://localhost:3001/assignments')
            .then(res => this.assignments = res.data);
    }
}
</script>

<style scoped>
.gg-dark-mode {
    box-sizing: border-box;
    position: relative;
    display: block;
    transform: scale(var(--ggs,1));
    border:2px solid;
    border-radius:100px;
    width:20px;
    height:20px
}

.gg-dark-mode::after,
.gg-dark-mode::before {
    content: "";
    box-sizing: border-box;
    position: absolute;
    display: block
}

.gg-dark-mode::before {
    border:5px solid;
    border-top-left-radius:100px;
    border-bottom-left-radius:100px;
    border-right: 0;
    width:9px;
    height:18px;
    top:-1px;
    left:-1px
}

.gg-dark-mode::after {
    border:4px solid;
    border-top-right-radius:100px;
    border-bottom-right-radius:100px;
    border-left: 0;
    width:4px;
    height:8px;
    right:4px;
    top:4px
}
</style>
