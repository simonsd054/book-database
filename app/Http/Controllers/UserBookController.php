<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Genre;
use App\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = auth()->user()->books;
        $allbooks = Book::all();
        $authors = Author::all();
        $genres = Genre::all();
        $publishers = Publisher::all();
        return view('users.index', compact('books', 'authors', 'genres', 'publishers', 'allbooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd(\request());
        $attributes = \request()->validate([
            'isbn' => 'required',
            'title' => 'required',
            'edition' => 'required',
            'genre'=>'required',
            'author'=>'required',
            'price' => 'required',
            'publisher_id'=>'required',
        ]);
//        dd($attributes);
        $id = Auth::id();
        $attributes = \array_diff_key($attributes, ['genre'=>'xy', 'author'=>'xy']);
//        dd($attributes);
        $book = Book::create($attributes);
        $book->genres()->attach(\request()->only(['genre']));
        $book->authors()->attach(\request()->only(['author']));
        $book->users()->attach($id);
//        $books = auth()->user()->books;
//        dd($books);
        $books = auth()->user()->books;
        return redirect('/userbooks')->with(['books' => $books]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrfail($id);
        $this->authorize('update', $book);
        return view('users.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        global $book;
        $book = Book::findOrfail($id);
        $book->author = $book->authors[0];
        $book->genre = $book->genres[0];
        $authors = Author::all();
        $genres = Genre::all();
        $publishers = Publisher::all();
        $akey = $authors->search(function($item) {
            global $book;
            return $item->id == $book->author->id;
        });
        $authors->forget($akey);
        $authors = $authors->values();
        $gkey = $genres->search(function($item) {
            global $book;
            return $item->id == $book->genre->id;
        });
        $genres->forget($gkey);
        $genres = $genres->values();
        $pkey = $publishers->search(function($item) {
            global $book;
            return $item->id == $book->publisher_id;
        });
        $publishers->forget($pkey);
        $publishers = $publishers->values();
        $prevPublisher = Publisher::findOrfail($book->publisher_id);
        return view('users.edit', compact('book','authors', 'genres', 'publishers', 'prevPublisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attributes = \request()->validate([
            'isbn' => 'required',
            'title' => 'required',
            'edition' => 'required',
            'genre'=>'required',
            'author'=>'required',
            'price' => 'required',
            'publisher_id'=>'required',
        ]);
        $attributes = \array_diff_key($attributes, ['genre'=>'xy', 'author'=>'xy']);
        $book = Book::findOrfail($id);
        $book->update($attributes);
        $book->genres()->sync(\request()->only(['genre']));
        $book->authors()->sync(\request()->only(['author']));
        return redirect('/userbooks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrfail($id);
        $book->delete();
        return redirect('/userbooks');
    }
}
