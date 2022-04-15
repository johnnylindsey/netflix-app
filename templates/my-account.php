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
        <div class="row col-xs-8">
        <div style="color: white;">
            <h1 class="text-center">Netflix App</h1>
            <h3 class="text-center">Hi, <?= $user["username"]; ?></h3>
        </div>
        </div>
        <?= $error_msg ?>

        <?php
            if (!empty($error_msg)) {
                echo "<div class='alert alert-danger'>$error_msg</div>";
            }
        ?>

        <div class="text-center" style="color: white;">
            <h2>My Favorites</h2>
        </div>

        <div class="row">
            <div class="col-xs-8 mx-auto" >
                <table class="table"  style="color: white;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">showID</th>
                            <th scope="col">Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cdat = $this->db->query("select * from favorites where username = ?", "s", $user["username"]);

                        $count = 1;
                        foreach ($cdat as $c) {
                            $title = $this->db->query("select movieName from movie where showID = ?", "s", $c["showID"]);
                            foreach ($title as $t) {
                                echo "<tr><th scope='row'>" . $count . "</th><td>" . $c["showID"] . "</th><td>" . $t['movieName'] . "</td></tr>";
                                $count = $count + 1;                            
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="text-center">
            <form action="?command=deleteFavorite" method="post">
                <div class="input-group h-10 p-5 mb-3">
                    <input type="text" class="form-control" name="theComment" id="theComment" placeholder="Enter showID to delete movie from favorites">
                    <button class="btn btn-dark" name = "btnAction" type="submit">Delete</button>
                </div>
            </form>
        </div>

        <div class="text-center" style="color: white;">
            <h2>My Comments</h2>
        </div>

        <div class="row">
            <div class="col-xs-8 mx-auto" >
                <table class="table"  style="color: white;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">showID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Time</th>
                            <th scope="col">Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cdat = $this->db->query("select * from comment where username = ?", "s", $user["username"]);

                        $count = 1;
                        foreach ($cdat as $c) {
                            $title = $this->db->query("select movieName from movie where showID = ?", "s", $c["showID"]);
                            foreach ($title as $t) {
                                echo "<tr><th scope='row'>" . $count . "</th><td>" . $c["showID"] . "</th><td>" . $t["movieName"] . "</th><td>" . $c['time'] . "</td><td>" . $c['commentText'] . "</td></tr>";
                                $count = $count + 1;                            
                            }

                        }

                        ?>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="text-center">
            <form action="?command=deleteComment" method="post">
                <div class="input-group h-10 p-5 mb-3">
                    <input type="text" class="form-control" name="theComment" id="theComment" placeholder="Enter showID to delete comment for that movie">
                    <button class="btn btn-dark" name = "btnAction" type="submit">Delete</button>
                </div>
            </form>
        </div>

        <div class="text-center">
            <form action="?command=updateComment" method="post">
                <div class="input-group h-10 p-5 mb-3">
                    <input type="text" class="form-control" name="showID" id="showID" placeholder="Enter showID">
                    <input type="text" class="form-control" name="theComment" id="theComment" placeholder="Enter new comment text">
                    <button class="btn btn-dark" name = "btnAction" type="submit" >Update</button>
                </div>
            </form>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
</body>

</html>