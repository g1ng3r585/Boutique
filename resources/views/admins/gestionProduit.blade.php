@extends('layouts.app')

@section('title', 'Page gestion de produits')

@section('contenudumilieu')
<section class="main-container">


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="exampleModalToggleLabel">Création d'un nouveau produit</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>


      <div class="modal-body">
    <form method="POST" action="{{ route('produits.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group mt-2">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" required>
        </div>

        <div class="form-group mt-2">
            <label for="prix">Prix</label>
            <input type="number" id="prix" name="prix" required>
        </div>
        
        <div class="form-group mt-2">
            <label for="caracteristiques">Caractéristiques</label>
            <textarea id="caracteristiques" name="caracteristiques" required></textarea>
        </div>

        <div class="form-group mt-2">
            <label for="image">Sélectionner l'image</label>
            <!-- <input type="file" id="image" name="image" accept="image/*" required> -->
            <input class="form-control-file" id="image" type="file" value="" placeholder="URL du produit" name="image">
            <!-- <input type="text" id="image" name="image" placeholder="URL de l'image" required> -->
        </div>
        
        <div class="form-group mt-2">
            <label for="tailles">Tailles</label><br>
            <input type="radio" id="toutes_les_tailles" name="tailles" value="toutes_les_tailles" checked>
            <label for="toutes_les_tailles">Toutes les tailles</label><br>

            <input type="radio" id="choisir_tailles" name="tailles" value="taillesSelected">
            <label for="choisir_tailles">Sélectionner vos tailles</label><br>
            <div id="choix_tailles" style="display: none;">
                @foreach($tailles as $taille)
                    <input type="checkbox" name="tailles[]" value="{{ $taille->taille }}">
                    <label for="{{ $taille->id }}">{{ $taille->taille }}</label><br>
                @endforeach
            </div>
        </div>

        <div class="form-group mt-2">
            <label for="couleurs">Couleurs</label><br>
            <input type="radio" id="toutes_les_couleurs" name="couleurs" value="toutes_les_couleurs" checked>
            <label for="toutes_les_couleurs">Toutes les couleurs</label><br>

            <input type="radio" id="choisir_couleurs" name="couleurs" value="couleursSelected">
            <label for="choisir_couleurs">Sélectionner vos couleurs</label><br>
            <div id="choix_couleurs" style="display: none;">
            @foreach($couleurs as $couleur)
                <input type="checkbox" name="couleurs[]" value="{{ $couleur->couleur }}">
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







<div class="listCommandesHaut">
    <div>
    </div>
    <div class="navigationRapide">
        <h3>Navigation rapide:</h3>
        <ul>
            <li>
            <a href="{{ route('admins.index') }}">Page Admin</a>
            </li>
            <li>
                <a href="{{ route('admins.listeCommande') }}">Liste Commandes</a>
            </li>
            <li>
            <a href="{{ route('admins.gestionCouleurTaille') }}">Gestion Couleurs et tailles</a>
            </li>
        </ul>
    </div>
</div> 


<!-- dfgh -->

    <h1 style="text-align:center;">Liste produit</h1>
            <div class="container-fluid">
            <div class="row" style="justify-content:center;">
            @if (count($produits))
            @foreach ($produits as $produit)
                <div class="col-xl-2 produit" >
                    <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img class="img-thumbnail imgCouverture" src="{{ asset('/img/produits/' . $produit->image) }}" alt="{{ $produit->titre }}">
                    </a> 
                    
                    <p>Titre du produit : {{$produit->titre}}</p>
                <form method="POST" action="{{ route('produits.destroy', [$produit->id]) }}">
                    @csrf 
                    @method ('DELETE')
                    <button type="submit" class="btn btn-retirerCommande btn-danger ">Supprimer</button> 
                </form>
            </div>          
            @endforeach 
            @else
        <h1>Il n'y a aucune compagne en cours actuellement <h1>
            @endif

      
    </div>      
  </div>      


        
</section>








@endsection

 