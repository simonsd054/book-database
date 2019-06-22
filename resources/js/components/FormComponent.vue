<template>
    <div>
        {{ title }}
    </div>
</template>

<script>
    export default {
        props : ['title'],
        name: "FormComponent",
        data(){
            return {
                title: this.title
            }
        }
    }
</script>

<style scoped>

</style>