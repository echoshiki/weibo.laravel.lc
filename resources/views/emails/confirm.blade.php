<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>激活您的账户</title>
</head>
<body>
    <h1>感谢您在本平台注册成为用户</h1>
    <hr>
    <p>为了您能正常使用该平台，请点击下面的链接激活您的账户：</p>
    <p>
        <a href="{{ route('confirm_email', $user->activation_token) }}">{{ route('confirm_email', $user->activation_token) }}</a>
    </p>
</body>
</html>