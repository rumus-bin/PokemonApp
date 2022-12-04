<template>
    <Panel :theme="theme" v-show="assignments.length">
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
                :theme="theme"
                v-for="assignment in filteredAssignments"
                :key="assignment.id"
                :assignment="assignment"
            >
            </Assignment>
        </ul>
        <slot></slot>
    </Panel>
</template>

<script>
import Assignment from "@/Components/Assignment.vue";
import AssignmentTag from "@/Components/AssignmentTag.vue";
import Panel from "@/Components/Panel.vue";

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
        AssignmentTag,
        Panel
    },
    props: {
        assignments: Array,
        title: String,
        canToggle: {type: Boolean, default: false},
        theme: String
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
