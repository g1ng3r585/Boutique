@extends('layouts.app')

@section('title', 'Page compagne')

@section('contenudumilieu')


<div class="adminPage">
<div class="container-fluid">


<div class="listCommandesHaut">
    <div>

    @if (count($enCours)>0)
    <div class="gestionCompagneEnCours">
        <button  type="submit" class="btn btn-dark btnAjoutCompagne disabled" >Une campagne est déjà cours</button> <br>
        <button class="btn btn-primary  ajoutProduitCompagne " data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Ajouter un nouveau produit à la campagne</button> 
    </div>
    @else
    <div class="gestionCompagneEnCours">
        <button class="btn btn-primary btnAjoutCompagne" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Ajouter une campagne</button><br> 
        <button class="btn btn-secondary disabled ajoutProduitCompagne" >Ajouter un nouveau produit à la campagne</button> 
    </div>
    @endif


    </div>
    <div class="navigationRapide">
        <h3>Menu:</h3>
        <ul>
            <li>
            <a href="{{ route('admins.gestionProduit') }}" >Gestion Produits</a>
            </li>
            <li>
            <a href="{{ route('admins.listeCommande') }}" >Liste Commandes</a>
            </li>
            <li>
            <a href="{{ route('admins.gestionCouleurTaille') }}" >Gestion Couleurs et tailles</a>
            </li>
        </ul>
    </div>
