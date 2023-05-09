@extends('layouts.app')

@section('title', 'Page gestion des couleurs/tailles')

@section('contenudumilieu')



<div class="pad ml-5">
    <div class="container-fluid">

        <div class="listCommandesHaut">
        <div>
            
        <button class="btn btn-primary " data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Ajouter une couleur</button> 
        <button class="btn btn-primary " data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Ajouter une taille</button> 

            
        </div>
        <div id="haut"  class="navigationRapide">
            <h3>Navigation rapide:</h3>
            <ul>
                <li>
                <a href="{{ route('admins.index') }}">Page Admin</a>
                </li>
                <li>
                <a href="{{ route('admins.listeCommande') }}">Liste Commandes</a>
                </li>
                <li>
                <a href="{{ route('admins.gestionProduit') }}">Gestion de produits</a>
                </li>
            </ul>
        </div>
    </div> 
    <!--Tableau des couleur-->
        <div class="row ml-5">
            <div class="col-xl-6">



                <h1 id="haut" class="text-center">Liste des couleurs</h1>
                    <table class="table">
                        <thead>
                            <tr>

                                <th scope="col">Nom</th>
                                <th scope="col">Couleur</th>
                                <th scope="col">Hex</th>
                                <th scope="col">Supprimer</th>

                            </tr>
                        </thead>
                        <tbody>
                        @if (count($couleurs))
                            @foreach ($couleurs as $couleur)
                                <tr>
                                    <td>{{$couleur->couleur}}</td>
                                    <td><div class="ml-2" style="background-color: {{$couleur->hex}}; width: 20px; height: 20px; border-radius: 50%;"></div>       </td>
                                    <td>{{$couleur->hex}}</td>
                                    <td><div><form method="POST" action="{{ route('couleurs.destroy', [$couleur->id]) }}">
                                                @csrf 
                                                @method ('DELETE')
                                                <button type="submit" class="btn btn-danger ">Supprimer</button> 
                                            </form>     
                                        </div>
                                    </td>
                                </tr>
                        @endforeach 
                        @endif
                        </tbody>
                    </table>
            </div>
            
            <div class="col-xl-6">

                <h1 class="text-center">Liste des tailles</h1>
                    <table class="table">
                        <thead>
                            <tr>

                                <th scope="col">Taille</th>
                                <th scope="col">Supprimer</th>

                            </tr>
                        </thead>
                        <tbody>
                        @if (count($tailles))
                            @foreach ($tailles as $taille)
                                <tr>
                                    <td>{{$taille->taille}}</td>
                                    <td>
                                        <div>
                                            <form method="POST" action="{{ route('tailles.destroy', [$taille->id]) }}">
                                                @csrf 
                                                @method ('DELETE')
                                                <button type="submit" class="btn btn-danger ">Supprimer</button> 
                                            </form>     
                                        </div>
                                    </td>
                                </tr>
                        @endforeach 
                        @endif
                        </tbody>
                    </table>
            </div> 

        </div>
    </div> 


        <!-- debut  Modal de creation de couleur-->
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="exampleModalToggleLabel">Création d'une nouvelle couleur</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form method="POST" action="{{ route('couleurs.store') }}">
                            @csrf
                            <div class="form-group mt-2">
                                <label for="couleur">Couleur</label>
                                <input type="text" id="couleur" name="couleur" placeholder="Nom de la couleur" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="hex">Hex de la couleur</label>
                                <input type="text" id="hex" name="hex" placeholder="#..." required>
                            </div>
                           
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                    <button type="submit" class="btn btn-primary">Créer la couleur</button>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                    </div>
                        <!-- fin  Modal de creation de couleur-->

    
</div>




        <!-- debut  Modal de creation de taille-->
        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title fs-5" id="exampleModalToggleLabel2">Création d'une nouvelle taille</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('tailles.store') }}">
                                    @csrf
                                    <div class="form-group mt-2">
                                        <label for="taille">Taille</label>
                                        <input type="text" id="taille" name="taille" placeholder="Exemple: Petit" required>
                                    </div>
                                
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                            <button type="submit" class="btn btn-primary">Créer la taille</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
                        <!-- fin  Modal de creation de compagne-->
        <div class="m-4 my-0">
            <a href="#haut">Retourner en haut de la page</a>
        </div>



    
</div>

@endsection

 