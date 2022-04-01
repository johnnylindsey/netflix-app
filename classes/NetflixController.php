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
            case "account":
                $this->account();
                break;
            case "logout":
                $this->destroySession();
                header("Location: ?command=login");
                break;
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

    private function netflix()
    {
        $user = [
            "email" => $_SESSION["email"],
            "username" => $_SESSION["username"]
        ];

        include("templates/app.php");
    }

    private function account()
    {

        $user = [
            "email" => $_SESSION["email"],
            "username" => $_SESSION["username"]
        ];

        // SELECT MovieName FROM favorites NATURAL JOIN user NATURAL JOIN movie WHERE username = 'user22';
        //$data_favorites = $this->db->query("select * from favorites where username = ?;", "s", "user22");
        $data_favorites = $this->db->query("select movieName FROM favorites NATURAL JOIN user NATURAL JOIN movie WHERE username = ?;", "s", $user["username"]);
        $data_comments = $this->db->query("select movieName, commentText, time FROM commentsOn NATURAL JOIN user NATURAL JOIN movie NATURAL JOIN comment WHERE username = ?;", "s", $user["username"]);  //", "s", $user["username"]);

        include("templates/account.php");
    }

    public function getMovieByName($name = null)
    {
        $select = $this->db->query("select * from movie where movieName = ?;", "s", $name);

        return $select;
    }
}
