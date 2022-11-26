<template>
    <div class="flex gap-2 mt-2">
        <button
            @click="checkTag(tag)"
            v-for="tag in tags"
            class="border rounded px-1 py-1 text-xs"
            :class="{
                    'border-blue-500 text-blue-500': tag === currentTag
                }"
        >{{tag}}</button>
    </div>
</template>

<script>
export default {
    name: "AssignmentTag",
    data () {
      return {
          currentTag: ''
      }
    },
    props: {
        initialTags: Array
    },
    computed: {
        tags() {
            return ['all', ...new Set(this.initialTags)];
        }
    },
    methods: {
        checkTag (tag) {
            if (this.currentTag === tag || tag === 'all') {
                this.currentTag = '';
            } else {
                this.currentTag = tag
            }
            this.$emit('checkTag', this.currentTag)
        }
    }
}
</script>

<style scoped>

</style>
