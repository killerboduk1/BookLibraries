<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BooksResource;
use App\Http\Resources\BorrowingResource;
use App\Http\Resources\LibraryResource;
use App\Http\Resources\UserResource;
use App\Models\Borrowing;
use App\Models\Library;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function books()
    {
        return BooksResource::collection(Book::with('library')->get());
    }

    public function borrowing()
    {
        return BorrowingResource::collection(Borrowing::with('book','user')->get());
    }

    public function library()
    {
        return LibraryResource::collection(Library::with('books','users')->get());
    }

    public function user()
    {

        return UserResource::collection(User::with('borrowings','library')->get());
    }

    public function borrow(Request $request)
    {
        $validated = $request->validate([
            'book' => 'required|numeric',
            'userid' => 'required|numeric',
        ]);

        try {

            //get info
            $book = Book::find($request->book);
            $user = User::find($request->userid);

            //check for Security (i.e. users can only borrow a book belonging to their library)
            if($book->library_id == $user->library_id){

                $checkDuplicate = Borrowing::query()
                ->where('user_id', $request->book)
                ->where('book_id', $request->userid)
                ->exists();

                if ($checkDuplicate) {
                    return response()->json([
                        'error' => 'Duplicate entry'
                    ]);
                }

                $insert = Borrowing::insert([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                ]);

                if($insert){
                    $book->status = "unavailable";
                    $book->save();
                }

                return response()->json([
                    'success' => 'Book borrowed!'
                ]);
            }else{
                return response()->json([
                    'error' => 'Not allowed to borrowed!'
                ]);
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
