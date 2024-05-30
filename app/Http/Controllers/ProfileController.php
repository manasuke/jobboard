<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = [
            [
                'name' => 'Alex',
                'age' => 30,
            ],
            [
                'name' => 'John',
                'age' => 25,
            ],
            [
                'name' => 'Jane',
                'age' => 15,
            ],
        ];
        return view('profile', [
            'user' => $user,
        ]);
    }
}
