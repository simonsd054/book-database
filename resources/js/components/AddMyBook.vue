<template>
    <div class="container">
        <button type="button" class="btn btn-primary" @click="isVisible = true">Add My Book</button>
        <div style="padding-top: 10px"></div>
        <div v-if="isVisible">
            <form action="/userbooks/existing" method="post">
                <input type="hidden" name="_token" :value="csrf">
                <div class="input-group mb-3" style="padding-top: 10px">
                    <select class="custom-select" name="book">
                        <option selected disabled>Choose...</option>
                        <option v-for="book in books1" :value="book.id">
                                {{ book.title }}
                                  {{ book.isbn }}
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
                <button class="btn btn-primary" @click="isVisible = false">Cancel</button>
            </form>
            <add-book condition="If the book is not listed above" :csrf="csrf" :authors="authors" :genres="genres"
                      :publishers="publishers"></add-book>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddMyBook",
        props: ['csrf', 'authors', 'genres', 'publishers', 'books'],
        data() {
            return {
                isVisible: false,
                books1: this.books,
            }
        }
    }
</script>

<style scoped>

</style>