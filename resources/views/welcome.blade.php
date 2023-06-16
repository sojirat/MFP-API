<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>พรรคก้าวไกล - Move Forward Party</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
        body {

            background-image: url('https://images.unsplash.com/photo-1528459801416-a9e53bbf4e17?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2048');
        }

        #container {
            font-family: 'Prompt', sans-serif;
            box-shadow: 0 10px 20px 1px grey;
            background: rgba(255, 255, 255, 0.90);
            border-radius: 5px;
            overflow: hidden;
            margin: 5em auto;
            margin-top: 150px;
            height: 310px;
            width: 775px;
        }

        .card-inline {
            background: #F9FCFF;
            border-radius: 15px;
            overflow: hidden;
            margin-top: 15px;
            width: 300px;
        }

        .text-incard {
            text-align: left;
            margin-left: 20px;
            font-size: 24px;

        }

        .text-details {
            position: relative;
            overflow: hidden;
            padding: 30px;
            height: 100%;
            float: left;
            width: 40%;

        }

        .font-blue {
            color: #0066FF;
        }

        .text-left {
            text-align: left;
            margin-left: 20px;

        }

        hr.style1 {
            border-top: 1px solid #8c8b8b;
        }

        @media (max-width: 600px) {
            #container {
                width: 90%;
                margin-top: 20px;
                height: auto;
            }

            .text-details,
            .card-inline {
                width: 100%;
                padding: 10px;
            }

            .text-incard,
            .text-left {
                font-size: 18px;
            }
        }
    </style>
</head>

<body class="antialiased">
    <div id="container">
        <div class="text-details">
            <div class="card-inline">
                <p class="text-incard font-blue">พรรคก้าวไกล <br> Move Forward Party</p>
                <p class="text-left">Connecting to MFP’s Powerful API <br> Laravel
                    v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
            </div>
            <hr class="stye1">
            <p style="font-size: 14px; color:#415B9175;">contact us : <span
                    class="font-blue">sojirat1996@gmail.com</span></p>
        </div>
        <div class="text-details" style="text-align: center;">
            <img src="/storage/image/MFP_logo.svg" width="200">
        </div>
    </div>
</body>

</html>
