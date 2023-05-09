
<meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Connexion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
 <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
  <script src="main.js"></script>
</head>
<body>
@if($errors->has('email'))
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->get('email') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



  <div class="wrapper">

    <!-- HEADER -->
    <header>
  

<!-- NAVBAR -->

<nav class="navbar navbar-custom">
    <div class="">      
    <H1 class="navbar-brand" >
      <a href="{{ route('produits.index') }}">
      <img src="/img/cegeptrInfo.png" alt="Logo Image" style="width: 200px"></a></H1>
    </div>
    
    <div>
    <nav class="sub-nav">    

    </nav>
  </div>
</nav>     
      
    </header>
    <!-- END OF HEADER -->

    <!-- MAIN CONTAINER -->
<div class="container mt-5 ">
    <div class="row m-2 bg-light ">
        <div class=" offset-xl-3 col-xl-6 ">
        <h2 class="text-center">CONNEXION</h2>

            <form method="POST" action="{{ route('usagers.connexion') }}" class="marginT m-4 ">
            @csrf
                <div class="form-group mt-2">
                    <label for="email">Courriel: </label>
                    <input type="email" class="form-control" id="email" placeholder="Adresse courriel" name="email">
                </div>
                
                <div class="form-group mt-2">
                    <label for="password">Mot de passe: </label>
                    <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
                </div>
                <button type="submit" class="btn btn-primary mt-4">Connexion</button>
                <a href="{{ route('clients.create') }}" class="btn btn-dark mt-4 ">Création de compte</a>
            </form>
        </div>
    </div>
</div>




</div>
</div>
</div>
</div>


    <!-- FOOTER -->
    <footer>

    </footer>
  </div>

<script src="https://kit.fontawesome.com/ce7fbe0b49.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>