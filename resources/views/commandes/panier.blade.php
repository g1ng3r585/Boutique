@extends('layouts.app')

@section('contenuPanier')
    <h2>Contenu du panier</h2>
    @foreach($commandes as $commande)
    @endforeach
@endsection