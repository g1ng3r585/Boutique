<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset ('css/style.css') }}">    


</head>    

<!-- END OF HEADER -->
<body>
<header>

<!-- NAVBAR -->

<nav class="navbar navbar-custom">
    <div class="netflixLogo">      
    <H1 class="navbar-brand" >
      @if(!auth()->check() || (auth()->check() && auth()->user()->type == 'Client'))
      <a href="{{ route('produits.index') }}">
         <img src="/img/cegeptrInfo.png" alt="Logo Image" style="width: 200px">
      </a>
      @else
         <img src="/img/cegeptrInfo.png" alt="Logo Image" style="width: 200px">
      @endif

   </H1>
  
    </div>
    
    <div>
    <nav class="sub-nav">    
    <div class="d-flex mr-5">
       @if(auth()->check())
       <form method="GET" action="{{route('logout')}}">
          @csrf
          <button type="submit" class="btn btn-danger btn-deconnexion">Déconnecter</button>
         </form>
         @else
         <a href="{{ route('clients.create') }}" class="btn btn-outline-light btn-compte">Création de compte</a>
         <a href="{{ route('usagers.formConnexion') }}" class="btn btn-connexion btn-primary ">Connexion</a>

         @endif

      @if(!auth()->check() || (auth()->check() && auth()->user()->type == 'Client'))

         <a href="{{ route('commandes.commande') }}" class="panier">
          <i class="fa fa-shopping-cart" aria-hidden="true" ></i></a>
          @endif

      </div>
    </nav>
  </div>
</nav>     

<!-- END OFNAVBAR -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    </header>

      
    
        @yield('contenudumilieu')


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>

</body>



<footer class="bgN">

<div class="row">
      <div class="col-xl-2 offset-xl-2 col-md-2">
        <h3>Accueil</h3>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
        </ul>
      </div>



      <div class="col-xl-2 col-md-2">
        <h3>Réseaux</h3>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="https://www.tiktok.com/@cegeptr" class="nav-link p-0 text-muted">Site Officiel</a></li>
          <li class="nav-item mb-2"><a href="https://www.facebook.com/cegeptr/" class="nav-link p-0 text-muted">Facebook</a></li>
          <li class="nav-item mb-2"><a href="https://www.instagram.com/cegeptr/" class="nav-link p-0 text-muted">Instagram</a></li>
          <li class="nav-item mb-2"><a href="https://www.cegeptr.qc.ca/" class="nav-link p-0 text-muted">TikTok</a></li>
         
        </ul>
      </div>

      <div class="col-xl-4 offset-xl-1 col-md-4 aide">
        <form>
          <h3>Besoin d'aide ? </h3>
          <h6>Contactez-nous</h6>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2  ">
            <input id="newsletter1" type="text" class="form-control" placeholder="Courriel">
            <button class="btn btn-outline-primary ml-1" type="button">Envoyer</button>
          </div>
        </form>
      </div>
    </div>


      <p>&copy 2023-2023 EkipBouTik, Inc.</p>
      <p>© 2023 667 EkipBouTik. RPZ la street </p>
</footer>
  </div>

</html>
