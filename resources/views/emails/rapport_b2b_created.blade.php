<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Rapport B2B </title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .header { background-color: #1f7bc7ff; color: white; padding: 10px; text-align: center; font-size: 18px; font-weight: bold; }
        .content { padding: 20px; }
        .content p { font-size: 14px; line-height: 1.6; }
        .footer { margin-top: 20px; font-size: 12px; color: #777; text-align: center; }
        .box { background-color: #f9f9f9; border: 1px solid #ddd; padding: 15px; border-radius: 6px; }
    </style>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.5; color: #1f2937; background: #f9fafb; margin: 0; padding: 24px;">
    <div style="max-width: 680px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 10px; padding: 24px;">
        <div class="header">
            <h1>Nouveau Rapport B2B </h1>
        </div>
        <div class='content'>
            <p style="margin: 0 0 16px;">
                Un nouveau rapport B2B a été créé dans le CRM. Voici les détails du rapport :
            </p>

            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; margin-bottom: 20px;">
                <tr>
                    <td style="padding: 8px 0; font-weight: bold; width: 180px;">ID</td>
                    <td style="padding: 8px 0;">{{ $rapportB2B->id }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Date du rapport</td>
                    <td style="padding: 8px 0;">{{ optional($rapportB2B->created_at)->format('d/m/Y H:i') ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Visit ID</td>
                    <td style="padding: 8px 0;">{{ $rapportB2B->idvisite }}</td>
                </tr>
                <!-- <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Date de la visite</td>
                    <td style="padding: 8px 0;">{{ optional($rapportB2B->visite?->date)->format('d/m/Y') ?? '-' }}</td>
                </tr> -->
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Commercial</td>
                    <td style="padding: 8px 0;">
                        @php
                            $commercial = $rapportB2B->visite?->utilisateur;
                            $commercialName = trim(($commercial->firstname ?? '') . ' ' . ($commercial->name ?? ''));
                        @endphp
                        {{ $commercialName !== '' ? $commercialName : '-' }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Commercial Email</td>
                    <td style="padding: 8px 0;">{{ $rapportB2B->visite?->utilisateur?->email ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Commercial Matricule</td>
                    <td style="padding: 8px 0;">{{ $rapportB2B->visite?->utilisateur?->matricule ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Client ID</td>
                    <td style="padding: 8px 0;">{{ $rapportB2B->visite?->client?->id ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Client</td>
                    <td style="padding: 8px 0;">{{ $rapportB2B->visite?->client?->nom ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Correspondant ID</td>
                    <td style="padding: 8px 0;">{{ $rapportB2B->idcorrespondant ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Correspondant</td>
                    <td style="padding: 8px 0;">
                        @php
                            $correspondant = $rapportB2B->correspondant;
                        @endphp
                        {{ $correspondant?->nom ?? '-' }}
                        @if($correspondant?->contact)
                            <span style="color: #4b5563;">({{ $correspondant->contact }})</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold;">Next Visit</td>
                    <td style="padding: 8px 0;">{{ optional($rapportB2B->prochaine_visite)->format('Y-m-d') ?? '-' }}</td>
                </tr>
                <!-- <tr>
                    <td style="padding: 8px 0; font-weight: bold; vertical-align: top;">Description</td>
                    <td style="padding: 8px 0;">{{ $rapportB2B->description ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; font-weight: bold; vertical-align: top;">Action To Do</td>
                    <td style="padding: 8px 0;">{{ $rapportB2B->action_a_faire ?? '-' }}</td>
                </tr>-->
                <!-- <tr> 
                    <td style="padding: 8px 0; font-weight: bold; vertical-align: top;">Attachment</td>
                    <td style="padding: 8px 0;">
                        @if ($rapportB2B->sary)
                            <a href="{{ $rapportB2B->sary }}" target="_blank" rel="noopener noreferrer">View attached file</a>
                        @else
                            -
                        @endif
                    </td>
                </tr> -->
            </table>
        </div>
        <div class='footer'>
            <p>
                Ceci est un email automatique, merci de ne pas y répondre.
            </p>
        </div>
    </div>
</body>
</html>
