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
            <li><a href="?command=netflix" class="text-white">Netflix</a></li>
            <li><a href="?command=myAccount" class="text-white">My Account</a></li>
            <li><a href="?command=logout" class="text-white">Logout</a></li>
        </ul>
    </div>
</nav>
    <div class="container" style="margin-top: 15px;">
        <div class="row col-xs-8" style="color: white;">
            <h1 class="text-center">Netflix App</h1>
            <h3 class="text-center">Welcome, <?= $user["username"]; ?></h3>
        </div>

        <?php
        if (!empty($error_msg)) {
            echo "<div class='alert alert-danger'>$error_msg</div>";
        }
        ?>

        
            <br />
        </div>

        <div class="row">
            <div class="col-xs-8 mx-auto">
                <h2 class="text-center" style="color: white;">Complete List of Movies</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-white">Show ID</th>
                            <th scope="col" class="text-white">Movie</th>
                            <th scope="col" class="text-white">Rating</th>
                            <th scope="col" class="text-white">Duration</th>
                            <th scope="col" class="text-white">Year</th>
                            <th scope="col" class="text-white">Country</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        <?php
                        $data = $this->db->query("select * from movie order by movieName asc");

                        $count = 1;

                        foreach ($data as $d) {
                            echo "<tr><th scope='row'>" . $d['showID'] . "</th><td>" . $d['movieName'] . "</td><td>" . $d['rating'] . "</td><td>" . $d['duration'] . "</td><td>" . $d['releaseYear'] . "</td><td>" . $d['country'] . "</td></tr>";
                            $count = $count + 1;
                        }
                        ?>
                    </tbody>
                </table>
                <br />
            </div>

        </div>
        <br></br>
        <h4 class="text-center" style="color: white;">Search the Name of a Movie to Learn More</h4>
        <div class="row">
            <div class="col-xs-8 mx-auto">

                <form action="?command=movie" method="post">

                    <div class="input-group h-10 p-5 mb-3">
                        <input type="text" class="form-control" name="theMovie" id="theMovie" placeholder="Enter movie here">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="submit">Search</button>
                        </div>
                    </div>
                </form>

            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>