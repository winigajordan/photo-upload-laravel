<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminController extends Controller
{
    public function index()
    {
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

        $directoryPath = public_path($slug);

        // Check if the directory doesn't already exist
        if (!File::exists($directoryPath)) {
            // Create the directory
            File::makeDirectory($directoryPath);
        }

        $qrCode = QrCode::size(200)->generate(env('QR_BASE_URL').$slug."/image", '../public/'.$slug.'/code-qr.svg');;

        checkStatus($etat);

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

    private function checkStatus(string $statut) : bool
    {
        if ($statut==''){
            //Envoyer un mail contenant le QR Code
            return true;
        }
        return false;
    }
}
