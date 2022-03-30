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
            case "logout":
                $this->destroySession();
                header("Location: ?command=login");
                break;
            case "create":
                $this->createAccount();
                break;
            case "search":
                $this->getMovieByName();
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
        unset($_SESSION["name"]);
        unset($_SESSION["email"]);
        unset($_SESSION["password"]);
    }


    // Display the login page (and handle login logic)
    private function login()
    {

        if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["name"]) && !empty($_POST["name"]) && isset($_POST["password"]) && !empty($_POST["password"])) {

            $data = $this->db->query("select * from user where email = ? and username = ?;", "ss", $_POST["email"], $_POST["name"]);

            if ($data === false) {
                $error_msg = "Bad user";
            } else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {

                    $_SESSION["email"] = $data[0]["email"];
                    $_SESSION["name"] = $data[0]["username"];
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

        if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["name"]) && !empty($_POST["name"])) {

            $insert = $this->db->query("insert into user (username, email, password) values (?, ?, ?);", "sss", $_POST["name"], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT));

            if ($insert === false) {
                $error_msg = "Error inserting user";
            } else {
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["name"] = $_POST["name"];
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
            "name" => $_SESSION["name"]
        ];

        include("templates/app.php");
    }

    public function getMovieByName($name = null)
    {
        $select = $this->db->query("select * from movie where movieName = ?;", "s", $name);

        return $select;
    }
}
