<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // View All Users
    public function viewAllUsers()
    {
        // Assuming admin token is used
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    // View All Books
    public function viewAllBooks()
    {
        $books = Book::all();
        return response()->json(['books' => $books]);
    }

    // Delete a Book
    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }


}

