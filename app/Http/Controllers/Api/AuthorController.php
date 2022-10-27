<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index()
    {
        $data = Author::with('book')->get();

        return response()->json([
            'message' => 'Data successfully displayed',
            'data'    => $data,
            'status'  => true
        ]);
    }

    public function show(Author $author)
    {
        return response()->json([
            'message' => 'Data successfully displayed',
            'data'    => $author,
            'status'  => true
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [ 
                'name'      => "required|regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u|between:2,100",
            ]
        );

        if($validator->fails()){
            return response()->json([
                'message' => 'Please fill out the form completely',
                'data'    => $validator->errors(),
                'status'  => false
            ]);
        }else{
            Author::create([
                'name' => $request->name
            ]);

            return response()->json([
                'message' => 'Data added successfully',
                'status'  => true
            ]);
        }
    }

    public function update(Request $request, Author $author)
    {
        $validator = Validator::make(
            $request->all(),
            [ 
                'name'      => "required|regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u|between:2,100",
            ]
        );

        if($validator->fails()){
            return response()->json([
                'message' => 'Please fill out the form completely',
                'data'    => $validator->errors(),
                'status'  => false
            ]);
        }else{
            $author->update([
                'name' => $request->name
            ]);

            return response()->json([
                'message' => 'Data updated successfully',
                'status'  => true
            ]);
        }
    }

    public function delete(Author $author)
    {
        if($author){
            $author->delete();
            return response()->json([
                'message' => 'Data successfully deleted',
                'data'    => $author,
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
