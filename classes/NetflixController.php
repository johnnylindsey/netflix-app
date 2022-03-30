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
    }


    // Display the login page (and handle login logic)
    private function login()
    {

        if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["name"]) && !empty($_POST["name"])) {

            $data = $this->db->query("select * from user where email = ? and username = ?;", "ss", $_POST["email"], $_POST["name"]);

            if ($data === false) {
                $error_msg = "Bad user";
            } else if (!empty($data)) {
                $_SESSION["email"] = $data[0]["email"];
                $_SESSION["name"] = $data[0]["username"];
                header("Location: ?command=netflix");
            } else {
                $error_msg = "Create an account first or re-try credentials.";
            }
        }

        include "templates/login.php";
    }

    private function createAccount()
    {

        if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["name"]) && !empty($_POST["name"])) {

            $insert = $this->db->query("insert into user (username, email) values (?, ?);", "ss", $_POST["name"], $_POST["email"]);
            
            if ($insert === false) {
                $error_msg = "Error inserting user";
            } else {
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["name"] = $_POST["name"];
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
