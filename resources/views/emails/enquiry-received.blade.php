<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.08);">

                    <tr>
                        <td style="background-color:#b40707; padding:24px 32px;">
                            <h1 style="margin:0; font-size:20px; color:#ffffff;">New Enquiry</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:32px;">
                            <p style="font-size:14px; color:#555555; margin:0 0 24px;">
                                You have received a new enquiry from the EGTS website contact form.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                <tr>
                                    <td style="padding:10px 0; border-bottom:1px solid #eee; font-size:13px; font-weight:bold; color:#333; width:140px;">Full Name</td>
                                    <td style="padding:10px 0; border-bottom:1px solid #eee; font-size:14px; color:#1a1a1a;">{{ $enquiry->full_name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0; border-bottom:1px solid #eee; font-size:13px; font-weight:bold; color:#333;">Email</td>
                                    <td style="padding:10px 0; border-bottom:1px solid #eee; font-size:14px; color:#1a1a1a;">
                                        <a href="mailto:{{ $enquiry->email }}" style="color:#b40707; text-decoration:none;">{{ $enquiry->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0; border-bottom:1px solid #eee; font-size:13px; font-weight:bold; color:#333;">Phone</td>
                                    <td style="padding:10px 0; border-bottom:1px solid #eee; font-size:14px; color:#1a1a1a;">{{ $enquiry->phone ?: '—' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0; border-bottom:1px solid #eee; font-size:13px; font-weight:bold; color:#333;">Subject</td>
                                    <td style="padding:10px 0; border-bottom:1px solid #eee; font-size:14px; color:#1a1a1a;">{{ $enquiry->subject ?: '—' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 0; font-size:13px; font-weight:bold; color:#333; vertical-align:top;">Message</td>
                                    <td style="padding:10px 0; font-size:14px; color:#1a1a1a; line-height:1.6; white-space:pre-wrap;">{{ $enquiry->message }}</td>
                                </tr>
                            </table>

                            <p style="font-size:12px; color:#999; margin:28px 0 0;">
                                Received on {{ $enquiry->created_at->format('M d, Y \a\t h:i A') }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color:#f7f7f7; padding:16px 32px; text-align:center;">
                            <p style="margin:0; font-size:12px; color:#999;">
                                Erbil Gate Technical Services Ltd. — Website Enquiry System
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
