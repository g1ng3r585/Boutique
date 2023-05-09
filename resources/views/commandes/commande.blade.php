@extends('layouts.app')

@section('title', 'Page compagne')

@section('contenudumilieu')


<div class="pad ml-5">
<div class="container-fluid">
    @if (auth()->check())
    <h2>Mes commandes :</h2>
    
    <div class="col" >
                @if (count($commandes))

                <div class="panierAttention">
                    <h2>Commandes non payées</h2>
                    @if (count($attentionsAchat))
                    <!--attention achats-->
                    @foreach ($attentionsAchat as $commande)
                    <div class="col-xl-2 produit" >
                        <p>Titre du produit : {{$commande->produit->titre}}</p>
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <img class="img-thumbnail imgCouverture" src="{{ asset('/img/produits/' . $commande->produit->image) }}" alt="{{ $commande->produit->titre }}">
                            </a> 
                        <div style="display: flex; justify-content: center;">   
                                <p>Couleur: </p>
                            <div class="ml-2" style="background-color: {{$commande->couleur->hex}}; width: 20px; height: 20px; border-radius: 50%;"></div>       
                        </div>
                        <p>Taille : {{$commande->taille->taille}}</p>    
                        <p>Quantité : {{$commande->quantite}}</p>    
                        <form method="POST" action="{{ route('commande.destroy', [$commande->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-retirerCommande btn-outline-danger">Retirer</button>
                        </form>                        
                    </div>
                    @endforeach 
                    @else
                    <p>Vous n'avez aucune Commandes non payé </p>
                    
                    @endif
                    @if (count($payed))
                </div>

                        <!--payed-->
                <div class="panierPaye">
                <h2>Commandes payées</h2>
                    @foreach ($payed as $commande)
                        <div class="col-xl-2 produit" >
                            <p>Titre du produit : {{$commande->produit->titre}}</p>
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <img class="img-thumbnail imgCouverture" src="{{ asset('/img/produits/' . $commande->produit->image) }}" alt="{{ $commande->produit->titre }}">
                                </a> 
                            <div style="display: flex; justify-content: center;">   
                                    <p>Couleur: </p>
                                <div class="ml-2" style="background-color: {{$commande->couleur->hex}}; width: 20px; height: 20px; border-radius: 50%;"></div>       
                            </div>
                            <p>Taille : {{$commande->taille->taille}}</p>    
                            <p>Quantité : {{$commande->quantite}}</p>                      
                        </div>
                        @endforeach 
                        @else
                        <p>Vous n'avez aucune commande payé </p>
                        @endif
                </div>
                       



                        @else
                        <p>Vous n'avez aucune commande dans la compagne en cours</p>
                        @endif
                    @else
                    <p>Veuillez vous connecter pour voir vos commandes.</p>
                    <a href="{{ route('usagers.formConnexion') }}">Se connecter</a>
                    @endif
    </div>
    <div >




    </div>
    </div>
</div>



@endsection