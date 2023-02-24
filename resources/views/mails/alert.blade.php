<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Error Alert</title>
</head>

<body bgcolor="#FFFFFF" style="background-color:#FFFFFF;">
    <table cellpadding="0" cellspacing="0" bgcolor="#ffffff" role="presentation" style="background-color:#ffffff;border-collapse:collapse;width:100%;max-width:1000px;min-width:350px;">
        <div>
            <table cellpadding="10" cellspacing="10" bgcolor="#ffffff" role="presentation" style="background-color:#ffffff;border-collapse:collapse;">
                <tbody>
                    <tr style="background:#f8f9fa;">
                        <td style="border-collapse:collapse;text-align:center;" align="center">
                            <a href="http://127.0.0.1:8000/developer-alert/dashboard" target="_blank">
                                <img src="https://www.webit.be/wp-content/themes/webit/images/logo.gif" alt="Webit logo gif" width="200">
                            </a>
                            <h1 style="font-size:24px;color:#262626;">
                                Your developer alert just got triggered from: 
                                <br>
                                <span style="font-weight:bold;"> {{ env('APP_URL') }}</span>
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-collapse:collapse;text-align:left;" align="center">
                            <p style="font-size:16px;color:#262626;">
                                With message:
                                <br>
                                <span style="color:#262626;font-weight:bold">{{ $alert->error_message }}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <hr style="color:#f8f9fa;opacity:0.5;">
                        </td>
                    </tr>
                    <tr>
                        <td style="border-collapse:collapse;text-align:left;" align="center">
                            <p style="font-size:16px;color:#262626;">
                                Coming from:
                                <br>
                                <span style="color:#262626;font-weight:bold">{{ $alert->where_from }}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <hr style="color:#f8f9fa;opacity:0.5;">
                        </td>
                    </tr>
                    <tr>
                        <td style="border-collapse:collapse;text-align:left;" align="center">
                            <p style="font-size:16px;color:#262626;">
                                Function:
                                <br>
                                <span style="color:#262626;font-weight:bold">{{ $alert->function }}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <hr style="color:#f8f9fa;opacity:0.5;">
                        </td>
                    </tr>
                    <tr>
                        <td style="border-collapse:collapse;text-align:left;" align="center">
                            <p style="font-size:16px;color:#262626;">
                                Settings:
                            </p>
                            <a href="{{ $snooze_url }}" target="_blank" style="background-color:#2ebff3;color:#FFFFFF;padding:6px 12px;border-radius:5px;text-decoration:none;">Go to the settings page</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-collapse:collapse;text-align:left;" align="center">
                            <p style="font-size:16px;color:#262626;">
                                Check the alert:
                            </p>
                            <a href="{{ route('alert.settings', $alert->id) }}" target="_blank" style="background-color:#2ebff3;color:#FFFFFF;padding:6px 12px;border-radius:5px;text-decoration:none;">Click here for the Stack trace</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <br>
                        </td>
                    </tr>
                </tbody>
                <tfoot style="background:#ADE2FA;color:#262626;text-align:center;" align="center">
                    <tr>
                        <td style="border-collapse:collapse;text-align:center;">
                            <table role="presentation" style="border-collapse:collapse;width:100%;" align="center">
                                <tbody align="center" style="width:100%;">
                                    <tr style="width:100%;">
                                        <td align="center" style="text-align: center;width:100%;">
                                            <p style="font-size:14px;width:100%;text-align:center;">
                                                <em>Get it fixed! </em>😉
                                            </p>
                                        </td>
                                    </tr>
                                    <tr style="width:100%;">
                                        <td style="border-collapse:collapse;text-align:center;width:100%;" align="center">
                                            <a href="http://127.0.0.1:8000/developer-alert/dashboard" target="_blank" style="color:#262626;text-decoration:none;font-size:16px;width:100%;text-align:center;">
                                                Webit Developer Alert Dashboard
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </table>
</body>

</html>
