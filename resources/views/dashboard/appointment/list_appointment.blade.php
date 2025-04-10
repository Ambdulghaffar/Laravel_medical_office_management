@extends('layouts.dashboard_layout')
@section('dashboard')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-0 rounded fs-5">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Créneaux de rendez-vous</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between mt-5">
                <div>
                    <h6 class="mb-4 fs-2">Liste des créneaux</h6>
                </div>
                <div>
                    <a href="">
                        <a href=""  class="btn btn-primary">Créer un créneau</a>
                        <button type="button" class="btn btn-secondary">Trier par</button>
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Jour</th>
                            <th>Heure début</th>
                            <th>Heure fin</th>
                            <th>Disponibilité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <tr>
                                <th scope="row">1</th>
                                <td>20/09/2009</td>
                                <td>Jeudi</td>
                                <td>09h30</td>
                                <td>10h00</td>
                                <td>

                                    <span class="badge bg-danger">Réservé</span>

                                </td>
                                <td>
                                    <a href="" class="btn text-primary"><i
                                            class="bi bi-pen-fill"></i></a>
                                    <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><i
                                            class="bi bi-trash3-fill"></i></button>

                                    <!-- Modal de suppression -->
                                    <div class="modal fade" id="deleteModal" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">
                                                        Supprimer le créneau</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer ce créneau ?
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
