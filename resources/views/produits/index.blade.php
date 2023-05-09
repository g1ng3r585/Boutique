@extends('layouts.app')
@section('title', 'accueil')
@section('contenudumilieu')
<section class="main-container">
   <!-- Mettre un foreach pour les campagnes pour ne pas afficher des produits inactifs -->

   @if (count($produitsCompagne))
   <h1 style="text-align:center;">Campagne du: </h1>
   <h2 style="text-align:center;">{{ $compagneEnCours->dateDebut }} / {{ $compagneEnCours->dateFin }}</h2>

   @endif
   <div class="container-fluid">
      <div class="row" style="justify-content:center;">


      
      @if (count($produitsCompagne))
    @foreach ($produitsCompagne as $produit)
        <div class="col-xl-2 produit" >
        <a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $produit->id }}">
            <img class="imgCouverture" src="{{ asset('/img/produits/' . $produit->image) }}" alt="{{ $produit->titre }}">
         </a>

            <p>{{ $produit->titre }}</p>
        </div>
         <!-- Modal -->
         <div class="modal fade" id="exampleModal{{ $produit->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     @if (isset($produit))
                     <h5 class="modal-title" id="exampleModalLabel">{{ $produit->titre }}</h5>
                     @endif
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                  </div>
                  <div class="modal-body">
                     @if (isset($produit))
                     <div class="row">
                        <div class="col-md-6">
                           
                           <img class="imgCouverture" src="{{ asset('/img/produits/' . $produit->image) }}" alt="{{ $produit->titre }}">        
                        </div>
                        <form method="POST" action="{{ route('commandes.ajouter') }}" class="marginT m-4 ">
                        @csrf   
                        <!-- HIDDEN FIELD -->
                           <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                           
                           
                           <!-- -->
                           <div class="col-md-2">
                              <!-- retourner les données de la bdd -->
                              <div class="col-md-2 ms-auto mx-auto" style="text-align:center;">
                                 <h3 class="text-center" style="text-align: center">Taille</h3>
                                 <select name="taille_id" id="taille_id" class="taille-produit" >
                                    @foreach ($produit->tailles as $taille)
                                    <option value="{{$taille->id}}">{{$taille->taille}}</option>
                                    @endforeach  
                                 </select>
                              </div>
                              <!-- faire un système pour retourner un dot avec le hex de la bdd -->
                              <div class="col-md-2 ms-auto mx-auto"  class="couleur-produit">
                                 <h3>Couleurs</h3>
                                 <select placeholder="couleur" name="couleur_id" class="couleur-produit" id="couleur_id" >
                                    @foreach ($produit->couleurs as $couleur)
                                    <option  value="{{$couleur->id}}" style="background-color: {{$couleur->hex}};">{{$couleur->couleur}}</option>
                                    @endforeach  
                                 </select>
                              </div>
                              <div class="col-md-2 ms-auto mx-auto">
                                 <div class="form-group">
                                 <h3>Quantite</h3>
                                 <select name="quantite">
                                    @foreach (range(1, $produit->nombreMax) as $quantite)
                                       <option value="{{ $quantite }}">{{ $quantite }}</option>
                                    @endforeach
                                    </select>
                                 </div>
                              </div>
                              <!-- -->
                           </div>
                     </div>
                     @endif   
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                  <button type="submit" class="btn btn-primary ajouter-commande">Ajouter au panier</button>
                  </div>
                  </form>


               </div>
            </div>
         </div>
         <!-- End Modal -->
         @endforeach 
         @else
         <h1>
         Il n'y a aucune compagne en cours actuellement 
         <h1>
         @endif
      </div>
   </div>
</section>
@endsection