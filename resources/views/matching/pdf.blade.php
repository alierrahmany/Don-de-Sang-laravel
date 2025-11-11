<!-- resources/views/matching/pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; color: #dc2626; }
        .table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table th { background-color: #f3f4f6; text-align: left; padding: 8px; border: 1px solid #d1d5db; }
        .table td { padding: 8px; border: 1px solid #d1d5db; }
        .urgent { background-color: #fef2f2; color: #dc2626; font-weight: bold; }
        .normal { background-color: #f0fdf4; color: #16a34a; }
        .badge { padding: 2px 6px; border-radius: 12px; font-size: 10px; }
        .footer { margin-top: 20px; text-align: center; font-size: 10px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Don de Sang - Rapport de Matching</div>
        <div>Généré le: {{ $date }}</div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Receveur</th>
                <th>Groupe</th>
                <th>Urgence</th>
                <th>État</th>
                <th>Poches restantes</th>
                <th>Donneurs Compatibles</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receveurs as $receveur)
            <tr>
                <td><strong>{{ $receveur->prenom }} {{ $receveur->nom }}</strong><br>{{ $receveur->ville }}</td>
                <td><strong>{{ $receveur->groupe_sanguin }}</strong></td>
                <td>
                    @if($receveur->urgence)
                        <span class="badge" style="background-color: #fef2f2; color: #dc2626;">URGENT</span>
                    @else
                        <span class="badge" style="background-color: #f0fdf4; color: #16a34a;">
                            {{ $receveur->date_urgence ? 'NORMAL' : 'STABLE' }}
                        </span>
                    @endif
                </td>
                <td><span class="badge" style="background-color: #fef3c7; color: #d97706;">EN ATTENTE</span></td>
                <td><strong>{{ $receveur->poches_restantes }}</strong></td>
                <td>
                    @foreach($receveur->donneurs_compatibles as $donneur)
                    <div style="margin: 2px 0; padding: 4px; background-color: #f0fdf4; border-radius: 4px;">
                        {{ $donneur->prenom }} {{ $donneur->nom }} ({{ $donneur->groupe_sanguin }})
                    </div>
                    @endforeach
                    @if($receveur->donneurs_compatibles->count() == 0)
                    <span style="color: #6b7280;">Aucun donneur compatible</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Don de Sang Admin System - Rapport généré automatiquement
    </div>
</body>
</html>