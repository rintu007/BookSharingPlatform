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

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // For token-based auth:
            $token = Auth::guard('admin')->user()->createToken('admin-token')->plainTextToken;
            return response()->json(['token' => $token]);

            // For session-based auth:
            // return redirect('/admin/dashboard');
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}

