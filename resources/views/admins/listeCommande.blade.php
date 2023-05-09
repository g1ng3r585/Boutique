@extends('layouts.app')

@section('title', 'Page gestion de produits')

@section('contenudumilieu')

<div  class="listeCommandes">

<div>
<div class="listCommandesHaut">
    <div>
        
        <h2 id="haut">Liste des commandes:</h2>
        
    </div>
    <div class="navigationRapide">
        <h3>Navigation rapide:</h3>
        <ul>
            <li>
            <a href="{{ route('admins.index') }}">Page Admin</a>
            </li>
            <li>
                <a href="#espaceRamassage">Voir les commandes ramassées</a>
            </li>
            <li>
                <a href="#espacePaiement">Voir les commandes payées</a>
            </li>
        </ul>
    </div>
</div> 


<div class="col" style="justify-content:center;">
<div>
<h2 id="espaceAttente" class="m-4">Commandes en attente d'achat:</h2>
@if (count($attentionsAchat))
    <div class="card-deck">
        @foreach ($attentionsAchat as $commande)
        <div class="col-4">
            <div class="card ">
                <div class="card-body">
                    <h5 class="card-title">Commande n°{{$commande->id}}</h5>
                    <h5 class="card-text">Client : {{$commande->usager->lastname}},  {{$commande->usager->name}}</h5>
                    <p class="card-text">Email : {{$commande->usager->email}}</p>
                    <p class="card-text">Produit : {{$commande->produit->titre}}</p>
                    <p class="card-text">Taille : {{$commande->taille->taille}}</p>
                    <p class="card-text">Couleur : {{$commande->couleur->couleur}}</p>

                </div>
    
                <div class="row AdminCommande">
                    <form  method="POST" action="{{ route('commande.destroy', [$commande->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn  btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                    <form  method="POST" action="{{ route('commandes.paied', [$commande->id]) }}">
                        @csrf
                        <button class="btn btn-outline-primary statutCommande">Marquer comme payée</button>
                    </form>
                </div>
            </div>
              
            </div>
        @endforeach
    </div>
@endif
</div>

<div>
<h2 id="espacePaiement" class="m-4">Commandes payées:</h2>
@if (count($payed))
    <div class="card-deck">
        @foreach ($payed as $commande)
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Commande n°{{$commande->id}}</h5>
                    <h5 class="card-text">Client : {{$commande->usager->lastname}},  {{$commande->usager->name}}</h5>
                    <p class="card-text">Email : {{$commande->usager->email}}</p>
                    <p class="card-text">Produit : {{$commande->produit->titre}}</p>
                    <p class="card-text">Taille : {{$commande->taille->taille}}</p>
                    <p class="card-text">Couleur : {{$commande->couleur->couleur}}</p>
                </div>

                <div class="row AdminCommande">
                    <form  method="POST" action="{{ route('commandes.ramasse', [$commande->id]) }}">
                        @csrf
                        <button class="btn btn-outline-success statutCommande ">Ramassé</button>
                    </form>
                    <form  method="POST" action="{{ route('commandes.rembourser', [$commande->id]) }}">
                        @csrf
                        <button class="btn btn-outline-primary statutCommande">Rembourser</button>
                    </form>
                </div>
                </div>

            </div>
        @endforeach
    </div>
    @else
    <p>Aucune commande ramassée pour le moment.</p>
@endif
</div>

<div>
<h2 id="espaceRamassage" class="m-4">Commandes ramassées:</h2>
@if (count($ramasses))
    <div class="card-deck">
        @foreach ($ramasses as $commande)
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Commande n°{{$commande->id}}</h5>
                    <h5 class="card-text">Client : {{$commande->usager->lastname}},  {{$commande->usager->name}}</h5>
                    <p class="card-text">Email : {{$commande->usager->email}}</p>
                    <p class="card-text">Produit : {{$commande->produit->titre}}</p>
                    <p class="card-text">Taille : {{$commande->taille->taille}}</p>
                    <p class="card-text">Couleur : {{$commande->couleur->couleur}}</p>
                </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>Aucune commande ramassée pour le moment.</p>
@endif
    </div>
    
    <div class="m-4">
    
        <a href="#haut">Retourner en haut de la page</a>
    </div>
</div>
</div>


@endsection

 