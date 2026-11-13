<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kritik;
use Illuminate\Http\Request;

class KritikController extends Controller
{
    public function index()
    {
        $kritiks = Kritik::with(['user', 'film'])->latest()->paginate(10);
        return view('admin.kritiks.index', compact('kritiks'));
    }

    public function edit(Kritik $kritik)
    {
        $kritik->load(['user', 'film']);
        return view('admin.kritiks.edit', compact('kritik'));
    }

    public function update(Request $request, Kritik $kritik)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $kritik->update([
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->route('admin.kritiks.index')->with('success', 'Komentar berhasil diperbarui.');
    }

    public function destroy(Kritik $kritik)
    {
        $kritik->delete();

        return redirect()->route('admin.kritiks.index')->with('success', 'Komentar berhasil dihapus.');
    }
}

