<!DOCTYPE html>
<html>
    <head>
        <title>HTTP method tidak diijinkan.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #205081;
                display: table;
                font-weight: 300;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
                color: #205081;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            
            a {
                text-decoration: none;
                color: #205081;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">405.</div>
                <div>
                    <h1>Metode HTTP tidak diijinkan!</h1>
                    <a href="{{ url('/') }}"><strong>Saya ingin kembali kerumah.</strong></a>
                </div>
            </div>
        </div>
    </body>
</html>
