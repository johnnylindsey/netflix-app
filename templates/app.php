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

        <div class="row">
            <div class="col-xs-8 mx-auto">

                <form action="?command=search" method="post">

                    <div class="input-group h-10 p-5 mb-3">
                        <input type="text" class="form-control" name="answer" id="answer" placeholder="Enter movie here">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <hr />

        <div class="h-10 p-5">
            <h2>Relevant Movies</h2>
            <!-- <div class="row justify-content-center">   -->
            <table class="w3-table w3-bordered w3-card-4" style="width:90%">
                <thead>
                    <tr style="background-color:#B0B0B0">
                        <th width="25%">Name</th>
                        <th width="25%">Major</th>
                        <th width="20%">Year</th>
                        <th width="12%">Update ?</th>
                        <th width="12%">Delete ?</th>
                    </tr>
                </thead>
                <?php foreach ($list_of_friends as $friend) : ?>
                    <tr>
                        <td><?php echo $friend['name']; ?></td>
                        <td><?php echo $friend['major']; ?></td>
                        <td><?php echo $friend['year']; ?></td>
                        <td>
                            <form action="simpleform.php" method="post">
                                <input type="submit" value="Update" name="btnAction" class="btn btn-primary" />
                                <input type="hidden" name="friend_to_update" value="<?php echo $friend['name'] ?>" />
                            </form>
                        </td>
                        <td>
                            <form action="simpleform.php" method="post">
                                <input type="submit" value="Delete" name="btnAction" class="btn btn-primary" />
                                <input type="hidden" name="friend_to_delete" value="<?php echo $friend['name'] ?>" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </div>

        </table>

        <div class="row">
            <div class="col-xs-8 mx-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Movie</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Year</th>
                            <th scope="col">Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>

                        <?php foreach ($list_of_movies as $movie) : ?>
                            <tr>
                                <td><?php $movie ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>