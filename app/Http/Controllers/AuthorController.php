<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $query = Author::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $authors = $query->paginate(10);
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
        ]);

        return response()->json(['message' => 'Author added successfully!', 'author' => $author], 200);
    }

    public function show(string $id)
    {

    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.edit', compact('author'));
    }

    public function update(StoreAuthorRequest $request, string $id)
    {
        $author = Author::findOrFail($id);
        $author->name = $request->input('name');
        $author->birth_date = $request->input('birth_date');

        if ($author->save()) {
            return redirect()->route('authors.index');
        } else {
            return redirect()->route('authors.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::findOrFail($id);

        if ($author->delete()) {
            return redirect()->route('authors.index');
        }
    }
}
