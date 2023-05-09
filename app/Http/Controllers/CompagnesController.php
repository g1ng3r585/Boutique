<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compagne;
use App\Models\Produit;
use App\Models\Login;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompagneRequest;
use Illuminate\Support\Facades\Log;


class CompagnesController extends Controller
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
   
    public function store(CompagneRequest $request)
    {
        try
        {
            Log::debug('1');

            $compagne = new Compagne;
            $compagne->dateDebut = $request->dateDebut;   
            $compagne->dateFin = $request->dateFin; 

            $compagne->debutPaiement = $request->debutPaiement;
            $compagne->finPaiement = $request ->finPaiement;

            $compagne->debutDistribution = $request ->debutDistribution;
            $compagne->finDistribution = $request ->finDistribution;
            
            $compagne->statutCompagne = 'enCours'; //valeur par défaut à la création
            $compagne->statutCommande = 'enCommande'; //valeur par défaut à la création pour la prise des commandes des clients

            $compagne->save();

        }
        catch(\Throwable $e)
        {
            Log::debug($e);
        return redirect()->route('admins.index')->with('message', "Erreur lors de la création de la campagne.");
        }
        
        return redirect()->route('admins.index');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Compagne $compagne)
    {
        $produits = Produit::all();
        return view('compagnes.show',compact('compagne', 'produits')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $compagne = Compagne::findOrFail($id);
        return View('compagnes.edit', compact('compagne'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompagneRequest $request, $id)
    {
        try {
            $compagne = Compagne::findOrFail($id);
            $compagne->dateDebut = $request->dateDebut;
            $compagne->dateFin = $request->dateFin;
            $compagne->debutPaiement = $request->debutPaiement;
            $compagne->finPaiement = $request->finPaiement;
            $compagne->debutDistribution = $request->debutDistribution;
            $compagne->finDistribution = $request->finDistribution;
    
            $statutCommande = $request->input('statutCommande');
    
            if($statutCommande == "terminer")
            {
                $compagne->statutCompagne = "terminer";
                $compagne->statutCommande = "terminer";
            }
            else
            {
                $compagne->statutCompagne = "enCours";
                $compagne->statutCommande = $request->statutCommande;
            }
    
            $compagne->save();
    
            return redirect()->route('admins.index')->with('message', "Modification de la compagne réussie!");
        } catch (\Throwable $e) {
            Log::debug($e);
            return redirect()->route('admins.index')->withErrors(['message', 'Modification n\'a pas fonctionné']); 
        }
    }
    
     

     public function updatecompagne(CompagneRequest $req, $id) 
     {
        try {
            $compagne = Compagne::findOrFail($id);
    
            $compagne->dateDebut = $request->dateDebut;   
            $compagne->dateFin = $request->dateFin;            
            $compagne->debutPaiement = $request->debutPaiement;
            $compagne->finPaiement = $request ->finPaiement;
            $compagne->debutDistribution = $request ->debutDistribution;

            
           Log::debug('');
    
            $compagne->save();
    
            return redirect()->route('admins.index')->with('message', "Modification de la compagne réussie!");
        } catch (\Throwable $e) {
            Log::debug($e);
            return redirect()->route('admins.index')->withErrors(['message', 'Modification n\'a pas fonctionné']); 
        }
     }

    /**
     * Remove the specified resource from storage.
     */

    
        public function destroy($id)
        {
          try { 
            $compagne = Compagne::findOrFail($id);  
            $compagne->delete(); 
            return redirect()->route('compagnes.index')->with('message'. "Suppresion de " .$compagne->dateDebut . "réussi!"); 
        } catch (\Throwable $th) { 
           // Log::debug($th); 
            return redirect()->route('compagnes.index')->withErrors(['la supression n\'a pas fonctionné']); 
        } 
        return redirect()->route('compagnes.index');
        }
    
}
