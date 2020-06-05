<table>
    <tbody>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Title</th>
            <th>Description</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Neighborhood</th>
           
        </tr>
        @foreach ($ads as $ad)
            <tr>
                <td>{{$ad->id}}</td>
                <td>{{$ad->user->name}}</td>
                <td>{{$ad->title}}</td>
                <td>{{$ad->description}}</td>
                <td>{{$ad->country ? $ad->country->name : ''}}</td>
                <td>{{$ad->state ? $ad->state->name : ''}}</td>
                <td>{{$ad->city ? $ad->city->name : ''}}</td>
                <td>{{$ad->neighborhood ? $ad->neighborhood->name : ''}}</td>
            </tr>
        @endforeach

    </tbody>
</table>