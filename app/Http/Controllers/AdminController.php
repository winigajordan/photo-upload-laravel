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
}
