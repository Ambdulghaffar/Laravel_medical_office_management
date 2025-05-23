@extends('layouts.dashboard_layout')

@section('dashboard')
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light pt-3 rounded fs-5">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Paramètres</li>
                </ol>
            </nav>
        </div>
    </div>
        @endsection
