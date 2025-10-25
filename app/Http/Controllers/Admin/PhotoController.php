<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
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

            // Créer une instance de ImageManager avec le driver GD
            $manager = new ImageManager(new Driver());

            // Lire et traiter l'image
            $image = $manager->read($imageFile->getRealPath());

            // Redimensionner l'image (scaleDown ne redimensionne que si l'image est plus grande)
            $image->scaleDown(width: 1200);

            // Encoder en JPEG avec qualité 75
            $encodedImage = $image->toJpeg(quality: 75);

            $base64Image = 'data:image/jpeg;base64,' . base64_encode($encodedImage);

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