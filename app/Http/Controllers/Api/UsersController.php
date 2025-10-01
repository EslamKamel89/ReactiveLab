<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller {
    public function index(Request $request) {
        $page = (int) $request->query('page', 1);
        $search  = trim($request->query('search', ''));
        $users = User::where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")->paginate(10);
        return $users;
    }
    public function create(Request $request) {
        $validated =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:user,email|email',
            'role' => 'required|string:255'
        ]);
    }
}
