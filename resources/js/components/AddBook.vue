<template>
    <div>
        {{ condition }}
        <button type="button" class="btn btn-primary" @click="isVisible = true">Add New Book</button>
        <div style="padding-top: 10px">
        </div>
        <form id="mainForm" v-if="isVisible" action="/userbooks" method="post">
            <input type="hidden" name="_token" :value="csrf">
            <div class="form-group">
                <label for="InputISBN">ISBN</label>
                <input name="isbn" class="form-control" id="InputISBN" aria-describedby="isbnHelp"
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
                <div>
                    <input name="author" class="form-control" id="InputAuthor" placeholder="Author">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#authorModal">Add
                    </button>
                </div>
                {{myData}}
            </div>
            <div class="form-group">
                <label for="InputGenre">Genre</label>
                <input name="genre" class="form-control" id="InputGenre" placeholder="Genre">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#genreModal">Add
                </button>
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
        <div class="modal fade" id="authorModal" tabindex="-1" role="dialog" aria-labelledby="authorModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="authorModalLabel">Add Author</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="author" ref="form" v-on:submit.prevent="onSubmitAuthor">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group">
                                <label for="InputFirstName">First Name</label>
                                <input name="firstName" class="form-control" id="InputFirstName"
                                       placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                                <label for="InputMiddleName">Middle Name</label>
                                <input name="middleName" class="form-control" id="InputMiddleName"
                                       placeholder="Enter Middle Name">
                            </div>
                            <div class="form-group">
                                <label for="InputLastName">Last Name</label>
                                <input name="lastName" class="form-control" id="InputLastName"
                                       placeholder="Enter Last Name">
                            </div>
                            <button type="submit" class="btn btn-primary" id="authorButton">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="genreModal" tabindex="-1" role="dialog" aria-labelledby="genreModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="genreModalLabel">Add Genre</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="genre" ref="form" v-on:submit.prevent="onSubmitGenre">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group">
                                <label for="InputGenreTitle">Genre Title</label>
                                <input name="genreTitle" class="form-control" id="InputGenreTitle"
                                       placeholder="Enter Genre Title">
                            </div>
                            <div class="form-group">
                                <label for="InputGenreDescription">Genre Description</label>
                                <textarea name="genreDescription" class="form-control" id="InputGenreDescription"
                                          placeholder="Enter Genre Description"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="genreButton">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        name: "AddComponent",
        props: ['csrf', 'condition', 'old'],
        data() {
            return {
                isVisible: false,
                myData: [],
            }
        },
        methods: {
            onSubmitAuthor() {
                console.log('done');
                $('#authorModal').modal('toggle');
                // $('#authorButton').prop('disabled', true);
                $(document).on("submit", 'form#author', (e) => {
                    // e.preventDefault(); //Prevent page from submitting
                    let form = $(this);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "authors",
                        cache: false,
                        data: form.serialize(),
                    }).done((response) => {
                        console.log('hello');
                        this.myData.push('hello');
                        return false;
                    });
                });
                return false;
                // console.log('hello');
            },
            onSubmitGenre() {
                console.log('done');
                $('#genreModal').modal('toggle');
                $('#genreButton').prop('disabled', true);
                $(document).on("submit", 'form#genre', (e) => {
                    // e.preventDefault(); //Prevent page from submitting
                    let form = $(this);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "genre",
                        cache: false,
                        data: form.serialize(),
                    }).done((response) => {
                        console.log('hello');
                        this.myData.push('hello');
                        return false;
                    });
                });
                return false;
                // console.log('hello');
            }
        }
    }
</script>


<style scoped>

</style>