@extends('layouts.nav_menu')
@section('navbar')
    <!--================Header Menu Area =================-->
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Connexion</h2>
                        <p>Connectez-vous pour accéder à votre espace personnel.</p>
                    </div>
                    <div class="page_link">
                        <a href="{{ route('/') }}">Accueil</a>
                        <a href="{{ route('login') }}">Connexion</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!-- ================ Connexion Section Start ================= -->
    <section class="contact-section area-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Connectez-vous</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="{{ route('login') }}" method="POST" id="loginForm">
                        @csrf
                        <div class="row">
                            <!-- Champ Combobox pour le type d'utilisateur -->
                            <div class="col-12">
                                <div class="form-group">
                                    <select class="form-control" name="role" id="role" required>
                                        <option value="" disabled selected>Sélectionnez votre rôle</option>
                                        <option value="patient">Patient</option>
                                        <option value="secretaire">Secrétaire</option>
                                        <option value="docteur">Docteur</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Champ Email -->
                            <div class="col-12">
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
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="password" id="password" type="password" placeholder="Mot de passe" required autocomplete="current-password" autofocus>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm">Se connecter</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-user"></i></span>
                        <div class="media-body">
                            <h3>Pas encore inscrit ?</h3>
                            <p><a href="{{ route('register') }}">Inscrivez-vous ici</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ Connexion Section End ================= -->
@endsection