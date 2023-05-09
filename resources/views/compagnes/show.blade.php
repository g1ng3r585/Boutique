@extends('layouts.app')

@section('title', 'Infos de la compagne')
@section('contenudumilieu')

<div class="pad">
            <div class="container-fluid">
                <div class="row">
                    @if (isset($compagne))
                    <div class="col-xl-5">
                    <!--Produits de la compagne-->
                    @foreach ($compagne->produits as $produit)
                        <div class="col-xl-2" style="margin:50px; text-align:center;">
                            <a href="{{ route('produits.show', [$produit]) }}">
                            <img class="imgCouverture"  src="{{ asset('/img/produits/' . $produit->image) }}"
                            alt="{{ $produit->type }}" ></a> 
                            <p>{{ $produit->type }}</p>
                        </div>      
                    @endforeach 
                    </div>
                
            </div>


            @else
            <h1>la compagne est vide<h1>
            @endif
        </div>


    </div>   
    </div>
</div>
@endsection