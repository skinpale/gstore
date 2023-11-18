<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index(){
        $users = User::all();
        return Inertia::render('Welcome', [
            'users' => $users,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register')
        ]);
    }
}
