@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>My Books</h3>
        <div class="list-group list-group-flush">
            @foreach($books as $book)
                <a href="/userbooks/{{ $book->id }}" class="d-flex justify-content-between align-items-center list-group-item list-group-item-action">
                    {{ $book->title }}, {{$book->authors[0]->last_name}}<span class="badge badge-primary badge-pill" style="font-size: 15px">isbn: {{ $book->isbn }}</span> </a>
            @endforeach
        </div>
        <div style="padding-top: 10px;"></div>
        <add-my-book csrf="{{ csrf_token() }}" :books="{{ $allbooks }}" :authors="{{ $authors }}" :genres="{{ $genres }}" :publishers="{{ $publishers }}"></add-my-book>
    </div>
@endsection

<script>
    import AddMyBook from "../../js/components/AddMyBook";

    export default {
        components: {AddMyBook},
    }
</script>