<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Rapport B2B Created</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.5; color: #1f2937; background: #f9fafb; margin: 0; padding: 24px;">
    <div style="max-width: 680px; margin: 0 auto; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 10px; padding: 24px;">
        <h1 style="margin: 0 0 16px; font-size: 24px; color: #111827;">New Rapport B2B Created</h1>

        <p style="margin: 0 0 16px;">
            A new Rapport B2B record has been created in the CRM.
        </p>

        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; margin-bottom: 20px;">
            <tr>
                <td style="padding: 8px 0; font-weight: bold; width: 180px;">ID</td>
                <td style="padding: 8px 0;">{{ $rapportB2B->id }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Visit ID</td>
                <td style="padding: 8px 0;">{{ $rapportB2B->idvisite }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Correspondant ID</td>
                <td style="padding: 8px 0;">{{ $rapportB2B->idcorrespondant ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold;">Next Visit</td>
                <td style="padding: 8px 0;">{{ optional($rapportB2B->prochaine_visite)->format('Y-m-d') ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold; vertical-align: top;">Description</td>
                <td style="padding: 8px 0;">{{ $rapportB2B->description ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold; vertical-align: top;">Action To Do</td>
                <td style="padding: 8px 0;">{{ $rapportB2B->action_a_faire ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: bold; vertical-align: top;">Attachment</td>
                <td style="padding: 8px 0;">
                    @if ($rapportB2B->sary)
                        <a href="{{ $rapportB2B->sary }}" target="_blank" rel="noopener noreferrer">View attached file</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
        </table>

        <p style="margin: 0; color: #6b7280; font-size: 14px;">
            This notification was generated automatically by the CRM.
        </p>
    </div>
</body>
</html>
