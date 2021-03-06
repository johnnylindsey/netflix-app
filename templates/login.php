<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Johnny Lindsey, Kya Carrington, Brendan Pulju, and Tarunikha Sriram">
    <meta name="description" content="Netflix App for CS4750">
    <title>CS4750 Netflix App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body style="background-color: rgb(28, 148, 148);">
<nav class="navbar navbar-dark bg-dark" >
    <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Netflix App</a>
    </div>
        <ul class="nav navbar-nav">
        <li><a href="?command=login" class="text-white">Login</a></li>
        <li><a href="?command=create" class="text-white">Create Account</a></li>
        </ul>
    </div>
</nav>
    <div class="container" style="margin-top: 15px;">
        <div class="row col-xs-8" style="color: white;">
            <h1 class="text-center">CS4750 Netflix App</h1>
            <p class="text-center">Please enter your credentials below.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-4">
                <?php
                if (!empty($error_msg)) {
                    echo "<div class='alert alert-danger'>$error_msg</div>";
                }
                ?>

                <form action="?command=login" method="post">
                    <div class="mb-3" style="color: white;">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" />
                    </div>
                    <div class="mb-3" style="color: white;">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" />
                    </div>
                    <div class="mb-3" style="color: white;">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" />
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark">Login</button>
                    </div>
                </form>

                <br/>

                <form action="?command=create" method="post">
                    <div class="text-center">
                        <button type="submit" name="create" class="btn btn-dark">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>