<?php

namespace App\Http\Controllers\Api;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{
    public function __construct() {
        if(empty(Auth::guard('web')->check())) {
            return response()->json([
                'status'    => false,
                'message'   => 'Token or authorization incomplete.'
            ], 403)->throwResponse();
        }
    }

    public function index()
    {
        $data = Publisher::with('book')->get();

        return response()->json([
            'message' => 'Data successfully displayed',
            'data'    => $data,
            'status'  => true
        ]);
    }

    public function show(Publisher $publisher)
    {
        return response()->json([
            'message' => 'Data successfully displayed',
            'data'    => $publisher,
            'status'  => true
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [ 
                'name'      => "required|regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u|between:2,100",
                'phone'     => 'required|numeric|min:11',
                'address'   => 'required',
                'books_id'   => 'required|unique:publishers'
            ]
        );

        if($validator->fails()){
            return response()->json([
                'message' => 'Please fill out the form completely',
                'data'    => $validator->errors(),
                'status'  => false
            ]);
        }else{
            Publisher::create([
                'name'      => $request->name,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'books_id'   => $request->books_id
            ]);

            return response()->json([
                'message' => 'Data added successfully',
                'status'  => true
            ]);
        }
    }

    public function update(Request $request, Publisher $publisher)
    {
        if($publisher->books_id == $request->books_id){
            $validator = Validator::make(
                $request->all(),
                [ 
                    'name'      => "required|regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u|between:2,100",
                    'phone'     => 'required|numeric|min:11',
                    'address'   => 'required',
                    'books_id'   => 'required'
                ]
            );    
        }else{
            $validator = Validator::make(
                $request->all(),
                [ 
                    'name'      => "required|regex:/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u|between:2,100",
                    'phone'     => 'required|numeric|min:11',
                    'address'   => 'required',
                    'books_id'   => 'required|unique:publishers'
                ]
            );    
        }

        if($validator->fails()){
            return response()->json([
                'message' => 'Please fill out the form completely',
                'data'    => $validator->errors(),
                'status'  => false
            ]);
        }else{
            $publisher->update([
                'name'      => $request->name,
                'phone'     => $request->phone,
                'address'   => $request->address,
                'books_id'   => $request->books_id
            ]);

            return response()->json([
                'message' => 'Data updated successfully',
                'status'  => true
            ]);
        }
    }

    public function delete(Publisher $publisher)
    {
        if($publisher){
            $publisher->delete();
            return response()->json([
                'message' => 'Data successfully deleted',
                'data'    => $publisher,
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
