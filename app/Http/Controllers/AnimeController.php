<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anime = Anime::all();
        return view('anime', compact('anime'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $title)
    {
        $anime = \App\Models\Anime::with(['studios', 'reviews.user.profile'])->where('title', $title)->firstOrFail();
        return view('animeshow', compact('anime'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
