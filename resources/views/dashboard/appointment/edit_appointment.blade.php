@extends('layouts.dashboard_layout')

@section('dashboard')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light pt-3 rounded fs-5">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('appointment') }}">Rendez-vous</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier un rendez-vous</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between mt-5">
                <h6 class="mb-4 fs-2">Modification du rendez-vous</h6>
            </div>

            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <form method="POST" action="{{ route('appointment.update', $appointment->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_appointment" class="form-label">Date du rendez-vous</label>
                                <input type="date" class="form-control" id="date_appointment" name="date_appointment"
                                    value="{{ $appointment->date_appointment->format('Y-m-d') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="start_time" class="form-label">Heure de début</label>
                                <input type="time" class="form-control" id="start_time" name="start_time"
                                    value="{{ $appointment->start_time }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="end_time" class="form-label">Heure de fin</label>
                                <input type="time" class="form-control" id="end_time" name="end_time"
                                    value="{{ $appointment->end_time }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="availability" class="form-label">Disponibilité</label>
                                <select class="form-select" id="availability" name="availability" required>
                                    <option value="free" {{ $appointment->availability === 'free' ? 'selected' : '' }}>Libre</option>
                                    <option value="reserved" {{ $appointment->availability === 'reserved' ? 'selected' : '' }}>Réservé</option>
                                    <option value="reserved" {{ $appointment->availability === 'unavailable' ? 'selected' : '' }}>Indisponible</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-3">Modifier</button>
                            <button type="reset" class="btn btn-secondary">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
