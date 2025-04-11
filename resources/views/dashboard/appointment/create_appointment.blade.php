@extends('layouts.dashboard_layout')

@section('dashboard')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light pt-3 rounded fs-5">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('appointment') }}">Rendez-vous</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Créer un créneau</li>
                </ol>
            </nav>

            <div class="d-flex justify-content-between mt-5">
                <h6 class="mb-4 fs-2">Création d’un créneau de rendez-vous</h6>
            </div>

            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <form method="POST" action="{{ route('appointment.store') }}">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <!-- Date du rendez-vous -->
                            <div class="col-md-6 mb-3">
                                <label for="date_appointment" class="form-label">Date du rendez-vous</label>
                                <input type="date" class="form-control @error('date_appointment') is-invalid @enderror" id="date_appointment" name="date_appointment" required>
                                @error('date_appointment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Heure de début -->
                            <div class="col-md-6 mb-3">
                                <label for="start_time" class="form-label">Heure de début</label>
                                <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" required>
                                @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Heure de fin -->
                            <div class="col-md-6 mb-3">
                                <label for="end_time" class="form-label">Heure de fin</label>
                                <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" required>
                                @error('end_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-3">Créer</button>
                            <button type="reset" class="btn btn-secondary">Réinitialiser</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
