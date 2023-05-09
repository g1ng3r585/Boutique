<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Compagne;
use App\Models\Taille;
use App\Models\Couleur;
use App\Http\Requests\ProduitRequest;
 
use App\Models\Commande;

use App\Models\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class ProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compagneEnCours = Compagne::where('statutCompagne', 'enCours')->first();
        $produitsCompagne = [];
    
        if ($compagneEnCours) {
            $produitsCompagne = $compagneEnCours->produits;
        }
    
        $produits = Produit::all();
        $tailles = Taille::all();
        $couleurs = Couleur::all();
    
        return View('produits.index',compact('produitsCompagne', 'produits', 'tailles', 'couleurs','compagneEnCours'));
    }
    
    
    
    
    
    public function gestionProduit()
    {
        $produits = Produit::all();
        $tailles = Taille::all();
        $couleurs = Couleur::all();

        return View('admins.gestionProduit',compact('produits', 'tailles','couleurs'));
    }

    public function listeCommande()
    {
        $commandes = Commande::all();

        $attentionsAchat = Commande::where('statut', 'attentionAchat'); // les commandes passées en attention d'achats
        $payes = Commande::where('statut', 'payer'); // les commandes payées
        $ramasses = Commande::where('statut', 'ramasses'); // les commandes ramassées
        return redirect()->route('admins.listeCommande', compact('commandes','attentionsAchat','payes','ramasses'));

    }

    public function storeProduitTaille(Request $request)
    {
        try{
            $produit = Produit::findOrFail($request->produit_id);
            $taille = Taille::findOrFail($request->Taille_id);
            
            if($produit->taille->contains($produit)){
                return redirect()->route('produits.index')->withErrors(['Relation existante!']);
            }
            else{
                $produit->tailles()->attach($taille);
            }
            $produit->save();

            return redirect()->route('tailles.index')->with('message', "Relation OK!");
        }
        catch(\Throwable $e){
            Log::debug($e);
            return redirect()->route('admins.index')->withErrors(['Relation Bug!']);
        }
        return redirect()->route('admins.index');
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
    public function store(ProduitRequest $request)
    {
        try {
            $produit = new Produit;

            $compagneEnCours = Compagne::where('statutCompagne', 'enCours')->first();

            
            
            //$produit->image = $request->image;   
            $produit->titre = $request->titre;            
            $produit->prix = $request->prix;
            $produit->nombreMax = $request->nombreMax;
            $produit->caracteristiques = $request->caracteristiques;        
            $uploadedFile = $request->file('image');
            
            $nomFichierUnique = str_replace(' ', '_', $produit->titre) . '-' . uniqid() .'.'.$uploadedFile->extension();
            
            try{
 
                $request->image->move(public_path('img/produits'), $nomFichierUnique);
            }
            catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $e) {
            Log::error("Erreur lors du téléversement du fichier. ", [$e]);
        }
        $produit->image = $nomFichierUnique;
        
        $produit->save();
        
        $produit->compagnes()->attach($compagneEnCours);
            
        // Lier le produit avec les tailles
        $tailles = Taille::all();
        foreach ($tailles as $taille) {
            if ($request->tailles == "toutes_les_tailles") {
            } else {
                Log::debug($request->tailles );
                //Log::debug(" tailles " . $taille->id);
                if (in_array($taille->id, $request->tailles)) {
                    
                    $produit->tailles()->attach($taille);
                    //Log::debug("Got Irix" . $taille);
                }

            }
        }

            // Lier le produit avec les couleurs
            $couleurs = Couleur::all();
            foreach ($couleurs as $couleur) {
                if ($request->couleurs == "toutes_les_couleurs") {
            
                } else {
                    Log::debug($request->couleurs );
                    Log::debug(" couleurs " . $couleur->id);
                    if (in_array($taille->id, $request->couleurs)) {
                        
                        $produit->couleurs()->attach($couleur);
                        Log::debug("Got Irix" . $couleur);
                    }
                    
                }
            }

    
            return redirect()->back()->with('message', "Le produit a été créé avec succès!");
        } catch(\Throwable $e) {
            Log::debug($e);
            return redirect()->back()->withErrors(['Une erreur est survenue lors de la création du produit']);

        }
    }
    
    


    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        
        return view('produits.show',compact('produit')); 

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
    public function update(ProduitRequest $request, $id)
    {
        try{
            $produit = Produit::findOrFail($id);
            $produit->image = $request->image;
            $produit->titre = $request->titre;
            $produit->prix = $request->prix;
            $produit->caracteristique = $request->caracteristique;

          

            $produit->save();
            return redirect()->route('produits.index')->with('message', "Modification de " . $produit->titre . " réussi!");
        }
        catch(\Throwable $e){
            Log::debug($e);
            return redirect()->route('produits.index')->withErrors(['message', 'Modification n\'a pas fonctionné']); 
        }
        return redirect()->route('produits.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $produit = Produit::findOrFail($id);

            $produit->couleurs()->detach();
            $produit->tailles()->detach();


            $produit->delete();

            return redirect()->back()->with('message', "Suppression de " . $produit->titre . " réussi!");
        }
        catch(\Throwable $e){
            Log::debug($e);
            return redirect()->back()->withErrors(['La suppression n\'a pas fonctionné']);
        }
        return redirect()->route('produits.index');
    }
}
