<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return redirect()->route('dashboard');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('movies.create');
    }

    /**
     * @param \App\Http\Requests\MovieStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieStoreRequest $request)
    {        
        $movie = Movie::create($request->validated());
        if ($movie) {
            $movie->addMedia($request->file('image'))->toMediaCollection();
        }

        return redirect()->route('movies.create')->with('success','cadastrado com sucesso');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    /**
     * @param \App\Http\Requests\MovieUpdateRequest $request
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function update(MovieUpdateRequest $request, Movie $movie)
    {
        $movie->update($request->validated());

        return redirect()->route('movies.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Movie $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index');
    }
}
