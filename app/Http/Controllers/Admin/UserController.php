<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        DB::transaction(function () use ($request) {
            $profile = new Profile();
            $profile->umur = 0;
            $profile->bio = '-';
            $profile->alamat = '-';
            $profile->save();

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password; // Auto-hashed by model cast 'password' => 'hashed'
            $user->role_id = $request->role_id;
            $user->profile_id = $profile->id;
            $user->save();
        });

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        $user->load(['role', 'profile', 'kritiks.film']);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Admin tidak boleh menurunkan role-nya sendiri dari admin
        if (Auth::id() === $user->id && (int) $request->role_id !== 2) {
            return back()->with('error', 'Anda tidak dapat menurunkan role akun Anda sendiri dari Administrator.');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        if ($request->filled('password')) {
            $user->password = $request->password; // Auto-hashed by model cast
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Admin tidak boleh menghapus akunnya sendiri
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        DB::transaction(function () use ($user) {
            $user->kritiks()->delete();
            $profile = $user->profile;
            $user->delete();
            if ($profile) {
                $profile->delete();
            }
        });

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus beserta profil dan kritik terkait.');
    }
}

