<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Penting untuk Hash::make()

class UserController extends Controller
{
    public function index()
    {
        // CREATE data baru menggunakan Eloquent ::create()
        $data = [
            'level_id' => 2,
            'username' => 'manager_tiga',
            'nama' => 'Manager 3',
            'password' => Hash::make('12345')
        ];
        
        UserModel::create($data);

        // SELECT data dan kirim ke view
        $user = UserModel::all();
        return view('user', ['data' => $user]);
    }
}