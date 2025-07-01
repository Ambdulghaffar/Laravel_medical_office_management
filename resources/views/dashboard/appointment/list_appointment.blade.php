
@php
    use Carbon\Carbon;
@endphp

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
                <div class="me-2">
                    <a href="{{ route('appointment.create') }}" class="btn btn-primary">Créer un créneau</a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Affichage du mois actuel avec navigation -->
            <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                <a href="{{ route('appointment', ['month' => $previousMonth, 'year' => $previousYear]) }}"
                    class="btn btn-outline-secondary">&lt; Mois précédent</a>
                <h4>{{ $currentMonth->translatedFormat('F Y') }}</h4>
                <a href="{{ route('appointment', ['month' => $nextMonth, 'year' => $nextYear]) }}"
                    class="btn btn-outline-secondary">Mois suivant &gt;</a>
            </div>

            <!-- Calendrier des jours du mois actuel -->
            <div class="row row-cols-7 g-3">
                @foreach ($daysOfMonth as $day)
                    <div class="col text-center">
                        <a href="{{ route('appointment', ['month' => $currentMonth->month, 'year' => $currentMonth->year, 'day' => $day]) }}"
                            class="btn btn-light w-100 @if ($day == request('day', Carbon::today()->day)) active @endif">
                            {{ $day }}
                        </a>
                        
                    </div>
                @endforeach
            </div>

            <!-- Affichage des rendez-vous disponibles pour le jour sélectionné (par défaut, le jour actuel) -->
            <div class="mt-5">
                <h5>Rendez-vous pour le
                    {{ request('day', Carbon::today()->day) }}/{{ $currentMonth->month }}/{{ $currentMonth->year }}</h5>

                <!-- Vérification si des rendez-vous sont disponibles -->
                @if ($appointments->isEmpty())
                    <div class="alert alert-warning">
                        Aucun rendez-vous disponible pour ce jour-là. Veuillez choisir un autre jour.
                    </div>
                @else
                    <div class="table-responsive mt-5">
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
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <th scope="row">{{ $appointment->id }}</th>
                                        <td>{{ \Carbon\Carbon::parse($appointment->date_appointment)->format('d/m/Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($appointment->date_appointment)->translatedFormat('l') }}
                                        </td>
                                        <td>{{ $appointment->start_time }}</td>
                                        <td>{{ $appointment->end_time }}</td>
                                        <td>
                                            @if ($appointment->availability === 'free')
                                                <span class="badge bg-success">Libre</span>
                                            @elseif ($appointment->availability === 'reserved')
                                                <span class="badge bg-danger">Réservé</span>
                                            @elseif ($appointment->availability === 'unavailable')
                                                <span class="badge bg-secondary">Indisponible</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('appointment.edit', $appointment->id) }}"
                                                class="btn text-primary"><i class="bi bi-pen-fill"></i></a>
                                            <button type="button" class="btn text-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $appointment->id }}"><i
                                                    class="bi bi-trash3-fill"></i></button>

                                            <!-- Modal de suppression -->
                                            <div class="modal fade" id="deleteModal{{ $appointment->id }}" tabindex="-1"
                                                aria-labelledby="deleteModalLabel{{ $appointment->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="deleteModalLabel{{ $appointment->id }}">Supprimer le
                                                                créneau</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Êtes-vous sûr de vouloir supprimer ce créneau ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST"
                                                                action="{{ route('appointment.destroy', $appointment->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Fermer</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Supprimer</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
