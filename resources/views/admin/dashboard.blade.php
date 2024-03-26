<!-- resources/views/admin/register.blade.php -->

@extends('admin.base')
@section('content')


<div class="content-wrapper">
    <div class="container-fluid">

        <!--Start Dashboard Content-->
        <div class="card mt-3">
            <div class="card-content">
                <div class="row row-group m-0">
                    @if(isset($teacherCount))
                    <div class="col-12 col-lg-6 border-light">
                        <div class="card-body">
                            <h5 class="text-white mb-0">{{ $teacherCount }} <span class="float-right"><i class="fa fa-user"></i></span></h5>
                            <div class="progress my-3" style="height:3px;">
                                <div class="progress-bar" style="width:55%"></div>
                            </div>
                            <p class="mb-0 text-white small-font">Nombre total d'enseignants<span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                        </div>
                    </div>
                    @endif
                    @if(isset($totalHours))
                    <div class="col-12 col-lg-6  border-light">
                        <div class="card-body">
                            <h5 class="text-white mb-0">{{ $totalHours }} <span class="float-right"><i class="zmdi zmdi-notifications"></i></span></h5>
                            <div class="progress my-3" style="height:3px;">
                                <div class="progress-bar" style="width:55%"></div>
                            </div>
                            <p class="mb-0 text-white small-font">Total des heures <span class="float-right">+1.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>


        <div class="table-responsive mt-5">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>CNI</th>
                        <th>Profil</th>
                        <th>Horaires</th>
                        <th>Montant</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($teachers) && count($teachers) > 0)
                    @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->last_name }}</td>
                        <td>{{ $teacher->first_name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>{{ $teacher->cni }}</td>
                        <td>{{ $teacher->profile_type }}</td>
                        <td>{{ $teacher->schedule }}</td>
                        <td>{{ $teacher->amount }}</td>
                        <td>
                            <a href="{{ route('admin.show', $teacher->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <form action="{{ route('admin.destroy', $teacher->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')"><i class="zmdi zmdi-delete"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="9">Aucun enseignant trouvé.</td>
                    </tr>
                    @endif
                </tbody>


            </table>

        </div>

        <!--End Dashboard Content-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->

    </div>
    <!-- End container-fluid-->

</div><!--End content-wrapper-->

@endsection