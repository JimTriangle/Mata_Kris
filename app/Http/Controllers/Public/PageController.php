<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Concert;
use App\Models\Photo;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function accueil()
    {
        // Récupère les 3 prochains concerts
        $prochains_concerts = Concert::where('date', '>=', now())->orderBy('date', 'asc')->take(3)->get();
        // Récupère les 6 dernières photos
        $photos_recentes = Photo::latest()->take(6)->get();

        return view('public.accueil', compact('prochains_concerts', 'photos_recentes'));
    }

    public function concerts()
    {
        $concerts = Concert::where('date', '>=', now())->orderBy('date', 'asc')->get();
        return view('public.concerts', compact('concerts'));
    }
    // ... autres méthodes pour galerie, contact, etc.
}