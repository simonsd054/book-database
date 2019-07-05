@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>{{ $book->title }}</h3>
        isbn:{{ $book->isbn }}<br>
        edition:{{ $book->edition }}<br>
        price:{{ $book->price }}<br>
        publisher_id:{{ $book->publisher_id }}<br>
        <a href="/userbooks/{{ $book->id }}/edit">Edit</a>
    </div>
@endsection