<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passwort zurücksetzen — Praxis Website Score</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f9fafb; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 40px auto;">
        <tr>
            <td style="background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 40px;">
                <h1 style="color: #111827; font-size: 22px; margin: 0 0 20px 0;">Passwort zurücksetzen</h1>

                <p style="color: #4b5563; font-size: 15px; line-height: 1.6; margin: 0 0 20px 0;">
                    Sie haben angefordert, Ihr Passwort bei Praxis Website Score zurückzusetzen. Klicken Sie auf den folgenden Button, um ein neues Passwort festzulegen.
                </p>

                <table role="presentation" cellspacing="0" cellpadding="0" style="margin: 24px 0;">
                    <tr>
                        <td style="background-color: #4f46e5; border-radius: 6px;">
                            <a href="{{ $url }}"
                               style="display: inline-block; padding: 12px 28px; color: #ffffff; text-decoration: none; font-size: 15px; font-weight: 500;">
                                Passwort zurücksetzen
                            </a>
                        </td>
                    </tr>
                </table>

                <p style="color: #6b7280; font-size: 13px; line-height: 1.5; margin: 0 0 12px 0;">
                    Dieser Link ist 60 Minuten gültig. Wenn Sie keine Zurücksetzung Ihres Passworts angefordert haben, ist keine weitere Aktion erforderlich.
                </p>

                <p style="color: #9ca3af; font-size: 12px; line-height: 1.5; margin: 0 0 12px 0;">
                    Falls der Button nicht funktioniert, kopieren Sie diese URL in Ihren Browser:<br>
                    <span style="word-break: break-all; color: #4f46e5;">{{ $url }}</span>
                </p>

                <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 24px 0;">

                <p style="color: #9ca3af; font-size: 12px; margin: 0;">
                    Praxis Website Score &mdash; Ein Projekt von CreativeCodingSolutions
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
