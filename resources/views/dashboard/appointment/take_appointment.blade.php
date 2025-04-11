@php use Carbon\Carbon; @endphp
@extends('layouts.dashboard_layout')

@section('dashboard')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-0 rounded fs-5">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Créneaux de rendez-vous</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between mt-5">
                <div>
                    <h6 class="mb-4 fs-2">Liste des créneaux disponibles</h6>
                </div>
            </div>

            <!-- Affichage du mois actuel avec navigation -->
            <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                @if ($previousMonth && $previousYear)
                    <a href="{{ route('appointment.show', ['month' => $previousMonth, 'year' => $previousYear]) }}"
                        class="btn btn-outline-secondary">&lt; Mois précédent</a>
                @else
                    <div></div>
                @endif

                <h4>{{ $currentMonth->translatedFormat('F Y') }}</h4>

                <a href="{{ route('appointment.show', ['month' => $nextMonth, 'year' => $nextYear]) }}"
                    class="btn btn-outline-secondary">Mois suivant &gt;</a>
            </div>

            <!-- Calendrier des jours du mois actuel -->
            <div class="row row-cols-7 g-3">
                @foreach ($daysOfMonth as $calendarDay)
                    <div class="col text-center">
                        <a href="{{ route('appointment.show', ['month' => $currentMonth->month, 'year' => $currentMonth->year, 'day' => $calendarDay]) }}"
                            class="btn btn-light w-100 @if ($calendarDay == $day) active @endif">
                            {{ $calendarDay }}
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Affichage des rendez-vous disponibles pour le jour sélectionné ou actuel -->
            @if ($day)
                <div class="mt-5">
                    <h5>Rendez-vous pour le {{ $day }}/{{ $currentMonth->month }}/{{ $currentMonth->year }}</h5>

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
                                                <span class="badge bg-success">Libre</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-success">
                                                    <i class="bi bi-check-circle"></i> Réserver
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
