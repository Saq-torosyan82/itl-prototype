<DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    <h2>
        Welcome {{$data['name']}}!
    </h2>
    <p>Nice to meet you in our Agency.</p>
    <p>Below is your account details :</p>
    <br>
    <p>Email: {{$data['email']}}</p>
    <p>Full Name: {{$data['username']}}</p>
    <p>Phone: {{$data['phone']}}</p>
    </body>
    </html>