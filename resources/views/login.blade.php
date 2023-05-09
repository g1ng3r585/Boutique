@extends('layouts.app')

@section('title', 'connexion')
@section('contenudumilieu')
    <!-- MAIN CONTAINER -->
     
    <div class="container">
    <div class="row">
        <div class="col-xl-6 offset-xl-3">
            <form method="POST" action="" class="marginT">
            @csrf
                <div class="form-group mt-2">
                    <label for="email">Addresse mail</label>
                    <input type="email" class="form-control" id="email" placeholder="Adresse courriel" name="email">
                </div>
                <div class="form-group mt-2">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
                </div>
                <button type="submit" class="btn btn-primary mt-4">Connexion</button> 
            </form>
        </div>
    </div>
</div>