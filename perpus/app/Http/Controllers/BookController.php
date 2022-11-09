<?php

namespace App\Http\Controllers;
use App\models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function index(){

        //get all data in books table
        $books = Book::all();
        // send 201 if no data
        if(count($books) == 0){
            return response()->json([
                'message' =>'Get all resources',
                'status' => 204,
            ], 204);

        }

        return response()->json([
            'message' =>'Get all resources',
            'status' => 200,
            'data' =>$books,
        ], 200);
    }

    function store(Reqquest $request)
    {
        $created = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'rating' => $request->rating,
            'published_date' => $request->publish_date,
        ]);

        return response()->json([
            'massage' => 'Resource created sucsessfully',
            'status' => 201,
            'data' => $created,
        ], 201);
    }
    public function show($id){
       $book = Book::find($id);
       // Jika id tidak ditemukan

       if(!$book){
        return response()->json([
            'message' => 'Resource not found',
            'status' => 404,
            'date' => $book
        ], 404); 
       }

       //return book resoruce
       return response()->json([
        'message' => 'Get detail resource',
        'status' => 200,
        'data' => $book
       ], 200);
    }
    function update($id, Request $request){
        /**
         * Alur update resource:
         * 1. mengkap id & data request body
         * 2. mendapatkan data book berdasakan id
         * 3. deklarasikan data yang akan di update
         * 4. kirim status 200 jika berhasil di update
          */  

          $book = Book::find($id);

          // Jika id tidak ditemukan

       if(!$book){
        return response()->json([
            'message' => 'Resource not found',
            'status' => 404,
            'date' => $book
        ], 404); 
       }

         $updated = $book->update([
            'title' => $request->title ?? $book->title,
            'author' => $request->author ?? $book->author,
            'publisher' => $request->publisher ?? $book->publisher,
            'rating' => $request->rating ?? $book->rating,
            'published_date' => $request->published_date ?? $book->published_date,
          ]);
          if($updated){
            return response()->json([
                'massage' => 'Data update successfully'
                'data' => $updated
                'status' => 200
            
            ], 200);
          }
    }
}
