<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CastController extends Controller
{
    public function index()
    {
        $casts = Cast::latest()->paginate(10);
        return view('admin.casts.index', compact('casts'));
    }

    public function create()
    {
        return view('admin.casts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'age' => 'required|integer|min:0|max:150',
            'bio' => 'nullable|string',
        ]);

        Cast::create([
            'name' => $request->name,
            'age' => $request->age,
            'bio' => $request->bio ?? '-',
        ]);

        return redirect()->route('admin.casts.index')->with('success', 'Cast berhasil ditambahkan.');
    }

    public function show(Cast $cast)
    {
        $cast->load('perans.film');
        return view('admin.casts.show', compact('cast'));
    }

    public function edit(Cast $cast)
    {
        return view('admin.casts.edit', compact('cast'));
    }

    public function update(Request $request, Cast $cast)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'age' => 'required|integer|min:0|max:150',
            'bio' => 'nullable|string',
        ]);

        $cast->update([
            'name' => $request->name,
            'age' => $request->age,
            'bio' => $request->bio ?? '-',
        ]);

        return redirect()->route('admin.casts.index')->with('success', 'Cast berhasil diperbarui.');
    }

    public function destroy(Cast $cast)
    {
        DB::transaction(function () use ($cast) {
            $cast->perans()->delete();
            $cast->delete();
        });

        return redirect()->route('admin.casts.index')->with('success', 'Cast berhasil dihapus beserta peran terkait.');
    }
}

