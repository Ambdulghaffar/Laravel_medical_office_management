@php
    use Carbon\Carbon;
@endphp

@extends('layouts.dashboard_layout')

@section('dashboard')
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-0 rounded fs-5">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rendez-vous réservés</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between mt-5">
            <div>
                <h6 class="mb-4 fs-2">Rendez-vous réservés</h6>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Navigation par mois -->
        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
            <a href="{{ route('appointment.reserved', ['month' => $previousMonth, 'year' => $previousYear]) }}"
                class="btn btn-outline-secondary">&lt; Mois précédent</a>
            <h4>{{ $currentMonth->translatedFormat('F Y') }}</h4>
            <a href="{{ route('appointment.reserved', ['month' => $nextMonth, 'year' => $nextYear]) }}"
                class="btn btn-outline-secondary">Mois suivant &gt;</a>
        </div>

        <!-- Jours du mois -->
        <div class="row row-cols-7 g-3">
            @foreach ($daysOfMonth as $day)
                <div class="col text-center">
                    <a href="{{ route('appointment.reserved', ['month' => $currentMonth->month, 'year' => $currentMonth->year, 'day' => $day]) }}"
                        class="btn btn-light w-100 @if ($day == request('day', Carbon::today()->day)) active @endif">
                        {{ $day }}
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Tableau des rendez-vous -->
        <div class="mt-5">
            <h5>Rendez-vous réservés pour le
                {{ request('day', Carbon::today()->day) }}/{{ $currentMonth->month }}/{{ $currentMonth->year }}
            </h5>

            @if ($appointments->isEmpty())
                <div class="alert alert-info">
                    Aucun rendez-vous réservé pour ce jour-là.
                </div>
            @else
                <div class="table-responsive mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom et Prénom</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <th>{{ $appointment->id }}</th>
                                    <td>{{ $appointment->user->name ?? '' }} {{ $appointment->user->lastname ?? '' }}</td>
                                    <td>{{ $appointment->user->phone ?? 'Non spécifié' }}</td>
                                    <td>{{ $appointment->user->email ?? 'Non spécifié' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->date_appointment)->format('d/m/Y') }}</td>
                                    <td>{{ $appointment->start_time }} - {{ $appointment->end_time }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#cancelModal{{ $appointment->id }}">
                                            <i class="bi bi-x-circle"></i>
                                        </button>

                                        <!-- Modal d'annulation -->
                                        <div class="modal fade" id="cancelModal{{ $appointment->id }}" tabindex="-1"
                                            aria-labelledby="cancelModalLabel{{ $appointment->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Annuler le rendez-vous</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Êtes-vous sûr de vouloir annuler ce rendez-vous ?
                                                        <p class="mt-2">
                                                            <strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->date_appointment)->format('d/m/Y') }}<br>
                                                            <strong>Heure:</strong> {{ $appointment->start_time }} - {{ $appointment->end_time }}<br>
                                                            <strong>Patient:</strong> {{ $appointment->user->name ?? '' }} {{ $appointment->user->lastname ?? '' }}
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ route('appointment.cancel', $appointment->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-danger">Confirmer l'annulation</button>
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
