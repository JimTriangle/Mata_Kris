<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image; // Importez la classe

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'photo' => 'required|image|max:5120', // 5MB max
            'legende' => 'nullable|string|max:255',
        ]);

        $imageFile = $request->file('photo');

        // --- Compression de l'image ---
        // On encode l'image en JPG avec une qualité de 75% pour la compresser.
        // On la redimensionne aussi si elle est trop grande (ex: max 1200px de large).
        $compressedImage = Image::make($imageFile)
            ->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode('jpg', 75);

        // On encode le résultat en Base64 pour le stocker dans la base de données
        $base64Image = 'data:image/jpeg;base64,' . base64_encode($compressedImage);

        // --- Sauvegarde en base de données ---
        Photo::create([
            'image_data_base64' => $base64Image,
            'legende' => $request->input('legende'),
        ]);

        return redirect()->route('admin.photos.index')->with('success', 'Photo ajoutée avec succès.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



}
