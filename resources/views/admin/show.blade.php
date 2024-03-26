@extends('admin.base')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <!--Start Dashboard Content-->
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header"><i class="fa fa-user"></i> Détails de l'utilisateur</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <tbody>
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $user->id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nom</th>
                                        <td>{{ $user->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Prénom</th>
                                        <td>{{ $user->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Téléphone</th>
                                        <td>{{ $user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">CNI</th>
                                        <td>{{ $user->cni }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Profil</th>
                                        <td>{{ $user->profile_type }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Horaires</th>
                                        <td>{{ $user->schedule }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Montant</th>
                                        <td>{{ $user->amount }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Créé le</th>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mis à jour le</th>
                                        <td>{{ $user->updated_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header"><i class="fa fa-qrcode"></i> Code QR</div>
                    <div class="card-body">
                        {!! $qrCode !!}
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.salaire.pdf', $user->id) }}">Télécharger le Bulletin de Salaire</a>

        <!--End Dashboard Content-->
        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->
    </div>
    <!-- End container-fluid-->
</div><!--End content-wrapper-->

@endsection