<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Http\Requests\CommandeRequest;

use App\Models\Compagne;
use Illuminate\Support\Facades\Log;


class CommandesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes = Commande::all();

        $attentionsAchat = Commande::where('statut', 'attentionAchat')->get();
        $payed = Commande::where('statut', 'paye')->get();
        $ramasses = Commande::where('statut', 'ramasse')->get();
        return view('admins.listeCommande', compact('commandes','attentionsAchat','payed','ramasses'));

    }
    



    public function commande()
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $commandes = Commande::where('usager_id', $userId)
                                  ->whereHas('compagne', function ($query) {
                                        $query->where('statutCompagne', 'enCours');
                                    })
                                  ->with(['produit', 'taille', 'couleur'])
                                  ->get();
        
            $attentionsAchat = Commande::where('usager_id', $userId)
                                ->whereHas('compagne', function ($query) {
                                    $query->where('statutCompagne', 'enCours');
                                })
                                ->where('statut', 'attentionAchat')
                                ->with(['produit', 'taille', 'couleur'])
                                ->get();

            $payed = Commande::where('usager_id', $userId)
                                ->whereHas('compagne', function ($query) {
                                    $query->where('statutCompagne', 'enCours');
                                })
                                ->where('statut', 'paye')
                                ->with(['produit', 'taille', 'couleur'])
                                ->get();

            return view('commandes.commande', compact('commandes','attentionsAchat', 'payed'));
        } else {
            return redirect()->route('usagers.formConnexion');
        }
        
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
    public function store(CommandeRequest $request)
    {
        try {
            if (!auth()->user()) {
                return redirect()->route('usagers.formConnexion');
            }
    
            // Vérifier si une commande existante correspondant à cette commande existe
            $existingCommande = Commande::where('produit_id', $request->produit_id)
                ->where('taille_id', $request->taille_id)
                ->where('couleur_id', $request->couleur_id)
                ->where('compagne_id', Compagne::where('statutCompagne', 'enCours')->value('id'))
                ->where('usager_id', auth()->user()->id)
                ->first();
    
            if ($existingCommande) {
                return redirect()->back()->withErrors(['Vous avez déjà commandé ce produit!']);
            }
    
            $commande = new Commande();
            $commande->produit_id = $request->produit_id;
            $commande->taille_id = $request->taille_id;
            $commande->couleur_id = $request->couleur_id;
            $commande->quantite = $request->quantite;
            $commande->statut = "attentionAchat";
    
            //compagne en cours
            $compagneEnCours = Compagne::where('statutCompagne', 'enCours')->first();
            $compagne_id = $compagneEnCours->id;
            $commande->compagne_id = $compagne_id;
    
            //user connécté
            $commande->usager_id = auth()->user()->id;
            $commande->save();
            return redirect('/')->with('success', 'La commande a été passée avec succès!');
        } catch(\Throwable $e) {
            Log::debug($e);
            return redirect()->back()->withErrors(['Commande error!']);
        }
    
    }
    
    
    public function paied($id)
    {
        $commande = Commande::find($id);
        $commande->statut = 'paye';
        $commande->save();
        return redirect()->back()->with('success', 'La commande a été marquée comme payée.');
    }


    public function rembourser($id)
    {
        $commande = Commande::find($id);
        $commande->update(['statut' => 'attentionAchat']);

        $commande->save();
        return redirect()->back()->with('success', 'La commande a été marquée comme payée.');
    }
    public function ramassage($id)
    {
        $commande = Commande::find($id);
        $commande->statut = 'ramasse';
        $commande->save();
    
        return redirect()->back()->with('success', 'La commande a été marquée comme ramassée.');
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
        try { 
          $commande = Commande::findOrFail($id);  
          $commande->delete(); 
          return redirect()->back()->with('message'. "Suppresion de " .$commande->id . "réussi!"); 
      } catch (\Throwable $th) { 
         // Log::debug($th); 
         return redirect()->back()->withErrors(['la supression n\'a pas fonctionné']); 
      } 
      return redirect()->back();
      }
}
