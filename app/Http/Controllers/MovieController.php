<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // Hiển thị danh sách phim với tìm kiếm
    public function index(Request $request)
    {
        $query = Movie::query();

        // Nếu có từ khóa tìm kiếm
        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        $movies = $query->with('genre')->get(); 
        return view('movies.index', compact('movies'));
    }

    // Hiển thị form thêm phim
    public function create()
    {
        $genres = Genre::all();
        return view('movies.create', compact('genres'));
    }

    // Xử lý việc thêm phim mới
    public function add(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'intro' => 'required|string',
            'release_date' => 'required|date',
            'genre_id' => 'required|exists:genres,id',
        ]);

        Movie::create($validated);

        return redirect()->route('movies.index')->with('success', 'Movie added successfully.');
    }

    // Hiển thị form chỉnh sửa phim
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        return view('movies.edit', compact('movie', 'genres'));
    }

    // Xử lý việc cập nhật phim
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|string|max:255',
            'intro' => 'required|string',
            'release_date' => 'required|date',
            'genre_id' => 'required|exists:genres,id',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->update($validated);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    // Xóa một phim
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }

    // Hiển thị chi tiết phim
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.show', compact('movie'));
    }
    // Xử lý lưu phim mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'release_date' => 'required|date',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'intro' => 'required|string',
        ]);

        $movie = new Movie();
        $movie->title = $request->input('title');
        $movie->genre_id = $request->input('genre_id');
        $movie->release_date = $request->input('release_date');
        $movie->intro = $request->input('intro');

        // Xử lý file poster nếu có
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/posters', $filename);
            $movie->poster = 'storage/posters/' . $filename;
        }

        $movie->save();

        return redirect()->route('movies.index')->with('success', 'Movie added successfully.');
    }
}
