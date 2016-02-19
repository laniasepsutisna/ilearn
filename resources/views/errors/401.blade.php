<!DOCTYPE html>
<html>
    <head>
        <title>Anda bukan staff.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
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
                <div class="title">401.</div>
                <p>Anda tidak memiliki hak akses untuk mengakses halaman ini. <a href="{{ url('/') }}"><strong>Kembali ke halaman depan.</strong></a></p>
            </div>
        </div>
    </body>
</html>
