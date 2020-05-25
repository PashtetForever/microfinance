<template>
    <div>
        <h1>{{h1}}</h1>
        <h2>{{h2}}</h2>
    </div>
</template>

<script>
    export default {
        props: ['h1', 'h2'],
        name: "Headers"
    }
</script>

<style scoped>

</style>