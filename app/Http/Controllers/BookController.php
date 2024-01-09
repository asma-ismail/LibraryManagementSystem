<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $book = new Book($validated);
        $book->save();
        return response($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
            'ISBN' => 'somtimes|string|max:10|min:10',
            'language' => 'sometimes|string',
            'cover' => 'string|sometimes',
            'membership_id' => 'sometimes|exists:memberships,id', //evaluate this performance wise
            'publisher' => 'sometimes|string',
            'date_of_publication' => 'sometimes|date',
            'path' => 'sometimes|string|max:255',
        ]);

        $book = Book::find($id);
        $book->update($validated);
        return $book;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $book = Book::find($id)->delete();
        return $book;
    }
}
