@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>My Books</h3>
        <ul class="list-group">
            @foreach($books as $book)
                <li class="list-group-item"><a href="">{{ $book }}</a></li>
            @endforeach
        </ul>
        <div style="padding-top: 10px;"></div>
        <add-my-book csrf="{{ csrf_token() }}"></add-my-book>
    </div>
@endsection

<script>
    import AddMyBook from "../../js/components/AddMyBook";
    export default {
        components: {AddMyBook}
    }
</script>