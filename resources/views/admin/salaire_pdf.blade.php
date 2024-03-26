<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulletin de Salaire</title>
    <style>
        /* Ajoutez vos styles CSS ici */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            margin: 0;
        }

        .content {
            margin-bottom: 20px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
        }

        .content table th,
        .content table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Bulletin de Salaire</h1>
            <p>Date: {{ date('d/m/Y') }}</p>
        </div>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>CNI</th>
                        <th>Profil</th>
                        <th>Horaires</th>
                        <th>Montant</th>
                        <th>Salaire Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->cni }}</td>
                        <td>{{ $user->profile_type }}</td>
                        <td>{{ $user->schedule }}</td>
                        <td>{{ $user->amount }}</td>
                        <td>{{ $salaireTotal }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p>Signature: ___________________________</p>
        </div>
    </div>
</body>

</html>