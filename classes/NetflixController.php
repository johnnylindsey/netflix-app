<?php
class NetflixController
{

    private $command;
    private $db;

    public function __construct($command)
    {
        $this->command = $command;
        $this->db = new Database();
    }

    public function run()
    {
        switch ($this->command) {
            case "netflix":
                $this->netflix();
                break;
            case "movie":
                $this->movie();
                break;
            case "logout":
                $this->destroySession();
                header("Location: ?command=login");
                break;
            case "myAccount":
                $this->myAccount();
                break;
            case "create":
                $this->createAccount();
                break;
            case "addComment":
                $this->addComment();
                break;
            case "deleteAccount":
                $this->deleteAccount();
                break;
            case "login":
            default:
                $this->login();
                break;
        }
    }

    // Clear all the cookies that we've set
    private function destroySession()
    {
        unset($_SESSION["username"]);
        unset($_SESSION["email"]);
        unset($_SESSION["password"]);
    }


    // Display the login page (and handle login logic)
    private function login()
    {

        if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["username"]) && !empty($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["password"])) {

            $data = $this->db->query("select * from user where email = ? and username = ?;", "ss", $_POST["email"], $_POST["username"]);

            if ($data === false) {
                $error_msg = "Bad user";
            } else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {

                    $_SESSION["email"] = $data[0]["email"];
                    $_SESSION["username"] = $data[0]["username"];
                    $_SESSION["password"] = $data[0]["password"];
                    header("Location: ?command=netflix");
                } else {
                    $error_msg = "Incorrect password";
                }
            } else {
                $error_msg = "Create an account first or re-try credentials.";
            }
        }

        include "templates/login.php";
    }

    private function logout()
    {

        if (isset($_POST["logout"])) {
            $this->destroySession();
            header("Location: ?command=login");
        }
    }

    private function createAccount()
    {

        if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["username"]) && !empty($_POST["username"])) {

            $insert = $this->db->query("insert into user (username, email, password) values (?, ?, ?);", "sss", $_POST["username"], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT));

            if ($insert === false) {
                $error_msg = "Error inserting user";
            } else {
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["username"] = $_POST["username"];
                $_SESSION["password"] = $_POST["password"];
                header("Location: ?command=netflix");
            }
        }

        include "templates/create-account.php";
    }

    private function deleteAccount()
    {
            $delete = $this->db->query("delete from user where username = ?", "s", $_SESSION["username"]);

            if ($delete === false) {
                $error_msg = "Error deleting user";
            } else {
                $this->destroySession();
                header("Location: ?command=login");
            }

    }

    private function netflix()
    {
        $user = [
            "email" => $_SESSION["email"],
            "username" => $_SESSION["username"]
        ];

        include("templates/app.php");
    }

    private function movie()
    {

        $user = [
            "email" => $_SESSION["email"],
            "username" => $_SESSION["username"]
        ];

        $_SESSION["theMovie"] = $_POST["theMovie"];

        include("templates/movie.php");
    }

    private function myAccount()
    {

        $user = [
            "email" => $_SESSION["email"],
            "username" => $_SESSION["username"]
        ];

        include("templates/my-account.php");
    }

    public function getMovieByName($name = null)
    {
        $select = $this->db->query("select * from movie where movieName = ?;", "s", $name);

        return $select;
    }

    private function addComment()
    {

        $user = [
            "email" => $_SESSION["email"],
            "username" => $_SESSION["username"]
        ];

        $d = $this->db->query("select * from movie where movieName = ?", "s", $_SESSION["theMovie"]);
        $theInsert = $this->db->query("insert into comment (showID, time, username, commentText) values (?, ?, ?, ?);", "ssss", $d[0]["showID"], date("Y-m-d h:i:sa"), $user["username"], $_POST["theComment"]);
        header("Location: ?command=netflix");
    }

    function getAllComments()
    {
        global $db;
        $query = "select * from Comment";


        // 1. prepare
        // 2. bindValue & execute
        $statement = $db->prepare($query);
        $statement->execute();

        // fetchAll() returns an array of all rows in the result set
        $results = $statement->fetchAll();

        $statement->closeCursor();

        return $results;
    }

    function getComment_byName($username)
    {
        global $db;
        $query = "select * from Comment where username = :name";

        // 1. prepare
        // 2. bindValue & execute
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $username);
        $statement->execute();

        // fetch() returns a row
        $results = $statement->fetch();

        $statement->closeCursor();

        return $results;
    }

    function updateComment($username, $commentText)
    {
        global $db;
        $query = "update Comment set commentText=:commentText where username=:name";
        $statement = $db->prepare($query);
        $statement->bindValue(':commentText', $commentText);
        $statement->bindValue(':name', $username);
        //making sure it runs against the database
        $statement->execute();
        $statement->closeCursor();
    }


    function deleteComment($username)
    {
        global $db;
        $query = "delete from Comment where username=:name";
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $username);
        //making sure it runs against the database
        $statement->execute();
        $statement->closeCursor();
    }
}

