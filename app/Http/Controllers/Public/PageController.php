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

    // AJOUT DE LA MÉTHODE GALERIE
    public function galerie()
    {
        $photos = Photo::latest()->get(); // Récupère toutes les photos, les plus récentes en premier
        return view('public.galerie', compact('photos'));
    }

    // AJOUT DE LA MÉTHODE CONTACT
    public function contact()
    {
        return view('public.contact');
    }
    
    // Vous aurez besoin de cette méthode plus tard pour traiter le formulaire
    public function handleContactForm(Request $request)
    {
        // Logique de traitement du formulaire (envoi d'email, etc.)
        // Pour l'instant, on redirige avec un message de succès.
        return redirect()->route('contact')->with('success', 'Votre message a bien été envoyé !');
    }
}