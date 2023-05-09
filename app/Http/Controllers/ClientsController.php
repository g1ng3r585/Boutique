<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Login;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Usager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
    }

    public function createClient()
    {
        //
        return View('clients.create');

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
    public function store(ClientRequest $request)
    {
        try {
            $client = new Client;
            $client->email = $request->email;
            $client->name = ucwords(strtolower($request->name)); // conversion en majuscule de la première lettre de chaque mot
            $client->lastName = ucwords(strtolower($request->lastName)); // conversion en majuscule de la première lettre de chaque mot
            $client->password = Hash::make($request->password);
    
            $client->save();
    
            // Création d'un nouvel utilisateur de type client
            $user = new Usager;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->name = ucwords(strtolower($request->name)); // conversion en majuscule de la première lettre de chaque mot
            $user->lastname = ucwords(strtolower($request->lastName)); // conversion en majuscule de la première lettre de chaque mot
            $user->type = 'Client';
    
            $user->save();
        return redirect()->route('usagers.formConnexion');

        } catch(\Throwable $e) {
            Log::debug($e);
            return redirect()->back()->withErrors(["Une erreur s'est produite lors de la création de compte"]);
        }
        return redirect()->route('produits.index');
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
        $client = Client::findOrFail($id);  
        $client->delete(); 
        return redirect()->route('clients.index')->with('message'. "Suppresion de " .$client->name . $client->lastName . "réussi!"); 
    } catch (\Throwable $th) { 
       // Log::debug($th); 
        return redirect()->route('clients.index')->withErrors(['la supression n\'a pas fonctionné']); 
    } 
    return redirect()->route('clients.index');
    }
}
