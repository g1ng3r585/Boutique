<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Produit;
use App\Models\Compagne;
use App\Models\Taille;
use App\Models\Couleur;
use App\Models\Usager;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;




class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::all();
        $tailles = Taille::all();
        $couleurs = Couleur::all();
        $compagnes = Compagne::all();
        
        
        $enCours = Compagne::Where('statutCompagne', 'enCours')->get();
        
        $enPaiement = Compagne::Where('statutCommande', 'enPaiement')->get();
        
        $enDistribution = Compagne::Where('statutCommande', 'enDistribution')->get();
        
        $terminer = Compagne::Where('statutCompagne', 'terminer')->get();
        
        return View('admins.index', compact('compagnes', 'enCours', 'enPaiement', 'enDistribution', 'terminer','produits', 'tailles','couleurs'));
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
     * Creation d'admins dans la page superAdmins
     */
    public function store(AdminRequest $request)
    {
        try {
            $admin = new Admin;
            $admin->email = $request->email;   
            $admin->name = ucwords(strtolower($request->name));            
            $admin->lastname = ucwords(strtolower($request->lastname));
            $admin->password = Hash::make($request ->password);
            
            $admin->save();
            
            // Création d'un nouvel utilisateur de type client
            $user = new Usager;         
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->name = ucwords(strtolower($request->name));            
            $user->lastname = ucwords(strtolower($request->lastname));
            $user->type = 'Admin';
    
            $user->save();
        } catch(\Throwable $e) {
            Log::debug($e);
            return redirect()->back()->withErrors(["La création a échoué"]); ;
    
        }
        return redirect()->route('superadmins.index');
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
      try { 
        $admin = Admin::findOrFail($id);  
        $admin->delete(); 
        return redirect()->route('superadmins.index')->with('message'. "Suppresion de " .$admin->name . "réussi!"); 
    } catch (\Throwable $th) { 
       // Log::debug($th); 
        return redirect()->route('superadmins.index')->withErrors(['la supression n\'a pas fonctionné']); 
    } 
    return redirect()->route('superadmins.index');
    }
}
