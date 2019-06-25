<template>
    <div>
        <button type="button" class="btn btn-primary" @click="isVisible = true">Add My Book</button>
        <div style="padding-top: 10px"></div>
        <div v-if="isVisible">
            <form action="/userbooks" method="post">
                <input type="hidden" name="_token" :value="csrf">
            <div class="input-group mb-3" style="padding-top: 10px">
                <select class="custom-select" id="inputGroupSelect01">
                    <option selected>Choose...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
                <button type="submit" class="btn btn-primary">Add</button>
                <button class="btn btn-primary" @click="isVisible = false">Cancel</button>
            </form>
            <add-book condition="If the book is not listed above" :csrf="csrf"></add-book>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddMyBook",
        props:['csrf'],
        data() {
            return {
                isVisible: false
            }
        }
    }
</script>

<style scoped>

</style>