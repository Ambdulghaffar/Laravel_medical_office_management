@extends('layouts.dashboard_layout')
@section('dashboard')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light pt-3  rounded fs-5">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user') }}">Utilisateurs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajout des utilisateurs</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between mt-5">
                <h6 class="mb-4 fs-2">Ajout des utilisateurs</h6>
            </div>
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <form method="post" action="{{ route('user.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastname" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="lastname" name="lastname">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">Rôle</label>
                                <select class="form-select" id="role" name="role">
                                    <option value="patient">Patient</option>
                                    <option value="doctor">Docteur</option>
                                    <option value="secretary">Secrétaire</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Mode de passe</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-3">Ajouter</button>
                            <button type="reset" class="btn btn-secondary">Supprimer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
