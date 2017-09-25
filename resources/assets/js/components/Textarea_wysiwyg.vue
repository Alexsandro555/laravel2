<template>
   <textarea name="" id="" rows="10" cols="80"></textarea>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                greeting: 'Hellow'
            }
        },
    }
</script>

<style scoped>
    p {
        font-size: 2em;
        text-align: center;
    }
</style>