<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        // validation
        $request->validate([
            'title' => 'required',
            'small_thumbnail' => 'required|image|mimes:jpeg,png,jpg',
            'large_thumbnail' => 'required|image|mimes:jpeg,png,jpg',
            'trailer' => 'required|url',
            'movie' => 'required|url',
            'casts' => 'required|string',
            'categories' => 'required|string',
            'release_date' => 'required|string',
            'about' => 'required|string',
            'short_about' => 'required|string',
            'duration' => 'required|string',
            'featured' => 'required'
        ]);

        // get small_thumbnail and large_thumbnail
        $small_thumbnail = $request->file('small_thumbnail');
        $large_thumbnail = $request->file('large_thumbnail');

        // rename small_thumbnail and large_thumbnail name
        $small_thumbnail_name = Str::random(10) . '_' . $small_thumbnail->getClientOriginalName();
        $large_thumbnail_name = Str::random(10) . '_' . $large_thumbnail->getClientOriginalName();

        // move small_thumbnail and large_thumbnail to storage
        $small_thumbnail->storeAs('public/thumbnails', $small_thumbnail_name);
        $large_thumbnail->storeAs('public/thumbnails', $large_thumbnail_name);

        // set small_thumbnail and large_thumbnail name to data
        $data['small_thumbnail'] = $small_thumbnail_name;
        $data['large_thumbnail'] = $large_thumbnail_name;

        // insert data to database
        Movie::create($data);

        // redirect to admin.movies
        return redirect()->route('admin.movies')->with('success', 'Movie has been added successfully!');
    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        // validation
        $request->validate([
            'title' => 'required',
            'small_thumbnail' => 'image|mimes:jpeg,png,jpg',
            'large_thumbnail' => 'image|mimes:jpeg,png,jpg',
            'trailer' => 'required|url',
            'movie' => 'required|url',
            'casts' => 'required|string',
            'categories' => 'required|string',
            'release_date' => 'required|string',
            'about' => 'required|string',
            'short_about' => 'required|string',
            'duration' => 'required|string',
            'featured' => 'required'
        ]);

        $movie = Movie::find($id);

        if ($request->small_thumbnail) {
            // save new image
            $small_thumbnail = $request->file('small_thumbnail');
            $small_thumbnail_name = Str::random(10) . '_' . $small_thumbnail->getClientOriginalName();
            $small_thumbnail->storeAs('public/thumbnails', $small_thumbnail_name);
            // delete old image with storage
            $old_small_thumbnail = $movie->small_thumbnail;
            Storage::delete('public/thumbnails/' . $old_small_thumbnail);
            // set new image name to data
            $data['small_thumbnail'] = $small_thumbnail_name;
        }

        if ($request->large_thumbnail) {
            // save new image
            $large_thumbnail = $request->file('large_thumbnail');
            $large_thumbnail_name = Str::random(10) . '_' . $large_thumbnail->getClientOriginalName();
            $large_thumbnail->storeAs('public/thumbnails', $large_thumbnail_name);
            // delete old image with storage
            $old_large_thumbnail = $movie->large_thumbnail;
            Storage::delete('public/thumbnails/' . $old_large_thumbnail);
            // set new image name to data
            $data['large_thumbnail'] = $large_thumbnail_name;
        }

        // update data to database
        $movie->update($data);

        // redirect to admin.movies
        return redirect()->route('admin.movies')->with('success', 'Movie has been updated successfully!');
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);

        // hapus dari db
        $movie->delete();

        // jangan hapus folder dulu karena masih pakai softdelete
        // $small_thumbnail = $movie->small_thumbnail;
        // $large_thumbnail = $movie->large_thumbnail;
        // Storage::delete('public/thumbnails/' . $small_thumbnail);
        // Storage::delete('public/thumbnails/' . $large_thumbnail);

        // redirect to admin.movies
        return redirect()->route('admin.movies')->with('success', 'Movie has been deleted successfully!');
    }
}
