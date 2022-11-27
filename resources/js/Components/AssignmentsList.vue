<template>
    <section v-show="assignments.length" class="w-80">
        <div class="flex justify-between items-start">
            <h2 class="text-base text-2xl">
                {{ title }}
                <span>({{assignments.length}})</span>
            </h2>
            <button
                v-show="canToggle"
                @click="$emit('toggleView')"
            >&times;</button>
        </div>

        <AssignmentTag
            :initial-tags="assignments.map(a => a.tag)"
            v-model:currentTag="currentTag"
        >
        </AssignmentTag>
        <ul class="border border-gray-600 divide-y mt-4">
            <Assignment
                v-for="assignment in filteredAssignments"
                :key="assignment.id"
                :assignment="assignment"
            >
            </Assignment>
        </ul>
        <slot></slot>
    </section>
</template>

<script>
import Assignment from "@/Components/Assignment.vue";
import AssignmentTag from "@/Components/AssignmentTag.vue";

export default {
    name: "AssignmentsList",
    data () {
        return {
            currentTag: '',
            checkedTag: ''
        }
    },
    components: {
        Assignment,
        AssignmentTag
    },
    props: {
        assignments: Array,
        title: String,
        canToggle: {type: Boolean, default: false}
    },
    computed: {
        filteredAssignments() {
            if (this.currentTag && this.currentTag !== 'all') {
                return this.assignments.filter(a => a.tag === this.currentTag);
            }
            if (this.currentTag === 'all' || !this.currentTag) {
                return this.assignments;
            }
        }
    },
    methods: {
    }
}
</script>

<style scoped>

</style>
