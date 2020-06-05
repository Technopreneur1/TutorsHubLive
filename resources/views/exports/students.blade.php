<table>
    <tbody>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gander</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Neighborhood</th>
            <th>Account Status</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->gender}}</td>
                <td>{{$user->country ? $user->country->name : ''}}</td>
                <td>{{$user->state ? $user->state->name : ''}}</td>
                <td>{{$user->city ? $user->city->name : ''}}</td>
                <td>{{$user->neighborhood ? $user->neighborhood->name : ''}}</td>
                <td>{{$user->is_banned ? "Active" : "Banned"}}</td>
            </tr>
        @endforeach

    </tbody>
</table>