<template>
    <div>
        {{ condition }}
        <button type="button" class="btn btn-primary" @click="isVisible = true">Add New Book</button>
        <div  style="padding-top: 10px">
        </div>
        <form v-if="isVisible" action="/userbooks" method="post">
            <input type="hidden" name="_token" :value="csrf">
            <div class="form-group">
                <label for="InputISBN">ISBN</label>
                <input name="isbn"  class="form-control" id="InputISBN" aria-describedby="isbnHelp"
                       placeholder="Enter ISBN">
            </div>
            <div class="form-group">
                <label for="InputTitle">Title</label>
                <input name="title" class="form-control" id="InputTitle" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="InputEdition">Edition</label>
                <input name="edition" class="form-control" id="InputEdition" placeholder="Edition">
            </div>
            <div class="form-group">
                <label for="InputAuthor">Author</label>
                <input name="author" class="form-control" id="InputAuthor" placeholder="Author">
            </div>
            <div class="form-group">
                <label for="InputGenre">Edition</label>
                <input name="genre" class="form-control" id="InputGenre" placeholder="Genre">
            </div>
            <div class="form-group">
                <label for="InputPrice">Price</label>
                <input name="price" class="form-control" id="InputPrice" placeholder="Price">
            </div>
            <div class="form-group">
                <label for="InputPublisher_id">Publisher ID</label>
                <input name="publisher_id" class="form-control" id="InputPublisher_id" placeholder="Publisher ID">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
            <button class="btn btn-primary" @click="isVisible = false">Cancel</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "AddComponent",
        props:['csrf','condition'],
        data() {
            return {
                isVisible: false,
            }
        },
    }
</script>

<style scoped>

</style>