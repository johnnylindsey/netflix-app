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
            case "updateComment":
                $this->updateComment();
                header("Location: ?command=myAccount");
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
            case "bigList":
                $this->bigList();
                break;
            case "addComment":
                $this->addComment();
                break;
            case "deleteComment":
                $this->deleteComment($_POST["theComment"]);
                header("Location: ?command=myAccount");
                break;
            case "deleteAccount":
                $this->deleteAccount();
                break;
            case "favorite":
                $this->favorite();
                header("Location: ?command=myAccount");
            case "deleteFavorite":
                $this->deleteFavorite($_POST["theComment"]);
                header("Location: ?command=myAccount");
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

            //$data = $this->db->query("select * from user where email = ? and username = ?;", "ss", $_POST["email"], $_POST["username"]);

            $data = $this->db->query("select * from user where email=? and username=?", "ss", $_POST["email"], $_POST["username"]);

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

        //$query = "delete from Comment where (showID=:showID) and (username=:username)";
        //$query = "delete from Comment where username=:username";
        //$statement = $this->db->prepare($query);
        //$statement->bindValue(':showID', $showID);
        //$statement->bindValue(':username', $user["username"]);
        //making sure it runs against the database
        //$statement->execute();
        //$statement->closeCursor();

        include "templates/login.php";
    }

    private function logout()
    {

        if (isset($_POST["logout"])) {
            $this->destroySession();
            header("Location: ?command=login");
        }
    }

    private function bigList()
    {
        include('templates/actorsList.php');
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

    private function favorite()
    {

        $user = [
            "email" => $_SESSION["email"],
            "username" => $_SESSION["username"]
        ];

        $s = $this->db->query("select * from movie where movieName = ?;", "s", $_SESSION["theMovie"]);
        $theInsert = $this->db->query("insert into favorites (username, showID) values (?, ?);", "ss", $user["username"], $s[0]["showID"]);
    }

    private function myAccount()
    {

        $user = [
            "email" => $_SESSION["email"],
            "username" => $_SESSION["username"]
        ];

        include("templates/my-account.php");
    }

    private function deleteFavorite($showID)
    {

        $user = [
            "email" => $_SESSION["email"],
            "username" => $_SESSION["username"]
        ];

        $d = $this->db->query("delete from favorites where (showID=?) and (username=?)", "ss", $showID, $user["username"]);
    }

    private function addComment()
    {

        $user = [
            "email" => $_SESSION["email"],
            "username" => $_SESSION["username"]
        ];

        $d = $this->db->query("select * from movie where movieName = ?", "s", $_SESSION["theMovie"]);
        $theInsert = $this->db->query("insert into comment (showID, username, commentText) values (?, ?, ?);", "sss", $d[0]["showID"], $user["username"], $_POST["theComment"]);
        $commentsOn = $this->db->query("insert into commentson (username, time, showID) values (?, ?, ?);", "sss",  $user["username"], date("H:i:s"), $d[0]["showID"]);
        header("Location: ?command=netflix");
    }

    private function updateComment()
    {

        $user = [
            "email" => $_SESSION["email"],
            "username" => $_SESSION["username"]
        ];
        echo $_POST["theComment"];
        echo $_POST["showID"];
        $d = $this->db->query("update comment set commentText=? WHERE (showID=?) and (username=?)", "sss", $_POST["theComment"], $_POST["showID"], $user["username"]);
        echo $d;
        echo $user["username"];
    }

    function deleteComment($showID)
    {
        $user = [
            "email" => $_SESSION["email"],
            "username" => $_SESSION["username"]
        ];

        $d = $this->db->query("delete from comment where (showID=?) and (username=?)", "ss", $showID, $user["username"]);

        //$query = "delete from Comment where (showID=:showID) and (username=:username)";
        //$query = "delete from Comment where username=:username";
        //$statement = $this->db->prepare($query);
        //$statement->bindValue(':showID', $showID);
        //$statement->bindValue(':username', $user["username"]);
        //making sure it runs against the database
        //$statement->execute();
        //$statement->closeCursor();
    }
}
