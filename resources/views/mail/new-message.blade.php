
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
                background: #000;
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
            <h2>{{ $sender->name }} has sent you a message</h2>
            <div class="logo"><img src="https://tutors-hub.com/img/logotext.png" alt=""></div>
            @if ($sender)
                <div class="replyopt">
                    <a href="{{ route('messages', ['u' => $sender->id]) }}" class="btn">Open Message</a>
                </div>
            @endif

        </div>

    </body>
    </html>
