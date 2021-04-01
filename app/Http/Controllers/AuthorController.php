<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Author;
use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = $request->query();


        if(isset($query['sort'])){
            if($query['sort'] === 'nameAsc'){
                $authors = Author::orderBy('name', 'asc');
                return new AuthorCollection($authors->paginate(10));
            }
            else if($query['sort'] === 'nameDesc'){
                $authors = Author::orderBy('name', 'desc');
                return new AuthorCollection($authors->paginate(10));
            }
        
        } 
        else{
            return new AuthorCollection(Author::paginate(10));
        }
        
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $newAuthor = Author::addAuthor($request->all());
        return response()->json($newAuthor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $author = Author::find($id);
        if ($author) {
        return new AuthorResource($author);
        }else{
            return response()->json(['message' => 'Pas trouver d_ID',], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Author $author)
    {
        $updatedAuthor = Author::updateAuthor($author, $request->all());

        return response()->json($updatedAuthor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json('',204);
    }
}
