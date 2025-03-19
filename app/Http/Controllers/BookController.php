<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::All();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        $authors = Author::All();
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {   
        $book = new Book();
        $book->author_id = $request->input('author_id');
        $book->title = $request->input('title');
        $book->published_date = $request->input('published_date');
        
        if($book->save()){
            return redirect()->route('books.index');
        }else{
            return redirect()->route('books.create');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $authors = Author::All();
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book','authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, string $id)
    {
        $book = Book::findOrFail($id);
        $book->title = $request->input('title');
        $book->author_id = $request->input('author_id');
        $book->published_date = $request->input('published_date');

        if($book->update()){
            return redirect()->route('books.index');
        }else{
            return redirect()->route('books.edit', $id);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        if($book->delete()){
            return redirect()->route('books.index');
        }
    }
}
