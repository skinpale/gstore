<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class LinksController extends Controller
{
    public function about(){
        return Inertia::render('Additional/About');
    }

    public function guarantee(){
        return Inertia::render('Additional/Guarantee');
    }

    public function points(){
        return Inertia::render('Additional/Points');
    }
}
