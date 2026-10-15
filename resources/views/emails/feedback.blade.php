<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Feedback</title>
</head>
<body style="margin:0;padding:0;background:#F6F7FB;font-family:Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#F6F7FB;padding:40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.06);">

                    {{-- Header --}}
                    <tr>
                        <td style="background:linear-gradient(135deg,#BF0001,#8C0001);padding:28px 32px;color:#fff;">
                            <h1 style="margin:0;font-size:22px;font-weight:700;">New Feedback Received</h1>
                            <p style="margin:6px 0 0;font-size:13.5px;opacity:0.9;">Submitted from the EGTS website</p>
                        </td>
                    </tr>

                    {{-- Optional sender section (only if name or email was given) --}}
                    @if (!empty($data['name']) || !empty($data['email']))
                        <tr>
                            <td style="padding:28px 32px 4px;">
                                <div style="font-size:13px;color:#667085;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:10px;">
                                    From
                                </div>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    @if (!empty($data['name']))
                                        <tr>
                                            <td style="padding:6px 0;font-size:12px;color:#9AA1B2;font-weight:600;width:120px;">NAME</td>
                                            <td style="padding:6px 0;font-size:14px;color:#171B2C;">{{ $data['name'] }}</td>
                                        </tr>
                                    @endif
                                    @if (!empty($data['email']))
                                        <tr>
                                            <td style="padding:6px 0;font-size:12px;color:#9AA1B2;font-weight:600;width:120px;">EMAIL</td>
                                            <td style="padding:6px 0;font-size:14px;color:#171B2C;">
                                                <a href="mailto:{{ $data['email'] }}" style="color:#BF0001;text-decoration:none;">{{ $data['email'] }}</a>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td style="padding:24px 32px 0;">
                                <div style="display:inline-block;padding:6px 12px;background:#F6F7FB;border-radius:999px;font-size:11.5px;color:#667085;font-weight:600;letter-spacing:0.04em;">
                                    SUBMITTED ANONYMOUSLY
                                </div>
                            </td>
                        </tr>
                    @endif

                    {{-- Message --}}
                    <tr>
                        <td style="padding:24px 32px 10px;">
                            <div style="font-size:13px;color:#667085;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:10px;">
                                Message
                            </div>
                            <div style="padding:18px 20px;background:#F6F7FB;border-left:4px solid #BF0001;border-radius:8px;font-size:15px;color:#171B2C;line-height:1.65;white-space:pre-wrap;">{{ $data['message'] }}</div>
                        </td>
                    </tr>

                    {{-- Meta --}}
                    <tr>
                        <td style="padding:0 32px 24px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-top:1px solid #EDEEF3;">
                                <tr>
                                    <td style="padding:14px 0 6px;font-size:12px;color:#9AA1B2;font-weight:600;">SUBMITTED AT</td>
                                    <td style="padding:14px 0 6px;font-size:13px;color:#171B2C;text-align:right;">{{ $data['sent_at'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 0;font-size:12px;color:#9AA1B2;font-weight:600;">IP ADDRESS</td>
                                    <td style="padding:6px 0;font-size:13px;color:#171B2C;text-align:right;font-family:monospace;">{{ $data['ip'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 0 0;font-size:12px;color:#9AA1B2;font-weight:600;vertical-align:top;">BROWSER</td>
                                    <td style="padding:6px 0 0;font-size:12px;color:#667085;text-align:right;word-break:break-word;">{{ $data['user_agent'] }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:18px 32px;background:#FAFBFD;border-top:1px solid #EDEEF3;font-size:12px;color:#9AA1B2;text-align:center;">
                            Sent from <strong style="color:#002F5F;">EGTS Website</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>