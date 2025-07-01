@extends('layouts.dashboard_layout')

@section('dashboard')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light pt-3 rounded fs-5">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Paramètres</li>
                </ol>
            </nav>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif


            <div class="d-flex justify-content-between mt-5">
                <h6 class="mb-4 fs-2">Paramètres du compte</h6>
            </div>

            <div class="row">
                <!-- Section Détails personnels -->
                <div class="col-md-8">
                    <div class="bg-white rounded shadow-sm p-4 mb-4">
                        <h5 class="mb-4 text-muted">Détails personnels</h5>
                        
                        <form method="POST" action="{{ route('user.settings.update', auth()->user()->id) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <!-- Nom -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nom</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', auth()->user()->name ) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Prénom -->
                                <div class="col-md-6 mb-3">
                                    <label for="lastname" class="form-label">Prénom</label>
                                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" 
                                           id="lastname" name="lastname" value="{{ old('lastname', auth()->user()->lastname) }}" required>
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', auth()->user()->email ) }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Téléphone -->
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Adresse -->
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label">Adresse</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                           id="address" name="address" value="{{ old('address', auth()->user()->address) }}">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Sexe -->
                                <div class="col-md-6 mb-3">
                                    <label for="sex" class="form-label">Sexe</label>
                                    <select class="form-select @error('sex') is-invalid @enderror" id="sex" name="sex">
                                        <option value="">Sélectionner votre sexe</option>
                                        <option value="male" {{ old('sex', auth()->user()->sex ?? '') == 'male' ? 'selected' : '' }}>Homme</option>
                                        <option value="female" {{ old('sex', auth()->user()->sex ?? '') == 'female' ? 'selected' : '' }}>Femme</option>
                                    </select>
                                    @error('sex')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Date de naissance -->
                                <div class="col-md-12 mb-3">
                                    <label for="birthday" class="form-label">Date de naissance</label>
                                    <input type="date" class="form-control @error('birthday') is-invalid @enderror" 
                                           id="birthday" name="birthday" value="{{ old('birthday', auth()->user()->birth_date ?? '') }}" 
                                           placeholder="jj/mm/aaaa">
                                    @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4 d-flex justify-content-start">
                                <button type="submit" class="btn btn-success me-3">Mettre à jour</button>
                                <button type="button" class="btn btn-outline-secondary">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Section Réinitialiser le mot de passe -->
                <div class="col-md-4">
                    <div class="bg-white rounded shadow-sm p-4">
                        <h5 class="mb-4 text-muted">Réinitialiser le mot de passe</h5>
                        
                        <form method="POST" action="{{ route('user.password.update') }}">
                            @csrf
                            @method('PUT')
                            
                            <!-- Mot de passe actuel -->
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Mot de passe actuel</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                       id="current_password" name="current_password" placeholder="Entrer votre mot de passe actuel" required>
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Nouveau mot de passe -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Nouveau mot de passe</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Entrer votre nouveau mot de passe" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Confirmer le nouveau mot de passe -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation" 
                                       placeholder="Confirmer votre nouveau mot de passe" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Mettre à jour le mot de passe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection