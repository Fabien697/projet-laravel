<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Resources\GenreResource;
use App\Http\Resources\GenreCollection;

class GenreController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function index()
    {
        return new GenreCollection(Genre::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $newGenre = Genre::addGenre($request->all());
        return response()->json($newGenre, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Genre $genre
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $genre = Genre::find($id);
        if ($genre) {
        return new GenreResource($genre);
        }else{
            return response()->json(['message' => 'Pas de genres ici',], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Genre $genre
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Genre $genre)
    {
        $updatedGenre = Genre::updateAuthor($genre, $request->all());

        return response()->json($updatedGenre, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Genre $genre
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->json('',204);
    }
}
