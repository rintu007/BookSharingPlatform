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


        // Build the query to find books within 10 km of the logged-in user
        $query = DB::table('books')
            ->join('users', 'books.user_id', '=', 'users.id')
            ->selectRaw('books.*, ST_Distance_Sphere(point(users.longitude, users.latitude), point(?, ?)) / 1000 AS distance_km', [$user->longitude, $user->latitude])
            ->where('books.user_id', '!=', $user->id)  // Exclude the logged-in user's books
            ->havingRaw('distance_km < ?', [10]);



        // Output the raw SQL query
        $sql = $query->toSql();
        \Log::info('Executed SQL Query: ' . $sql);  // Log the query to the Laravel log file
        // Or simply echo the query for debugging
        // dd($sql);

        // Execute the query and get the result
        $books = $query->get();



        return response()->json($books);
    }


}
