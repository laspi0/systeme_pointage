<!-- resources/views/admin/register.blade.php -->

@extends('admin.app')
@section('content')
<div class="card card-authentication1 mx-auto my-4">
    <div class="card-body">
        <div class="card-content p-2">
            <div class="text-center">
                <img src="/assets/images/logo-icon.png" alt="logo icon">
            </div>
            <div class="card-title text-uppercase text-center py-3">Inscription Prof</div>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputName" class="sr-only">Prénom</label>
                    <div class="position-relative has-icon-right">
                        <input type="text" id="exampleInputName" class="form-control input-shadow" name="first_name" placeholder="Entrez votre prenom">
                        <div class="form-control-position">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputName" class="sr-only">Nom</label>
                    <div class="position-relative has-icon-right">
                        <input type="text" id="exampleInputName" class="form-control input-shadow" name="last_name" placeholder="Entrez votre nom">
                        <div class="form-control-position">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputName" class="sr-only">Téléphone</label>
                    <div class="position-relative has-icon-right">
                        <input type="text" id="exampleInputName" class="form-control input-shadow" name="phone" placeholder="Entrez votre numero">
                        <div class="form-control-position">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputName" class="sr-only">CNI</label>
                    <div class="position-relative has-icon-right">
                        <input type="text" id="exampleInputName" class="form-control input-shadow" name="cni" placeholder="Entrez votre numero CNI">
                        <div class="form-control-position">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmailId" class="sr-only">Adresse e-mail</label>
                    <div class="position-relative has-icon-right">
                        <input type="email" id="exampleInputEmailId" class="form-control input-shadow" name="email" placeholder="Entrez votre adresse e-mail">
                        <div class="form-control-position">
                            <i class="icon-envelope-open"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword" class="sr-only">Mot de passe</label>
                    <div class="position-relative has-icon-right">
                        <input type="password" id="exampleInputPassword" class="form-control input-shadow" name="password" placeholder="Choisissez un mot de passe">
                        <div class="form-control-position">
                            <i class="icon-lock"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-light btn-block waves-effect waves-light">S'inscrire</button>
            </form>

        </div>
    </div>
    <div class="card-footer text-center py-3">
        <p class="text-warning mb-0">Vous avez déjà un compte ? <a href="{{ route('login') }}"> Connectez-vous ici</a></p>
    </div>

</div>

<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->

<!--start color switcher-->
<div class="right-sidebar">
    <div class="switcher-icon">
        <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

        <p class="mb-0">Gaussion Texture</p>
        <hr>

        <ul class="switcher">
            <li id="theme1"></li>
            <li id="theme2"></li>
            <li id="theme3"></li>
            <li id="theme4"></li>
            <li id="theme5"></li>
            <li id="theme6"></li>
        </ul>

        <p class="mb-0">Gradient Background</p>
        <hr>

        <ul class="switcher">
            <li id="theme7"></li>
            <li id="theme8"></li>
            <li id="theme9"></li>
            <li id="theme10"></li>
            <li id="theme11"></li>
            <li id="theme12"></li>
            <li id="theme13"></li>
            <li id="theme14"></li>
            <li id="theme15"></li>
        </ul>

    </div>
</div>
<!--end color switcher-->
@endsection