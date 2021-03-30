<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return new GenderCollection(Gender::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $newGender = Gender::addGender($request->all());
        return response()->json($newGender, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Gender $gender
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Gender $gender)
    {
        return new GenderResource($gender);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Gender $gender
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Gender $genre)
    {
        $updatedGender = Gender::updateAuthor($gender, $request->all());

        return response()->json($updatedGender, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Gender $gender
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Gender $gender)
    {
        $gender->delete();

        return response()->json('',204);
    }
}
