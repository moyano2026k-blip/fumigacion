<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <style>
        body {
            font-family: Arial;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        th {
            background: #16a34a;
            color: white;
        }
    </style>

</head>

<body>

    <h1>
        Reporte Usuarios
    </h1>

    <table>

        <thead>

            <tr>

                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>

            </tr>

        </thead>

        <tbody>

            @foreach($users as $user)

                <tr>

                    <td>{{ $user->id }}</td>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->email }}</td>

                    <td>{{ $user->role }}</td>

                </tr>

            @endforeach

        </tbody>

    </table>

</body>

</html>