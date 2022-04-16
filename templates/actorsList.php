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
    <nav class="navbar navbar-dark bg-dark">
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

    <br>

    <div class="row">
        <div class="col-xs-8 mx-auto">
            <h2 class="text-center" style="color: white;">List of Actors</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-white">Actor</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <?php
                    $data = $this->db->query("select * from actor");

                    foreach ($data as $d) {
                        echo "<tr><th scope='row'>" . $d['name'] . "</th></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <br />
        </div>

    </div>

    <div class="row">
        <div class="col-xs-8 mx-auto">
            <h2 class="text-center" style="color: white;">List of Directors</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-white">Director</th>
                    </tr>
                </thead>
                <tbody class="text-white">
                    <?php
                    $data = $this->db->query("select * from director");

                    foreach ($data as $d) {
                        echo "<tr><th scope='row'>" . $d['name'] . "</th></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <br />
        </div>

    </div>

    <br></br>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>