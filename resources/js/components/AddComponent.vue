<template>
    <div>
        <button type="button" class="btn btn-primary" @click="showForm">Add {{ type }}</button>
        {{ huh }}
        <form v-if="isVisible">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['type'],
        name: "AddComponent",
        data() {
            return {
                isVisible: false,
                type: this.type,
                huh: [],
                attributes: {
                    Book : [
                        'id', 'isbn', 'name', 'author', 'publisher_id'
                    ],
                    Genre: [
                        'id', 'title', 'description'
                    ],
                    Publisher: [
                        'id', 'name', 'address'
                    ],
                    Author:[
                        'id', 'name', 'address'
                    ]
                }
        }
        },
        methods: {
            showForm() {
                this.isVisible = true;
                switch (this.type) {
                    case 'Book':
                        this.huh = this.attributes.Book;
                        break;
                    case 'Genre':
                        // code block
                        break;
                    default:
                    // code block
                }
            }
        }
    }
</script>

<style scoped>

</style>