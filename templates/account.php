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
            <h1>My Account</h1>
            <h3>Hi, <?= $user["username"]?></h3>

        </div>

        <hr />

        <div class="h-10 p-5">
            <!-- My account -> favorites, my comments, delete account -->
            <h2>My Favorites</h2>

            <!-- <div class="row justify-content-center">   -->
            <table class="w3-table w3-bordered w3-card-4" style="width:90%">

        </div>

        </table>

        <div class="row">
            <div class="col-xs-8 mx-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Movie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_favorites as $value) { ?>
                            <tr>
                                <td><?php echo $value['movieName'] ?></td>
                            </tr>
                        <?php } ?>                        
                    </tbody>
                </table>
            </div>
        </div>

        <div class="h-10">
            <!-- My account -> favorites, my comments, delete account -->
            <h2>My Comments</h2>
            <div class="row">
            <div class="col-xs-8 mx-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Movie</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Time</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_comments as $value) { ?>
                            <tr>
                                <td><?php echo $value['movieName'] ?></td>
                                <td><?php echo $value['commentText'] ?></td>
                                <td><?php echo $value['time'] ?></td>
                            </tr>
                        <?php } ?>   
                        <!--
                        <tr>
                            <td>movie1</td>
                            <td>comment1</td>
                            <td>01:00:00</td>

                        </tr>
                        <tr>
                            <td>movie1</td>
                            <td>comment2</td>
                            <td>02:00:00</td>

                        </tr>
                        <tr>
                            <td>movie3</td>
                            <td>comment3</td>
                            <td>03:00:00</td>

                        </tr>
                        -->
                    </tbody>
                </table>
            </div>
        </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>