<template>
    <div>
        <form id="mainForm" :action="computedAction" method="post">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" :value="csrf">
            <div class="form-group">
                <label for="InputISBN">ISBN</label>
                <input name="isbn" class="form-control" id="InputISBN" aria-describedby="isbnHelp"
                       placeholder="Enter ISBN" v-bind:value="book1.isbn">
            </div>
            <div class="form-group">
                <label for="InputTitle">Title</label>
                <input name="title" class="form-control" id="InputTitle" placeholder="Title" :value="book1.title">
            </div>
            <div class="form-group">
                <label for="InputEdition">Edition</label>
                <input name="edition" class="form-control" id="InputEdition" placeholder="Edition" :value="book1.edition">
            </div>
            <div class="form-group">
                <label for="InputAuthor">Author</label>
                <div class="input-group mb-3" style="padding-top: 10px">
                    <select name="author" class="form-control" id="InputAuthor">
                        <option selected :value="book1.author.id">{{book1.author.first_name}}
                            {{book1.author.middle_name}} {{book1.author.last_name}}</option>
                        <option v-for="author in authors1" :value="author.id">{{author.first_name}}
                            {{author.middle_name}} {{author.last_name}}
                        </option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#authorModal">Add
                </button>
            </div>
            <div class="form-group">
                <label for="InputGenre">Genre</label>
                <div class="input-group mb-3" style="padding-top: 10px">
                    <select name="genre" class="form-control" id="InputGenre">
                        <option selected :value="book1.genre.id">{{book1.genre.title}}</option>
                        <option v-for="genre in genres1" :value="genre.id">{{genre.title}}</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#genreModal">Add
                </button>
            </div>
            <div class="form-group">
                <label for="InputPrice">Price</label>
                <input name="price" class="form-control" id="InputPrice" placeholder="Price" :value="book1.price">
            </div>
            <div class="form-group">
                <label for="InputPublisher">Publisher</label>
                <div class="input-group mb-3" style="padding-top: 10px">
                    <select name="publisher_id" class="form-control" id="InputPublisher">
                        <option selected :value="prevpublisher1.id">{{ prevpublisher1.name }},
                            {{ prevpublisher1.street_address }}, {{ prevpublisher1.city }}, {{ prevpublisher1.district }}, {{
                            prevpublisher1.phone_number }}</option>
                        <option v-for="publisher in publishers1" :value="publisher.id">{{ publisher.name }},
                            {{ publisher.street_address }}, {{ publisher.city }}, {{ publisher.district }}, {{
                            publisher.phone_number }}
                        </option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#publisherModal">Add
                </button>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <button class="btn btn-primary" @click="cancel">Cancel</button>
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
                        <form id="author" ref="form" v-on:submit.prevent="onSubmitAuthor" name="authorForm">
                            <div class="form-group">
                                <label for="InputFirstName">First Name</label>
                                <input name="firstName" class="form-control" id="InputFirstName"
                                       placeholder="Enter First Name"/>
                            </div>
                            <div class="form-group">
                                <label for="InputMiddleName">Middle Name</label>
                                <input name="middleName" class="form-control" id="InputMiddleName"
                                       placeholder="Enter Middle Name"/>
                            </div>
                            <div class="form-group">
                                <label for="InputLastName">Last Name</label>
                                <input name="lastName" class="form-control" id="InputLastName"
                                       placeholder="Enter Last Name"/>
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
        <div class="modal fade" id="publisherModal" tabindex="-1" role="dialog" aria-labelledby="publisherModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="publisherModalLabel">Add Publisher</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="publisher" ref="form" v-on:submit.prevent="onSubmitPublisher">
                            <div class="form-group">
                                <label for="InputName">Name</label>
                                <input name="name" class="form-control" id="InputName"
                                       placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="InputStreetAddress">Street Address</label>
                                <input name="streetAddress" class="form-control" id="InputStreetAddress"
                                       placeholder="Enter Street Address">
                            </div>
                            <div class="form-group">
                                <label for="InputCity">City</label>
                                <input name="city" class="form-control" id="InputCity"
                                       placeholder="Enter City">
                            </div>
                            <div class="form-group">
                                <label for="InputDistrict">District</label>
                                <input name="district" class="form-control" id="InputDistrict"
                                       placeholder="Enter District">
                            </div>
                            <div class="form-group">
                                <label for="InputPhoneNumber">Phone Number</label>
                                <input name="phoneNumber" class="form-control" id="InputPhoneNumber"
                                       placeholder="Enter Phone Number">
                            </div>
                            <button type="submit" class="btn btn-primary" id="publisherButton">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" :action="computedDelete">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" :value="csrf">
            <div class="field">
                <div class="control">
                    <button type="submit" class="btn btn-secondary">Delete Book</button>
                </div>
            </div>

        </form>
    </div>
</template>

<script>
    export default {
        name: "EditBook",
        props: ['csrf', 'authors', 'genres', 'publishers', 'book', 'prevpublisher'],
        data() {
            return {
                myData: [],
                authors1: this.authors,
                genres1: this.genres,
                publishers1: this.publishers,
                book1: this.book,
                prevpublisher1: this.prevpublisher,
            }
        },
        computed:{
            computedAction() {
                return `/userbooks/${this.book1.id}`
            },
            computedDelete(){
                return `/userbooks/${this.book1.id}`
            }
        },
        methods: {
            cancel() {
              this.isVisible=false;
              window.open(`/userbooks/${this.book1.id}`, '_self')
            },
            computedAction() {
                return `/userbooks/${this.book1.id}`
            },
            onSubmitAuthor() {
                console.log('done');
                $('#authorModal').modal('toggle');
                // $('#authorButton').prop('disabled', true);
                $(document).on("submit", 'form#author', (e) => {
                    // e.preventDefault(); //Prevent page from submitting
                    let formData = {
                        'first_name': $('input[name=firstName]').val(),
                        'middle_name': $('input[name=middleName]').val(),
                        'last_name': $('input[name=lastName]').val(),
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "../../authors",
                        data: formData,
                    }).done((response) => {
                        console.log(typeof response);
                        console.log(typeof this.authors1);
                        this.authors1.push(response);
                        return false;
                    });
                });
                return false;
                // console.log('hello');
            },
            onSubmitGenre() {
                console.log('done');
                $('#genreModal').modal('toggle');
                // $('#genreButton').prop('disabled', true);
                $(document).on("submit", 'form#genre', (e) => {
                    // e.preventDefault(); //Prevent page from submitting
                    let formData = {
                        'title': $('input[name=genreTitle]').val(),
                        'description': $('textarea[name=genreDescription]').val(),
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "../../genres",
                        data: formData,
                    }).done((response) => {
                        this.genres1.push(response);
                        return false;
                    });
                });
                return false;
                // console.log('hello');
            },
            onSubmitPublisher() {
                console.log('done');
                $('#publisherModal').modal('toggle');
                $('#publisherButton').prop('disabled', true);
                $(document).on("submit", 'form#publisher', (e) => {
                    // e.preventDefault(); //Prevent page from submitting
                    let formData = {
                        'name': $('input[name=name]').val(),
                        'street_address': $('input[name=streetAddress]').val(),
                        'city': $('input[name=city]').val(),
                        'district': $('input[name=district]').val(),
                        'phone_number': $('input[name=phoneNumber]').val()
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "../../publishers",
                        data: formData,
                    }).done((response) => {
                        this.publishers1.push(response);
                        return false;
                    });
                });
                return false;
                // console.log('hello');
            },
        },
    }
</script>

<style scoped>

</style>