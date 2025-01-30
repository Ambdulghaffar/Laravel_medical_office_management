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
                    <form class="form-contact contact_form" action="{{ route('register') }}" method="POST" id="registerForm">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text" placeholder="Nom complet" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email" placeholder="Adresse e-mail" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="password" id="password" type="password" placeholder="Mot de passe" required>
                                </div>
                            </div>
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