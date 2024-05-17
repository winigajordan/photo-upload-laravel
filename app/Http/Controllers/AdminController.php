<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use ZipArchive;

class AdminController extends Controller
{
    public function index()
    {
        //dd(phpinfo());
        $demandes = Demande::orderBy('created_at', 'desc')->get();
        return view('admin.home', compact('demandes'));
    }

    public function createDemande(Request $request)
    {
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        $email = $request->input('email');
        $telephone = $request->input('telephone');
        $date = $request->input('date');
        $etat = $request->input('etat');

        $slug = uniqid();

        $directoryPath = public_path('/images-bornes/'.$slug);

        // Check if the directory doesn't already exist
        if (!File::exists($directoryPath)) {
            // Create the directory
            File::makeDirectory($directoryPath);
        }

        $qrCode = QrCode::
            size(200)
            ->format('png')
            ->generate(env('QR_BASE_URL').$slug."/image", '../public/images-bornes/'.$slug.'/code-qr.png');;

        $this->checkStatus($etat);

        Demande::create(
           [
               'nom'=>$nom,
               'prenom'=>$prenom,
               'email'=>$email,
               'telephone'=>$telephone,
               'date_location'=>date('Y-m-d', strtotime($date)),
               'etat' => $etat,
               'slug'=> $slug
           ]
        );

        return redirect()->route('admin.home');
    }


    public function changeEtat(string $slug, string $etat)
    {
        $demande = Demande::where('slug', $slug)->first();
        $demande->etat = $etat;
        $demande->save();

        $this->checkStatus($etat);

        return redirect()->route('admin.home');
    }

    public function showDemande(string $slug)
    {
        $demande = Demande::where('slug', $slug)->first();
        return view("admin/show", compact('demande'));
    }

    public function checkStatus(string $statut)
    {
        if ($statut==''){
            //Envoyer un mail contenant le QR Code
            return true;
        }
        return false;
    }

    public function uploadImage(Request $request, string $slug)
    {
        $image = $request->file('image');
        $demande = Demande::where('slug', $slug)->first();

        $imageExtension = $image->getClientOriginalExtension();
        $imageName = uniqid().'.'.$imageExtension;

        $image->move(public_path('/images-bornes/'.$slug), $imageName);


        Image::create([
            'nom' => $imageName,
            'demande_id' => $demande->id
        ]);

        return response()->json(['message' => 'Succès'], 200);
    }

    public function download(string $slug)
    {
        $folder = public_path('/images-bornes/'.$slug);
        $zipFile = public_path('/images-bornes/'.$slug.'/'.$slug.'.zip');

        if (!File::exists($zipFile)) {
            $this->zipFolder($folder, $zipFile);
        }

        return response()->download($zipFile);
    }

    function zipFolder($source, $destination): bool
    {

        $zip = new ZipArchive();
        if (!$zip->open($destination, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE)) {
            echo 'Impossible de créer ou d\'ouvrir le fichier zip.';
            return false;
        }

        $source = realpath($source);
        if (is_dir($source)) {
            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($source),
                RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($source) + 1);

                    if (!$zip->addFile($filePath, $relativePath)) {
                        echo "Erreur lors de l'ajout du fichier: $filePath\n";
                    }
                }
            }

        } else if (is_file($source)) {
            if (!$zip->addFile($source, basename($source))) {
                echo "Erreur lors de l'ajout du fichier: $source\n";
            }
        } else {
            echo 'Le chemin source n\'est ni un fichier ni un dossier valide.';
            return false;
        }

        $result = $zip->close();
        if (!$result) {
            echo 'Erreur lors de la fermeture du fichier zip.';
        }
        return $result;
    }



}
