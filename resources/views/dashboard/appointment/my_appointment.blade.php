@extends('layouts.dashboard_layout')

@section('dashboard')
    <div class="col-12 ">
        <div class="bg-light rounded h-100 p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-0 rounded fs-5">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Mes rendez-vous</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between mt-5">
                <div>
                    <h6 class="mb-4 fs-2">Liste de mes rendez-vous</h6>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($appointments->isEmpty())
                <div class="alert alert-info">
                    Vous n'avez réservé aucun rendez-vous pour le moment.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom complet</th>
                                <th>Adresse</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <th scope="row">{{ $appointment->id }}</th>
                                    <td>{{ $appointment->user->name }} {{ $appointment->user->lastname }}</td>
                                    <td>{{ $appointment->user->address }}</td>
                                    <td>
                                        @if ($appointment->user->status == 'pending')
                                            <span class="text-warning fw-bold">En attente</span>
                                        @elseif ($appointment->user->status == 'consulted')
                                            <span class="text-info fw-bold">Consulté</span>
                                        @elseif ($appointment->user->status == 'canceled')
                                            <span class="text-danger fw-bold">Annulé</span>
                                        @elseif ($appointment->user->status == 'completed')
                                            <span class="text-success fw-bold">Complété</span>
                                        @else
                                            <span class="text-secondary fw-bold">{{ $appointment->user->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->date_appointment)->format('d/m/Y') }}</td>
                                    <td>{{ $appointment->start_time }} - {{ $appointment->end_time }}</td>
                                    <td>
                                        @if ($appointment->status != 'canceled')
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#cancelModal{{ $appointment->id }}">
                                                Annuler
                                            </button>

                                            <!-- Modal d'annulation -->
                                            <div class="modal fade" id="cancelModal{{ $appointment->id }}" tabindex="-1"
                                                aria-labelledby="cancelModalLabel{{ $appointment->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="cancelModalLabel{{ $appointment->id }}">
                                                                Annuler le rendez-vous</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Êtes-vous sûr de vouloir annuler ce rendez-vous ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST"
                                                                action="{{ route('appointment.cancel', $appointment->id) }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Fermer</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Annuler</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">Aucune action</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
@endsection
