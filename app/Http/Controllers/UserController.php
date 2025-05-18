<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Http\Middleware\AdminMiddleware;

class UserController extends Controller
{
    public function __construct()
    {
        // Apply the AdminMiddleware to all methods in this controller
        $this->middleware(AdminMiddleware::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all users
        $users = User::with('roles')->paginate(10);
        $roles = Role::all();

        // Return the view with the users data
        return view('users.index', compact('users', 'roles'));
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
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nisn' => $request->nisn
        ]);

        // Assign the role to the user
        $user->roles()->attach($request->role_id);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
        ]);

        // Find the user
        $user = User::findOrFail($id);

        // Update the user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nisn = $request->nisn;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        // Sync the roles
        $user->roles()->sync([$request->role_id]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the user
        $user = User::findOrFail($id);

        // Detach the roles
        $user->roles()->detach();

        // Delete the user
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
