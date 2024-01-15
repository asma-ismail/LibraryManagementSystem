<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Membership;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->s) {

            $books = Book::where('title', 'LIKE', '%' . $request->s . '%')->paginate(10);

        } else {
            $books = Book::latest()->paginate(10);
        }
        return view('admin.books', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::select('name')->get();
        $mem_counter = 1;

        $gen_counter = 1;
        $view = false;
        $memberships = Membership::select('title')->get();
        return view('admin.create-books', compact('genres', 'memberships', 'mem_counter', 'gen_counter', 'view'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'author' => 'required|string|max:255',
            'ISBN' => 'required|string|max:10|min:10',
            'language' => 'required|string',
            'cover' => 'string|sometimes',
            'membership_id' => 'required|exists:memberships,id', //evaluate this performance wise
            'publisher' => 'required|string',
            'date_of_publication' => 'required|date',
            'path' => 'required|string|max:255',
        ]);

        // $book = new Book($validated);
        $book = new Book($request->all());
        $book->save();
        return response()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $lang, string $id)
    {
        $book = Book::find($id);
        $genres = Genre::select('name')->get();
        $mem_counter = 1;

        $gen_counter = 1;
        $view = true;
        $memberships = Membership::select('title')->get();
        return view('admin.create-books', compact('book', 'genres', 'memberships', 'mem_counter', 'gen_counter', 'view'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'genre_id' => 'sometimes|exists:genres,id',
            'author' => 'sometimes|string|max:255',
            'ISBN' => 'sometimes|string|max:10|min:10',
            'language' => 'sometimes|string',
            'cover' => 'string|sometimes',
            'membership_id' => 'sometimes|exists:memberships,id', //evaluate this performance wise
            'publisher' => 'sometimes|string',
            'date_of_publication' => 'sometimes|date',
            'path' => 'sometimes|string|max:255',
        ]);
        dd("success");
        $book = Book::find($id);
        $book->update($validated);
        return $book;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $lang, $id)
    {

        $book = Book::find($id)->delete();
        return redirect()->back();
    }
}
