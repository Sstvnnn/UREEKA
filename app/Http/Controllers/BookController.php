<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function viewBooksAPI() {
        $books = Book::all();
        return response()->json($books);
    }

//    public function showAdminList() {
//        $books = Book::all();
//        return view('admin-dashboard', ['books' => $books]);
//    }
//
//    public function addBook(Request $request) {
//        $book = Book::create([
//           'title' => $request->title,
//           'isbn' => $request->isbn,
//           'author' => $request->author,
//           'publication_year' => $request->publication_year,
//        ]);
//
//        if ($book) {
//            return response()->json($book);
//        }
//    }

    public function addBookAPI(Request $request) {
        $validated = $request->validate([
            'title' => 'required',
            'isbn' => 'required',
            'author' => 'required|string',
            'publication_year' => 'required|integer|min:1600|max:2024',
        ]);

        $book = Book::create([
            'title' => $validated['title'],
            'isbn' => $validated['isbn'],
            'author' => $validated['author'],
            'publication_year' => $validated['publication_year'],
        ]);

        if ($book) {
            return response()->json($book);
        } else {
            return response()->json('Book creation failed');
        }
    }

    public function removeBookAPI($id) {
        $book = Book::findOrFail($id);
        if ($book) {
            $book->delete();
            return response()->json('Book has been deleted');
        } else {
            return response()->json('Book not found');
        }
    }

    public function updateBookAPI(Request $request, $id) {
        $book = Book::findOrFail($id);



        if ($request->title) {
            $book->update([
                'title' => $request->title
            ]);
        }

        if ($request->author) {
            $book->update([
               'author' => $request->author
            ]);
        }

        if ($request->isbn) {
            $book->update([
                'isbn' => $request->isbn
            ]);
        }

        if ($request->publication_year) {
            $book->update([
                'publication_year' => $request->publication_year
            ]);
        }
//        $book->update([
//            'title' => $request->title,
//            'isbn' => $request->isbn,
//            'author' => $request->author,
//            'publication_year' => $request->publication_year
//        ]);
        $book->save();
        return response()->json($book);
    }
}
