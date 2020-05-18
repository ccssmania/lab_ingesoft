@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-6">
            <h1 class="display-3 text-primary">HushSignes</h1>
            <p class ="lead text-secondary">HushSignes es una plataforma online que te permitirá aprender 
                los fundamentos de la lengua de señas colombiana  (LSC) de forma gratuita y entretenida.
            </p>
            @unless (Auth::check())
            <a class="btn btn-lg btn-block btn-primary" href=" {{ route('login') }}">Ingresar</a>
        @endunless
        </div>
        <div class="col-12 col-lg-6">
            <img class="img-fluid mb-4" src="/images/undraw_online_test_gba7.svg">
        </div>
    </div>
</div>
@endsection
