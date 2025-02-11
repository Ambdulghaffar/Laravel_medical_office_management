@extends('layouts.nav_menu')
@section('navbar')
    <!--================Header Menu Area =================-->
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Inscription</h2>
                        <p>Créez un compte pour accéder à tous les services de notre cabinet médical.</p>
                    </div>
                    <div class="page_link">
                        <a href="{{ route('/') }}">Accueil</a>
                        <a href="{{ route('register') }}">Inscription</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!-- ================ Inscription Section Start ================= -->
    <section class="contact-section area-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Créez votre compte</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="{{ route('register.store') }}" method="POST" id="registerForm">
                        @csrf
                        <div class="row">
                            <!-- Champ Nom -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control @error('name') is-invalid @enderror" name="name" id="name" type="text" placeholder="Nom" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <!-- Champ Prénom -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control @error('lastname') is-invalid @enderror" name="lastname" id="lastname" type="text" placeholder="Prénom" required autocomplete="lastname" autofocus>
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <!-- Champ Téléphone -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" type="tel" placeholder="Téléphone" required autocomplete="phone" autofocus>
                                </div>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <!-- Champ Email -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control @error('email') is-invalid @enderror" name="email" id="email" type="email" placeholder="Adresse e-mail" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <!-- Champ Mot de passe -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control @error('password') is-invalid @enderror" name="password" id="password" type="password" placeholder="Mot de passe" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <!-- Champ Confirmation du mot de passe -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirmez le mot de passe" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm">S'inscrire</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-user"></i></span>
                        <div class="media-body">
                            <h3>Déjà inscrit ?</h3>
                            <p><a href="{{ route('login') }}">Connectez-vous ici</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ Inscription Section End ================= -->
@endsection