<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $author = new Author();
        $author->name = $request->input('name');
        $author->birth_date = $request->input('birth_date');

        if($author->save()){
            return redirect()->route('authors.index')->with('notice', 'Save Successfully');
        }else{
            return redirect()->route('authors.create')->with('alert', 'Failed to Save');
        };
    }

    public function show(string $id)
    {
        
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, string $id)
    {
        $author = Author::findOrFail($id);
        $author->name = $request->input('name');
        $author->birth_date = $request->input('birth_date');

        if($author->save()){
            return redirect()->route('authors.index')->with('notice', 'Update Successfully');
        }else{
            return redirect()->route('authors.edit', $id)->with('alert', 'Failed to Update');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
