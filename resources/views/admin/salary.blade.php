@extends('admin.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mettre à jour le salaire de l\'utilisateur') }}</div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="user">Sélectionner un utilisateur :</label>
                        <select class="form-control" id="user">
                            <option value="">Choisir un utilisateur</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="salary">Salaire :</label>
                        <input type="text" class="form-control" id="salary" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // JavaScript pour mettre à jour le salaire en temps réel lorsque l'utilisateur est sélectionné
    document.getElementById('user').addEventListener('change', function() {
        var userId = this.value;
        if (userId) {
            fetch('/admin/get-salary/' + userId)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('salary').value = data.salary;
                })
                .catch(error => console.error('Erreur :', error));
        } else {
            document.getElementById('salary').value = '';
        }
    });
</script>
@endpush
