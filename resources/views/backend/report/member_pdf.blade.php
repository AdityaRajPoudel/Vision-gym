<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Attendance Report</title>
    <style>
        /* Define your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .report-heading {
            text-align: center;
            margin-bottom: 20px;
        }
        .member-name {
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="report-heading">
        <h2>Attendance Report</h2>
    </div>
    <div class="member-name">
        <p>{{ $member->user->name }} - {{ \Carbon\Carbon::createFromDate($year, $monthId)->format('F Y') }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check-In Time</th>
                <th>Check-Out Time</th>
            </tr>
        </thead>
        <tbody>
            @for ($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $attendanceOfDay = $attendance->where('attendance_date', $year.'-'.str_pad($monthId, 2, '0', STR_PAD_LEFT).'-'.str_pad($day, 2, '0', STR_PAD_LEFT))->first();
                @endphp
                <tr>
                    <td>{{ $year }}-{{ str_pad($monthId, 2, '0', STR_PAD_LEFT) }}-{{ str_pad($day, 2, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $attendanceOfDay ? \Carbon\Carbon::createFromTimeString($attendanceOfDay->check_in_time)->format('h:i:s A') : 'N/A' }}</td>
                    <td>{{ $attendanceOfDay ? \Carbon\Carbon::createFromTimeString($attendanceOfDay->check_out_time)->format('h:i:s A') : 'N/A' }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
</body>
</html>
