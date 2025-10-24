<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Exception;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.photos.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.photos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:10240', // 10MB max
            'legende' => 'nullable|string|max:255',
        ]);

        try {
            $imageFile = $request->file('photo');
            
            // Vérifiez que le fichier est bien présent
            if (!$imageFile || !$imageFile->isValid()) {
                return redirect()->back()->withErrors(['photo' => 'Erreur lors du téléchargement de l\'image.']);
            }

            $compressedImage = Image::make($imageFile)
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('jpg', 75);

            $base64Image = 'data:image/jpeg;base64,' . base64_encode($compressedImage);

            Photo::create([
                'image' => $base64Image,
                'legende' => $request->input('legende'),
            ]);

            return redirect()->route('admin.photos.index')->with('success', 'Photo ajoutée avec succès.');
            
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['photo' => 'Erreur lors du traitement de l\'image: ' . $e->getMessage()]);
        }
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('admin.photos.index')->with('success', 'Photo supprimée avec succès.');
    }
}