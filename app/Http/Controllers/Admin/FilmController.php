<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::with('genre')->latest()->paginate(10);
        return view('admin.films.index', compact('films'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.films.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sinopsis' => 'required|string',
            'year' => 'required|integer|min:1900|max:2100',
            'genre_id' => 'required|exists:genres,id',
            'poster' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        $path = $request->file('poster')->store('images', 'public');
        $posterPath = 'storage/' . $path;

        Film::create([
            'title' => $request->title,
            'sinopsis' => $request->sinopsis,
            'year' => $request->year,
            'genre_id' => $request->genre_id,
            'poster' => $posterPath,
        ]);

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil ditambahkan.');
    }

    public function show(Film $film)
    {
        $film->load(['genre', 'perans.cast', 'kritiks.user']);
        return view('admin.films.show', compact('film'));
    }

    public function edit(Film $film)
    {
        $genres = Genre::all();
        return view('admin.films.edit', compact('film', 'genres'));
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sinopsis' => 'required|string',
            'year' => 'required|integer|min:1900|max:2100',
            'genre_id' => 'required|exists:genres,id',
            'poster' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'sinopsis' => $request->sinopsis,
            'year' => $request->year,
            'genre_id' => $request->genre_id,
        ];

        if ($request->hasFile('poster')) {
            $newPath = $request->file('poster')->store('images', 'public');
            $data['poster'] = 'storage/' . $newPath;

            // Hapus file poster lama hanya jika itu file hasil upload (bukan seeder bawaan)
            if ($film->poster && Str::startsWith($film->poster, 'storage/images/')) {
                $filename = basename($film->poster);
                if (strlen(pathinfo($filename, PATHINFO_FILENAME)) >= 30) {
                    $storagePath = 'images/' . $filename;
                    if (Storage::disk('public')->exists($storagePath)) {
                        Storage::disk('public')->delete($storagePath);
                    }
                }
            }
        }

        $film->update($data);

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil diperbarui.');
    }

    public function destroy(Film $film)
    {
        DB::transaction(function () use ($film) {
            $film->perans()->delete();
            $film->kritiks()->delete();

            if ($film->poster && Str::startsWith($film->poster, 'storage/images/')) {
                $filename = basename($film->poster);
                if (strlen(pathinfo($filename, PATHINFO_FILENAME)) >= 30) {
                    $storagePath = 'images/' . $filename;
                    if (Storage::disk('public')->exists($storagePath)) {
                        Storage::disk('public')->delete($storagePath);
                    }
                }
            }

            $film->delete();
        });

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil dihapus beserta peran dan kritik terkait.');
    }
}

