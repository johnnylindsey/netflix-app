<?php
class NetflixController
{

    private $command;

    public function __construct($command)
    {
        $this->command = $command;
    }

    public function run()
    {
        switch ($this->command) {
            case "wordle":
                $this->netflix();
                break;
            case "logout":
                $this->destroyCookies();
            case "create":
                $this->createAccount();
                break;
            case "login":
            default:
                $this->login();
                break;
        }
    }

    // Clear all the cookies that we've set
    private function destroyCookies()
    {
        setcookie("name", "", time() - 3600);
        setcookie("email", "", time() - 3600);
    }


    // Display the login page (and handle login logic)
    public function login() {

        if (isset($_POST["email"]) && !empty($_POST["email"])) {
            
            global $db;

            $query = "select * from user where email=:email and username=:name";

            $statement = $db->prepare($query);

            $statement->bindValue(':email', $_POST["email"]);
            $statement->bindValue(':name', $_POST["name"]);

            $statement->execute();

            $user = $statement->fetch();

            if($user){
                setcookie("name", $_POST["name"], time() + 3600);
                setcookie("email", $_POST["email"], time() + 3600);
                header("Location: ?command=wordle");
                return;
            } else {
                echo "Invalid credentials. Try again or create an account.";
            }
        }

        include "templates/login.php";
    }

    public function createAccount() {

        if (isset($_REQUEST["email"]) && !empty($_REQUEST["email"])) {
            
            global $db;

            $query = "insert into user (email, username) values (email=:email, username=:name)";

            $statement = $db->prepare($query);

            $statement->bindValue(':email', $_REQUEST["email"]);
            $statement->bindValue(':name', $_REQUEST["name"]);

            $statement->execute();

            setcookie("name", $_POST["name"], time() + 3600);
            setcookie("email", $_POST["email"], time() + 3600);
            header("Location: ?command=wordle");
            return;
        }

        include "templates/create-account.php";
    }


    // Display the question template (and handle question logic)
    public function netflix()
    {
        // set user information for the page from the cookie
        $user = [
            "name" => $_COOKIE["name"],
            "email" => $_COOKIE["email"]
        ];

        // if the user submitted an answer, check it
        if (isset($_POST["answer"])) {
            $answer = $_POST["answer"];

            if ($_COOKIE["answer"] == $answer) {
                // user answered correctly -- perhaps we should also be better about how we
                // verify their answers, perhaps use strtolower() to compare lower case only.
                $message = "<div class='alert alert-success'><b>$answer</b> was correct!</div>";

                // Update the score
                $user["score"] += 10;
                // Update the cookie: won't be available until next page load (stored on client)
                setcookie("score", $_COOKIE["score"] + 10, time() + 3600);
            } else {
                $message = "<div class='alert alert-danger'><b>$answer</b> was incorrect! The answer was: {$_COOKIE["answer"]}</div>";
            }
            setcookie("correct", "", time() - 3600);
        }

        include("templates/app.php");
    }

    public function addFriend($name, $major, $year)
    {
        // db handler
        global $db;

        $query = "insert into friends values(:name, :major, :year)";

        // execute the sql
        // $statement = $db->query($query);   // query() will compile and execute the sql
        $statement = $db->prepare($query);

        $statement->bindValue(':name', $name);
        $statement->bindValue(':major', $major);
        $statement->bindValue(':year', $year);

        $statement->execute();

        // release; free the connection to the server so other sql statements may be issued 
        $statement->closeCursor();
    }

    public function getAllFriends()
    {

        global $db;
        $query = "select * from friends";

        $statement = $db->prepare($query);
        $statement->execute();

        // fetchAll() returns an array of all rows in the result set
        $results = $statement->fetchAll();

        $statement->closeCursor();

        return $results;
    }

    public function getFriend_byName($name)
    {
        global $db;
        $query = "select * from friends where name = :name";

        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->execute();

        // fetch() returns a row
        $results = $statement->fetch();

        $statement->closeCursor();

        return $results;
    }

    public function updateFriend($name, $major, $year)
    {
        global $db;

        $query = "update friends set major=:major, year=:year where name=:name";

        $statement = $db->prepare($query);

        $statement->bindValue(':name', $name);
        $statement->bindValue(':major', $major);
        $statement->bindValue(':year', $year);
        $statement->execute();

        $statement->closeCursor();
    }

    public function deleteFriend($name)
    {
        global $db;

        $query = "delete from friends where name=:name";

        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->execute();

        $statement->closeCursor();
    }
}
