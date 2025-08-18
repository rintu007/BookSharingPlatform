<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }



    // Share a Book
    public function shareBook(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'required|string',
        ]);

        $book = new Book();
        $book->title = $validated['title'];
        $book->author = $validated['author'];
        $book->description = $validated['description'];
        $book->user_id = auth()->id();
        $book->save();

        return response()->json(['message' => 'Book shared successfully', 'book' => $book], 201);
    }


    public function getNearbyBooks()
    {
        // Get the logged-in user's latitude and longitude
        $user = Auth::user();

        // Ensure the user has latitude and longitude set
        if (!$user->latitude || !$user->longitude) {
            return response()->json(['message' => 'User location not set.'], 400);
        }


        $books = Book::nearby($user->latitude, $user->longitude, 10)
            ->with('user')  // eager load the user
            ->get();


        return response()->json($books);
    }


}
