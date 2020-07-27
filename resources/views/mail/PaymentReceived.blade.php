
<html lang="en">
<head>
    <style>
        .logo{
            height: 75px;
            max-width: 95%;
            margin: 20px auto;
            text-align: center;
        }
        .logo img{
            max-width: 100%;
            max-height: 100%;
        }
        .mailbody{
            max-width: 700px;
            padding: 30px 15px;
            background: #f7f7f7;
            margin: 0 auto;
        }
        h2{
            text-align: center;
            font-size: 30px;
            color: #000;

        }
        table{
            width: 100%;

        }
        tr{
            border-bottom: 1px solid rgba(0,0,0,0.4);
        }
        td{
            padding: 3px 10px;
        }
        .replyopt{
            text-align: center;
            margin: 20px 0
        }
        .btn{
            border: none;
            background: #53a221;
            color: #fff;
            border-radius: 23px;
            text-align: center;
            padding: 7px 30px;
            font-size: 20px;
            text-decoration: none;
            box-shadow: 0 2px 5px 0 #0000006b;

        }

    </style>
</head>
<body>

<div class="mailbody">
    <div class="logo"><img src="https://tutors-hub.com/img/logotext.png" alt=""></div>
    <h2>Payment has been Received From {{$user->name}}</h2>
    <table>
        <tr>
            <td>Session ID</td>
            <td>{{$session->id}}</td>
        </tr>
        <tr>
            <td>By</td>
            <td><a target="_blank" href="{{route("userProfile", $user->id)}}">{{$user->name}}</a> ({{$user->type == "teacher" ? "Tutor" : "Student"}})</td>
        </tr>
        <tr>
            <td>Hours</td>
            <td>{{$session->hours}}</td>
        </tr>
        <tr>
            <td>Hourly Rate</td>
            <td>${{$session->rate}}</td>
        </tr>
        <tr>
            <td>Total Charged</td>
            <td>${{$session->total}}</td>
        </tr>
        <tr>
            <td>Fee</td>
            <td>${{$session->fee}}</td>
        </tr>

    </table>


</div>

</body>
</html>
