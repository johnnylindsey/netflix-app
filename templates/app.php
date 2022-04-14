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

<body>
    <div class="container" style="margin-top: 15px;">
        <div class="row col-xs-8">
            <h1>Netflix App</h1>
            <h3>Hi, <?= $user["username"]; ?></h3>
        </div>

        <?php
        if (!empty($error_msg)) {
            echo "<div class='alert alert-danger'>$error_msg</div>";
        }
        ?>

        <div class="row">
            <div class="col-xs-8 mx-auto">

                <form action="?command=movie" method="post">

                    <div class="input-group h-10 p-5 mb-3">
                        <input type="text" class="form-control" name="theMovie" id="theMovie" placeholder="Enter movie here">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>

            </div>
            <br />
        </div>

        <div class="row">
            <div class="col-xs-8 mx-auto">
                <h2 class="text-center">Complete List of Movies</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Show ID</th>
                            <th scope="col">Movie</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Year</th>
                            <th scope="col">Country</th>
                        </tr>
                    </thead>
                    <tbody>
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

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>