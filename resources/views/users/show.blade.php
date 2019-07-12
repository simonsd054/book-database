@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>{{ $book->title }}</h3>
        <div>
            <ul class="list-group">
                <li class="list-group-item">ISBN: {{ $book->isbn }}</li>
                <li class="list-group-item">Edition: {{ $book->edition }}</li>
                <li class="list-group-item">
                    Author: {{ $book->author->first_name }} {{ $book->author->middle_name }} {{ $book->author->last_name }}</li>
                <li class="list-group-item">Genre: {{ $book->genre->title }}</li>
                <li class="list-group-item">Price: {{ $book->price }}</li>
                <li class="list-group-item">Publisher: {{ $book->publisher->name }}
                    , {{ $book->publisher->street_address }}, {{ $book->publisher->city }}
                    , {{ $book->publisher->district }}, {{ $book->publisher->phone_number }}</li>
            </ul>
        </div>
        <br>
        <div>
            <button class="btn btn-outline-primary" onclick="window.open('{{route('userbooks.edit', $book->id)}}','_self')">Edit</button>
        </div>
    </div>
@endsection