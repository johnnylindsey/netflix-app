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
        <div style="color: white;">
            <h1 class="text-center">Netflix App</h1>
            <h3 class="text-center">Hi, <?= $user["username"]; ?></h3>
        </div>

        <?php
        if (!empty($error_msg)) {
            echo "<div class='alert alert-danger'>$error_msg</div>";
        }
        ?>

        <div class="h-10 p-5">
            <h2 class="text-center" style="color: white;">Results for <?= $_SESSION["theMovie"] ?></h2>
        </div>

        <div class="row">
            <div class="col-xs-8 mx-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-white">Show ID</th>
                            <th scope="col" class="text-white">Username</th>
                            <th scope="col" class="text-white">Rating</th>
                            <th scope="col" class="text-white">Duration</th>
                            <th scope="col" class="text-white">Year</th>
                            <th scope="col" class="text-white">Country</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        <?php
                        $d = $this->db->query("select * from movie where movieName = ?", "s", $_SESSION["theMovie"]);

                        /*
                        $count = 1;
                        foreach ($data as $d) {
                            echo "<tr><th scope='row'>" . $count . "</th><td>" . $d['date'] . "</td><td>" . $d['trans_name'] . "</td><td>" . $d['category'] . "</td><td>" . $d['amount'] . "</td><td>" . $d['type'] . "</td></tr>";
                            $count = $count + 1;
                        }
                        */
                        echo "<tr><th scope='row'>" . $d[0]['showID'] . "</th><td>" . $d[0]['movieName'] . "</td><td>" . $d[0]['rating'] . "</td><td>" . $d[0]['duration'] . "</td><td>" . $d[0]['releaseYear'] . "</td><td>" . $d[0]['country'] . "</td></tr>";
                        ?>
                    </tbody>
                </table>
                <br/>
            </div>
            <br></br> 
            <div class="col-4 mx-auto">
                <h3 class="text-center" style="color: white;">Who stars in this movie?</h2>

                <table class="table">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Show ID</th>
                            <th scope="col">Star</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        <?php
                        $d = $this->db->query("select * from movie where movieName = ?", "s", $_SESSION["theMovie"]);
                        $stars = $this->db->query("select * from starsin where showID = ?", "s", $d[0]["showID"]);

                        $count = 1;
                        foreach ($stars as $s) {
                            echo "<tr><th scope='row'>" . $count . "</th><td>" . $s['showID'] . "</td><td>" . $s['name'] . "</td>";
                            $count = $count + 1;
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
            <br></br>
            <div class="col-4 mx-auto">
                <h3 class="text-center" style="color: white;">Who directed this movie?</h2>

                <table class="table">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Show ID</th>
                            <th scope="col">Director</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        <?php
                        $d = $this->db->query("select * from movie where movieName = ?", "s", $_SESSION["theMovie"]);
                        $directs = $this->db->query("select * from directs where showID = ?", "s", $d[0]["showID"]);

                        $count = 1;
                        foreach ($directs as $d) {
                            echo "<tr><th scope='row'>" . $count . "</th><td>" . $d['showID'] . "</td><td>" . $d['name'] . "</td>";
                            $count = $count + 1;
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <br></br>
        <div class="h-10 p-5">
            <h2 class="text-center" style="color: white;">Comments</h2>
        </div>

        <div class="row">
            <div class="col-xs-8 mx-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="text-white">#</th>
                            <th scope="col" class="text-white">Username</th>
                            <th scope="col" class="text-white">Time</th>
                            <th scope="col" class="text-white">Comment</th>
                        </tr>
                    </thead>
                    <tbody class="text-white">
                        <?php
                        $cdat = $this->db->query("select * from comment where showID = ?", "s", $d[0]['showID']);

                        $count = 1;
                        foreach ($cdat as $c) {
                            echo "<tr><th scope='row'>" . $count . "</th><td>" . $c['username'] . "</td><td>" . $c['time'] . "</td><td>" . $c['commentText'] . "</td></tr>";
                            $count = $count + 1;
                        }

                        ?>
                    </tbody>
                </table>

                <br />
                <br></br>
                <h5 class="text-center" style="color: white;">Add Your Own Comment!</h5>
                <div class="text-center">
                    <form action="?command=addComment" method="post">

                        <div class="input-group h-10 p-5 mb-3">
                            <input type="text" class="form-control" name="theComment" id="theComment" placeholder="Enter comment here">
                            <button class="btn btn-dark" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>