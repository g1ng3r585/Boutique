@extends('layouts.app')

@section('title', 'Page superadmin')

@section('contenudumilieu')
   

        <div class="pad ml-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-7">
                        <h1 class="text-center">Liste des admins</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (count($admins))
                                @foreach ($admins as $admin)
                                    <tr>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->lastname}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admins.destroy', [$admin->id]) }}">
                                            @csrf 
                                            @method ('DELETE')

                                            <button type="submit" class="btn btn-outline-danger delAdmin"><i class="fa fa-trash" aria-hidden="true"></i></button> 
                                        </form></td>
                                    </tr>
                                    @endforeach 
                            @endif
                                </tbody>
                                </table>
                    </div>
                    <!-- Button trigger modal -->
                    <div class="pad2 mx">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createadmin">
                        Créer un nouvel admin
                        </button>
                    </div>
                    
                    
                    <!-- Modal -->
                    <div class="modal fade" id="createadmin" tabindex="-1" aria-labelledby="createadmin" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Formulaire de création d'admins</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <!-- Modal body -->

                                    <form method="POST" action="{{ route('admins.store') }}" class="marginT">
                                    @csrf
                                    <div class="form-group mt-2">
                                        <label for="name">Prénom</label>
                                        <input type="text" class="form-control" id="name" placeholder="Prenom" name="name">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="lastname">Nom de famille</label>
                                        <input type="text" class="form-control" id="lastname" placeholder="Nom de Famille" name="lastname">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="email">Addresse mail</label>
                                        <input type="email" class="form-control" id="email" placeholder="Adresse courriel" name="email">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
                                    </div>
                                    <button type="submit" class="btn btn-primary m-4">Créer l'admin</button> 
                                    </form>
                                    <!-- End Modal body-->
                                </div>

                         
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                

            </div>

        </div>
    </div>   
    </div>
</div>
@endsection