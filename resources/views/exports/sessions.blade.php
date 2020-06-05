<table>
    <tbody>
        <tr>
            <th>ID</th>
            <th>Teacher</th>
            <th>Student</th>
            <th>Level</th>
            <th>Subject</th>
            <th>Rate</th>
            <th>Hours</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
        @foreach ($sessions as $session)
            <tr>
                <td>{{$session->id}}</td>
                <td>{{$session->teacher->user->name}}</td>
                <td>{{$session->student->user->name}}</td>
                <td>{{$session->level}}</td>
                <td>{{$session->subject}}</td>
                <td>{{$session->rate}}</td>
                <td>{{$session->hours}}</td>
                <td>${{$session->total}}</td>
                <td>{{$session->complete ?  "Complete" : "Incomplete"}}</td>
            </tr>
        @endforeach

    </tbody>
</table>