</div> 

    

        <!--Tableau des compagnes en cours-->
        <div class="row ">
            <div class="col-xl-12 ">
                <h1 class="text-center">Campagne en cours</h1> 
                    <table class="table  ">
                        <thead>
                            <tr>
                                <th scope="col">Date de début</th>
                                <th scope="col">Date de fin</th>
                                <th scope="col">Date de paiement</th>
                                <th scope="col">Date de fin de paiement</th>
                                <th scope="col">Date de distribution</th>
                                <th scope="col">Date de fin de distribution</th>
                                <th scope="col">Statut de campagne</th>
                                <th scope="col">Statut de commande</th>
                                <th scope="col">Gestion</th>


                            </tr>
                        </thead>
                        <tbody >
                        @if (count($compagnes)) 
                            @foreach ($enCours as $compagne)
                                <tr>
                                <td>{{$compagne->dateDebut}}</td>
                                <td>{{$compagne->dateFin}}</td>
                                <td>{{$compagne->debutPaiement}}</td>
                                <td>{{$compagne->finPaiement}}</td>
                                <td>{{$compagne->debutDistribution}}</td>
                                <td>{{$compagne->finDistribution}}</td>
                                <td>{{$compagne->statutCompagne}}</td>
                                <td>{{$compagne->statutCommande }}</td>
                                <td>
                                    <div>
                                        
                                        <button class="btn btn-primary " data-bs-target="#buttonModif" data-bs-toggle="modal">Modifier</button> 

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

            <!--Boutton de création de la compagne -->      
            @if (count($enCours)>0)

             


            <!-- Modal de mofication de campagne-->
                        <div class="modal fade" id="buttonModif" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modification de la campagne du {{$compagne->dateDebut}} - {{$compagne->dateFin}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                <form method="POST" action="{{ route('compagnes.update', [$compagne->id]) }}">
                                    @csrf 
                                    @method ('PATCH')

                <!--Statut de commande-->    
                        <div class="modal-body">
                            <form method="POST" action="{{ route('compagnes.update', [$compagne->id]) }}">
                                @csrf
                                @method ('PATCH')

                                <label for="enCommande">En commande</label>
                                        <input type="radio" id="enCommande" name="statutCommande" value="enCommande" checked>
                                        <br>
                                        <label for="enTraitement">En traitement</label>
                                        <input type="radio" id="enTraitement" name="statutCommande" value="enTraitement">
                                        <br>
                                        <label for="enPaiement">En paiement</label>
                                        <input type="radio" id="enPaiement" name="statutCommande" value="enPaiement">
                                        <br>
                                        <label for="enDistribution">En distribution</label>
                                        <input type="radio" id="enDistribution" name="statutCommande" value="enDistribution">
                                        <br>
                                        <label for="terminer">Terminée</label>
                                        <input type="radio" id="terminer" name="statutCommande" value="terminer">
                                        <br>

                                    <div class="form-group mt-2">
                                        <label for="dateDebut">Date de début</label>
                                        <input type="text" class="form-control" id="dateDebut" placeholder="AAAA-MM-JJ" value="{{ old( 'dateDebut', $compagne->dateDebut) }}" name="dateDebut">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="dateFin">Date de Fin</label>
                                        <input type="text" class="form-control" id="dateFin" placeholder="AAAA-MM-JJ" value="{{ old( 'dateFin', $compagne->dateFin) }}" name="dateFin">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="debutPaiement">Date de Debut de Paiement</label>
                                        <input type="text" class="form-control" id="debutPaiement" placeholder="AAAA-MM-JJ" value="{{ old( 'debutPaiement', $compagne->debutPaiement) }}" name="debutPaiement">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="finPaiement">Date de Fin de Paiement</label>
                                        <input type="text" class="form-control" id="finPaiement" placeholder="AAAA-MM-JJ" value="{{ old( 'finPaiement', $compagne->finPaiement) }}" name="finPaiement">
                                    </div>      
                                    <div class="form-group mt-2">
                                        <label for="debutDistribution">Date de Debut de Distribution</label>
                                        <input type="text" class="form-control" id="debutDistribution" placeholder="AAAA-MM-JJ" value="{{ old( 'debutDistribution', $compagne->debutDistribution) }}" name="debutDistribution">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="finDistribution">Date de Fin de Distribution</label>
                                        <input type="text" class="form-control" id="finDistribution" placeholder="AAAA-MM-JJ" value="{{ old( 'finDistribution', $compagne->finDistribution) }}" name="finDistribution">
                                    </div>    
                                </div>

                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                        <button type="submit" class="btn btn-primary">Modifier le campagne</button>

                            </div>
                            </form>
                            </div>
                
                            </div>
                        </div>
                        </div>
        <!-- fin  Modal de mofication de compagne-->

                @else
                        




        <!-- debut  Modal de creation de compagne-->
                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="exampleModalToggleLabel">Création d'une nouvelle campagne</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form method="POST" action="{{ route('compagnes.store') }}">
                            @csrf
                            <div class="form-group mt-2">
                                <label for="dateDebut">Date de début</label>
                                <input type="text" id="dateDebut" name="dateDebut" placeholder="AAAA-MM-JJ" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="dateFin">Date de fin</label>
                                <input type="text" id="dateFin" name="dateFin" placeholder="AAAA-MM-JJ"  required>
                            </div>
                            
                            <div class="form-group mt-2">
                                <label for="debutPaiement">Date de début de paiement</label>
                                <input type="text" id="debutPaiement" name="debutPaiement" placeholder="AAAA-MM-JJ"  required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="finPaiement">Date de fin de paiement</label>
                                <input type="text" id="finPaiement" name="finPaiement" placeholder="AAAA-MM-JJ" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="debutDistribution">Date de début de distribution</label>
                                <input type="text" id="debutDistribution" name="debutDistribution" placeholder="AAAA-MM-JJ" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="finDistribution">Date de fin de distribution</label>
                                <input type="text" id="finDistribution" name="finDistribution" placeholder="AAAA-MM-JJ" required>
                            </div>
  

                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                                <button type="submit" class="btn btn-primary">Créer la campagne</button>
                                        </div>
                        </form>
                        </div>
                        </div>
                    </div>
                    </div>

             
                        <!-- fin  Modal de creation de compagne-->

                @endif


     
        </div>
            
        </div>
<!--Modal d'ajout de produit-->

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="exampleModalToggleLabel">Création d'un nouveau produit</h3>
      </div>
      <div class="modal-body">
    <form method="POST" action="{{ route('produits.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group mt-2">
            <label for="titre">Titre: </label><br>
            <input type="text" id="titre" name="titre" required>
        </div>

        <div class="form-group mt-2">
            <label for="prix">Prix: </label><br>
            <input type="number" id="prix" name="prix" min="1" value="1"  required>
        </div>
        <div class="form-group mt-2">
            <label for="nombreMax">Quantité maximum par personne: </label><br>
            <input type="number" id="nombreMax" name="nombreMax" min="1" value="1" required>
        </div>
        <div class="form-group mt-2">
            <label for="caracteristiques">Caractéristiques: </label><br>
            <textarea id="caracteristiques" name="caracteristiques" required></textarea>
        </div>

        <div class="form-group mt-2">
            <label for="image">Image: </label>
            <!-- <input type="file" id="image" name="image" accept="image/*" required> -->
            <input class="form-control-file" id="image" type="file" value="" placeholder="URL du produit" name="image">
            <!-- <input type="text" id="image" name="image" placeholder="URL de l'image" required> -->
        </div>
        
        <div class="form-group mt-2">
            <label for="tailles">Tailles: </label><br>
            <input type="radio" id="toutes_les_tailles" name="tailles" value="toutes_les_tailles" checked>
            <label for="toutes_les_tailles">Toutes les tailles</label><br>

            <input type="radio" id="choisir_tailles" name="tailles" value="taillesSelected">
            <label for="choisir_tailles">Sélectionner vos tailles</label><br>
            <div id="choix_tailles" style="display: none;">
                @foreach($tailles as $taille)
                    <input type="checkbox" name="tailles[]" value="{{ $taille->id }}">
                    <label for="{{ $taille->id }}">{{ $taille->taille }}</label><br>
                @endforeach
            </div>
        </div>

        <div class="form-group mt-2">
            <label for="couleurs">Couleurs: </label><br>
            <input type="radio" id="toutes_les_couleurs" name="couleurs" value="toutes_les_couleurs" checked>
            <label for="toutes_les_couleurs">Toutes les couleurs</label><br>

            <input type="radio" id="choisir_couleurs" name="couleurs" value="couleursSelected">
            <label for="choisir_couleurs">Sélectionner vos couleurs</label><br>
            <div id="choix_couleurs" style="display: none;">
            @foreach($couleurs as $couleur)
                <input type="checkbox" name="couleurs[]" value="{{ $couleur->id }}">
                <label for="{{ $couleur->id }}">{{ $couleur->couleur }}</label><br>
            @endforeach

            </div>
        </div>

            <script>
                const toutesLesTaillesRadio = document.getElementById('toutes_les_tailles');
                const choisirTaillesRadio = document.getElementById('choisir_tailles');

                const choixTaillesDiv = document.getElementById('choix_tailles');
                choisirTaillesRadio.addEventListener('click', () => {
                    toutesLesTaillesRadio.checked = false;
                    choixTaillesDiv.style.display = 'block';
                });
                toutesLesTaillesRadio.addEventListener('click', () => {
                    choixTaillesDiv.style.display = 'none';
                });

                const toutesLesCouleursRadio = document.getElementById('toutes_les_couleurs');
                const choisirCouleursRadio = document.getElementById('choisir_couleurs');
                const choixCouleursDiv = document.getElementById('choix_couleurs');
                choisirCouleursRadio.addEventListener('click', () => {
                    toutesLesCouleursRadio.checked = false;
                    choixCouleursDiv.style.display = 'block';
                });
                toutesLesCouleursRadio.addEventListener('click', () => {
                    choixCouleursDiv.style.display = 'none';
                });

                function toggleSelectCouleurs() {
                    if (choisirCouleursRadio.checked) {
                        choixCouleursDiv.style.display = 'block';
                    } else {
                        choixCouleursDiv.style.display = 'none';
                    }
                }

                toutesLesCouleursRadio.addEventListener('click', toggleSelectCouleurs);
                choisirCouleursRadio.addEventListener('click', toggleSelectCouleurs);

                toggleSelectCouleurs();
            </script>
                <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
            <button type="submit" class="btn btn-primary">Créer le produit</button>
    </div>
    </form>
    </div>
    </div>
  </div>
</div>
<!--Fin Modal produit-->
        <!--Tableau des compagnes terminé-->
        <div class="row ml-5">
            <div class="col-xl-11">
                <h1 class="text-center">Campagnes précédentes</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Date de début</th>
                                <th scope="col">Date de fin</th>
                                <th scope="col">Date de début de paiement</th>
                                <th scope="col">Date de fin de paiement</th>
                                <th scope="col">Date de début de distribution</th>
                                <th scope="col">Date de fin de distribution</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (count($compagnes))
                            @foreach ($terminer as $compagne)
                                <tr>
                                <td>{{$compagne->dateDebut}}</td>
                                <td>{{$compagne->dateFin}}</td>
                                <td>{{$compagne->debutPaiement}}</td>
                                <td>{{$compagne->finPaiement}}</td>
                                <td>{{$compagne->debutDistribution}}</td>
                                <td>{{$compagne->finDistribution}}</td> 
                                <td>
                                    <div>

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
</div>



@endsection