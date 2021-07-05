<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/newstyle.css')}}" rel="stylesheet">
</head>
<body>
    <div class="div container">
    <div class="login">
        <h1>Login</h1>
        <form method="post" action="">
          <p><i class="fa fa-envelope fa-2x"></i><input type="text" name="login" value="" placeholder="Type your Email"></p>
          <p><i class="fa fa-lock fa-3x"></i><input type="password" name="password" value="" placeholder="Type your Password"></p>
          <p class="submit"><input type="submit" name="commit" value="Login"></p>
        </form>
      </div>
    </div>
</body>
</html>