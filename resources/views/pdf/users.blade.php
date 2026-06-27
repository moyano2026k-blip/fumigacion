<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Reporte Climático</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #15803d;
            margin-bottom: 5px;
        }

        h3 {
            text-align: center;
            color: #666;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #16a34a;
            color: white;
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 11px;
        }

        td {
            border: 1px solid #ddd;
            padding: 7px;
            font-size: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f8fafc;
        }

        .danger {
            color: #dc2626;
            font-weight: bold;
        }

        .warning {
            color: #ca8a04;
            font-weight: bold;
        }

        .success {
            color: #16a34a;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            color: #777;
        }
    </style>

</head>

<body>

    <h1>AgroClimate</h1>

    <h3>Reporte del Historial Climático</h3>

    <div class="info">

        <p><strong>Total de consultas:</strong> {{ $histories->count() }}</p>

        <p><strong>Fecha de generación:</strong> {{ now()->format('d/m/Y H:i') }}</p>

    </div>

    <table>

        <thead>

            <tr>

                <th>#</th>

                <th>Usuario</th>

                <th>Ciudad</th>

                <th>Temp (°C)</th>

                <th>Humedad (%)</th>

                <th>Viento</th>

                <th>Estado</th>

                <th>Nivel</th>

                <th>Recomendación</th>

                <th>Fecha</th>

            </tr>

        </thead>

        <tbody>

            @forelse($histories as $history)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $history->user->name ?? 'N/A' }}</td>

                    <td>{{ $history->city }}</td>

                    <td>{{ $history->temperature }}</td>

                    <td>{{ $history->humidity }}</td>

                    <td>{{ $history->wind }} m/s</td>

                    <td>{{ $history->description }}</td>

                    <td>

                        @if($history->level == 'PELIGROSO')

                            <span class="danger">
                                {{ $history->level }}
                            </span>

                        @elseif($history->level == 'MODERADO')

                            <span class="warning">
                                {{ $history->level }}
                            </span>

                        @else

                            <span class="success">
                                {{ $history->level }}
                            </span>

                        @endif

                    </td>

                    <td>{{ $history->recommendation }}</td>

                    <td>{{ $history->created_at->format('d/m/Y H:i') }}</td>

                </tr>

            @empty

                <tr>

                    <td colspan="10">

                        No existen registros.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="footer">

        AgroClimate © {{ date('Y') }}

    </div>

</body>

</html>