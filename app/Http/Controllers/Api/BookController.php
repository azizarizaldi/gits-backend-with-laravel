<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $data = Book::with('author')->get();

        return response()->json([
            'message' => 'Data successfully displayed',
            'data'    => $data,
            'status'  => true
        ]);
    }

    public function show(Book $book)
    {
        return response()->json([
            'message' => 'Data successfully displayed',
            'data'    => $book,
            'status'  => true
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [ 
                'title'      => 'required',
                'author_id'  => 'required',
            ]
        );

        if($validator->fails()){
            return response()->json([
                'message' => 'Please fill out the form completely',
                'data'    => $validator->errors(),
                'status'  => false
            ]);
        }else{
            Book::create([
                'title'          => $request->title,
                'author_id'     => $request->author_id,
            ]);

            return response()->json([
                'message' => 'Data added successfully',
                'status'  => true
            ]);
        }
    }

    public function update(Request $request, Book $book)
    {
        $validator = Validator::make(
            $request->all(),
            [ 
                'title'      => 'required',
                'author_id'  => 'required',
            ]
        );


        if($validator->fails()){
            return response()->json([
                'message' => 'Please fill out the form completely',
                'data'    => $validator->errors(),
                'status'  => false
            ]);
        }else{
            $book->update([
                'title'         => $request->title,
                'author_id'     => $request->author_id,
            ]);

            return response()->json([
                'message' => 'Data updated successfully',
                'status'  => true
            ]);
        }
    }

    public function delete(Book $book)
    {
        if($book){
            $book->delete();
            return response()->json([
                'message' => 'Data successfully deleted',
                'data'    => $book,
                'status'  => true
            ]);
        }else{
            return response()->json([
                'message' => 'data not deleted successfully',
                'status'  => true
            ]);
        }
    }
}
