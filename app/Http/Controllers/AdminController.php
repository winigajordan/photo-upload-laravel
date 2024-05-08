<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
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
}
