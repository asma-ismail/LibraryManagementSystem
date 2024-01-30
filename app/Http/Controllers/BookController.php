<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Membership;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Response;

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
            'cover' => 'file',
            'membership_id' => 'required|exists:memberships,id', //evaluate this performance wise
            'publisher' => 'required|string',
            'date_of_publication' => 'required|date',
            'path' => 'required|max:255',
        ]);

        $book = new Book($validated);
        $book->path = $request->file('path')->getClientOriginalName();
        $book->cover = $request->file('cover')->getClientOriginalName();
        $request->cover->move(public_path('images'), $book->cover);
        $path = Storage::disk('local')->put($request->file('path')->getClientOriginalName(), $request->file('path')->get());
        $book->save();
        return redirect()->route('admin.books.index');
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
    public function update(Request $request, string $lang, string $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'genre_id' => 'sometimes|exists:genres,id',
            'author' => 'sometimes|string|max:255',
            'ISBN' => 'sometimes|string|max:10|min:10',
            'language' => 'sometimes|string',
            'cover' => 'sometimes',
            'membership_id' => 'sometimes|exists:memberships,id', //evaluate this performance wise
            'publisher' => 'sometimes|string',
            'date_of_publication' => 'sometimes|date',
            'path' => 'sometimes|max:255',
        ]);
        $book = Book::find($id);
        $book->update($validated);
        return redirect()->route('admin.books.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $lang, $id)
    {

        $book = Book::find($id)->delete();
        return redirect()->route('admin.books.index');
    }

    public function listAllFavouriteBooks()
    {

        $favourite = User::find(Auth::id())->books()->paginate(6);
        return view('users.list-user-books', compact('favourite'));
    }

    public function allBooks(Request $request)
    {
        if (!$request->s && !$request->filter) {
            $books = Book::latest()->paginate(6);
            return view('users.books', compact('books'));

        }
        $books = new Book();
        if ($request->s) {
            $books = $books->where('title', 'LIKE', '%' . $request->s . '%');
        }
        if ($request->filter) {
            $books = $books->where('membership_id', $request->filter);
        }
        $books = $books->paginate(9);
        return view('users.books', compact('books'));
    }

    public function showBook(string $lang, string $id)
    {

        $book = Book::find($id);

        $isFav = $book->isFavotiteBook(Auth::id());
        return view('users.show-book', compact('book', 'isFav'));
    }

    public function getBook($lang, $book)
    {
        $book = Book::find($book);
        if (!Gate::allows('view-book', $book)) {
            return abort(403);
        }
        $path = storage_path('app/' . $book->path);

        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $path . '"',
        ]);

    }
    public function getBookAdmin($lang, $book)
    {
        $book = Book::find($book);
        $path = storage_path('app/' . $book->path);
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $path . '"',
        ]);

    }

    public function addToFavorites($lang, $id)
    {

        User::find(Auth::id())->books()->attach($id);
        return redirect()->back();

    }
    public function removeFromFavorites($lang, $id)
    {

        User::find(Auth::id())->books()->detach($id);
        return redirect()->back();

    }

}
