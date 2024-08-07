<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }
    
        $users = $query->paginate(30);
    
        return Inertia::render('User/Index', [
            'users' => $users
        ]);
    }
    

    public function create()
    {
        return Inertia::render('User/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'role' => 'required|in:admin,user'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('users');
    }

    public function edit(User $user)
    {
        return Inertia::render('User/Edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'string',
            'email' => 'string|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'role' => 'string|in:admin,user'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('users');
    }

    public function destroy(User $user )
    {
       
        $user->delete();
    
        return redirect()->route('users')->with('success', 'Data User Berhasil Dihapus');
    }
    
    public function loggedInUser()
    {
        $user = Auth::user(); // Mengambil data user yang sedang login
    

        // Mengembalikan data user dalam respons Inertia
        return Inertia::render('Dashboard', [
            'user' => $user
        ]);
    }
}
