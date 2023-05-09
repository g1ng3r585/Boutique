<?php

namespace App\Http\Controllers;
use App\Models\Taille;
use App\Models\Couleur;
use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TailleRequest;
use Illuminate\Support\Facades\Log;


class TaillesController extends Controller
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
    public function store(TailleRequest $request)
    {
        try {
            $taille = Taille::where('taille', $request->taille)
                               ->first();
            
            if ($taille) {
                // Une taille avec le même nom qui existe déjà
                return redirect()->back()->withErrors(["La taille existe déjà"]);
            }
            
            // Aucune taille existante avec le même nom ou le même hex, on peut créer la couleur
            $newtaille = new Taille;
            $newtaille->taille = $request->taille;
            $newtaille->save();
    
            return redirect()->back()->with('message', 'La taille a été créée avec succès!');
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
            $taille = Taille::findOrFail($id);

            $taille->produits()->detach();


            $taille->delete();

            return redirect()->back()->with('message', "Suppression de " . $taille->taille . " réussi!");
        }
        catch(\Throwable $e){
            Log::debug($e);
            return redirect()->back()->withErrors(['La suppression n\'a pas fonctionné']);
        }
        return redirect()->back();
    }
}
