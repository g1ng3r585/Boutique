<?php

namespace App\Http\Controllers;
use App\Models\Taille;
use App\Models\Couleur;
use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CouleurRequest;
use Illuminate\Support\Facades\Log;


class CouleursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tailles = Taille::all();
        $couleurs = Couleur::all();
    
        return View('admins.gestionCouleurTaille',compact('tailles', 'couleurs'));    
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
   /**
 * Store a newly created resource in storage.
 */
public function store(CouleurRequest $request)
{
    try {
        $couleur = Couleur::where('couleur', $request->couleur)
                           ->orWhere('hex', $request->hex)
                           ->first();
        
        if ($couleur) {
            // Une couleur avec le même nom ou le même hex existe déjà
            return redirect()->back()->withErrors(["La couleur existe déjà"]);
        }
        
        // Aucune couleur existante avec le même nom ou le même hex, on peut créer la couleur
        $newCouleur = new Couleur;
        $newCouleur->couleur = ucwords(strtolower($request->couleur));
        $newCouleur->hex = $request->hex;
        $newCouleur->save();

        return redirect()->back()->with('message', 'La couleur a été créée avec succès!');
    } catch (\Throwable $e) {
        Log::debug($e);
        return redirect()->back()->withErrors(["La création a échoué"]);
    }
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
    public function destroy($id)
    {
        try{
            $couleur = Couleur::findOrFail($id);

            $couleur->produits()->detach();


            $couleur->delete();

            return redirect()->back()->with('message', "Suppression de " . $couleur->couleur . " réussi!");
        }
        catch(\Throwable $e){
            Log::debug($e);
            return redirect()->back()->withErrors(['La suppression n\'a pas fonctionné']);
        }
        return redirect()->back();
    }
}
