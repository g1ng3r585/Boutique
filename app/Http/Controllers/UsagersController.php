<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsagerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ProduitsController;
use App\Models\Produit;

use App\Models\Usager;



class UsagersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        
        $usager = auth()->user();

    return view('produits.index', compact('usager'));
    }

    public function formConnexion()
    {


        $usagers = Usager::all();
        return view ('usagers.formConnexion', compact('usagers') );
        
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
    public function store(Request $request)
    {
        //
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
        //
    }
    // Traitement de la demande de connexion
    public function connexion(UsagerRequest $request)
    {
        $reussi = Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);
        if ($reussi) {
            $user = Auth::user();
            if ($user->type === 'Admin') {
                return redirect()->route('admins.index');
            } elseif ($user->type === 'Client') {
                return redirect()->route('produits.index');
            } elseif ($user->type === 'SuperAdmin') {
                return redirect()->route('superadmins.index');
            }
        } else {
            return redirect()->route('usagers.formConnexion')->withErrors(['email' => 'Les informations d\'identification sont incorrectes. Veuillez réessayer.']);
        }
    }
    

    // Déconnexion
    public function logout()
    {
        Auth::logout();
        return redirect()->route('produits.index');
    }
}
