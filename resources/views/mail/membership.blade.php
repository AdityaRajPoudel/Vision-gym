<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
    <div>
        <p><b>Hello {{ $userData['username'] }},</b></p>
        <p>Thank you for choosing our service! Below are the details of your membership:</p>
        
        <table cellpadding="5" cellspacing="0">
            <tr>
                <td><b>Member Code:</b></td>
                <td>{{ $userData['member_code'] }}</td>
            </tr>
            <tr>
                <td><b>Plan:</b></td>
                <td>{{ $userData['plan'] }} Months</td>
            </tr>
            <tr>
                <td><b>Service:</b></td>
                <td>{{ $userData['service'] }}</td>
            </tr>
            <tr>
                <td><b>Issue Date:</b></td>
                <td>{{ $userData['issue_date'] }}</td>
            </tr>
            <tr>
                <td><b>Expire Date:</b></td>
                <td>{{ $userData['expire_date'] }}</td>
            </tr>
            @if ($userData['discount'])
            <tr>
                <td><b>Discount:</b></td>
                <td>{{ $userData['discount'] }}</td>
            </tr>
            @endif
            <tr>
                <td><b>Total:</b></td>
                <td>{{ $userData['total'] }}</td>
            </tr>
        </table>

        <p>If you have any questions or need assistance, feel free to contact us.</p>
        
        <p><small>Note: This email is auto-generated from {{ config('app.name') }}. Please do not reply to this email.</small></p>
    </div>
</body>
</html>
