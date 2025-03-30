@extends('layouts.dashboard_layout')
@section('dashboard')
    <div class="col-12 ">
        <div class="bg-light rounded h-100 p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-0 rounded fs-5">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between mt-5">
                <div>
                    <h6 class="mb-4 fs-2">Liste des utilisateurs</h6>
                </div>
                <div>
                    <a href="{{ route('user.create') }}"><button type="button" class="btn btn-primary">Ajouter</button></a>
                    <button type="button" class="btn btn-secondary">Trier par</button>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom complet</th>
                            <th scope="col">Email</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }} {{ $user->lastname }}</td>
                                <td><a href="https://mail.google.com/mail/?view=cm&fs=1&to=:{{ $user->email }}"
                                        target="_blank" class="text-primary">{{ $user->email }}</a></td>
                                <td><a href="tel:{{ $user->phone }}" class="text-warning">{{ $user->phone }}</a></td>
                                <td>{{ $user->address }}</td>
                                <td>
                                    @if ($user->role == 'patient')
                                        Patient
                                    @elseif ($user->role == 'doctor')
                                        Docteur
                                    @elseif ($user->role == 'secretary')
                                        Secrétaire
                                    @else
                                        {{ $user->role }}
                                    @endif
                                </td>

                                <td>
                                    @if ($user->role == 'doctor' || $user->role == 'secretary')
                                        <span class="fw-bold ms-4">Nul</span>
                                    @else
                                        <button type="button" class="btn btn-link fw-bold" data-bs-toggle="modal"
                                            data-bs-target="#statusModal{{ $user->id }}">
                                            @if ($user->status == 'pending')
                                                <span class="text-success fw-bold">En attente</span>
                                            @elseif ($user->status == 'consulted')
                                                <span class="text-info fw-bold">Consulté</span>
                                            @elseif ($user->status == 'canceled')
                                                <span class="text-danger fw-bold">Annulé</span>
                                            @elseif ($user->status == 'completed')
                                                <span class="text-success fw-bold">Complété</span>
                                            @else
                                                <span class="text-secondary fw-bold">{{ $user->status }}</span>
                                            @endif
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="statusModal{{ $user->id }}" tabindex="-1"
                                            aria-labelledby="statusModalLabel{{ $user->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="statusModalLabel{{ $user->id }}">
                                                            Modifier le statut</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('updateStatus', $user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label class="form-label">Sélectionnez un statut :</label>
                                                                <select class="form-select" name="status">
                                                                    <option value="pending"
                                                                        {{ $user->status == 'pending' ? 'selected' : '' }}>
                                                                        En attente</option>
                                                                    <option value="consulted"
                                                                        {{ $user->status == 'consulted' ? 'selected' : '' }}>
                                                                        Consulté</option>
                                                                    <option value="canceled"
                                                                        {{ $user->status == 'canceled' ? 'selected' : '' }}>
                                                                        Annulé</option>
                                                                    <option value="completed"
                                                                        {{ $user->status == 'completed' ? 'selected' : '' }}>
                                                                        Complété</option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Fermer</button>
                                                                <button type="submit" class="btn btn-primary">Mettre à
                                                                    jour</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>

                                <td class="">
                                    <a href="{{ route('user.edit',$user->id) }}" class="btn text-primary"><i class="bi bi-pen-fill"></i></a>
                                    <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop{{ $user->id }}"><i class="bi bi-trash3-fill"></i></button>
                                </td>
                            </tr>
                            </tr>
                        @endforeach
                    </tbody>
                </table>




                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel{{ $user->id }}">Suppression</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer cet utilisateur ?
                            </div>
                            <div class="modal-footer">
                                <form method="POST" action="{{ route('user.destroy',$user->id) }}"> 
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary  me-3" data-bs-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
