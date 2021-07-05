<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/regstyle.css')}}" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">
        <div id="all">
            <h1 class="text-center">Sign up</h1>
    <form action="" class="form-group text-center">
        <label class="l">Name</label>
        <i class="fa fa-user fa-2x" style="position:absolute;top:173px;margin-left:180px"></i><input type="text" class="form-control" name="mname" placeholder="Name">
        <div class="row">
          
            <div class="col-lg-6">
                <br>
                <label>Email</label>
                <i class="fa fa-envelope" style="position:absolute;top:65px;margin-left:70px"></i><input type="text" class="form-control" name="memail" placeholder="Email">
                
            </div>
            <div class="col-lg-6">
                <br>
                <label>Phone</label> 
                <i class="fa fa-phone fa-2x" style="position:absolute;top:60px;margin-left:55px"></i><input type="text" class="form-control" name="mphone" placeholder="Phone">

            </div>
        </div>
<br>
        <div class="row">
          
            <div class="col-lg-6">
                <label>Password</label>
                <i class="fa fa-eye" style="position:absolute;top:45px;margin-left:25px"></i><i class="fa fa-lock fa-2x" style="position:absolute;top:35px;margin-left:50px"></i> <input type="password" class="form-control" name="mpassword" placeholder="Password">

            </div>
            <div class="col-lg-6">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="conpassword" placeholder=" confirm Password">

            </div>
        </div>
        <br>
        <input type="checkbox" value="1">
        <label  class="label col-md-2 control-label">Active</label>
        <input type="submit" class="btn btn-primary btn-block" value="Register">
    </form>
</div>
            </div>
            <div class="col-lg-3">

            </div>
        </div>

    </div>
</body>
</html>