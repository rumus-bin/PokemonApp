<template>
    <section>
        <span class="mb-2 font-semibold mix-blend-color-burn">{{ title }}</span>
    </section>
    for
</template>

<script>
export default {
    name: "AssignmentsList",
    props: {
        title: {
            type: Text,
            default: 'Title'
        },
        assignments: {
            type: Array,
            default: []
        }
    }
}
</script>

<style scoped>

</style>
