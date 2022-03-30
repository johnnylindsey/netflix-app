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
            case "addcomment":
                $this->addComment();
                break;
            case "deleteComment":
                $this->deleteComment();
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

            $insert = $this->db->query("insert into User (username, email) values (?, ?);", "ss", $_POST["name"], $_POST["email"]);

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

    public function getMovieByName($name = null)
    {
        $select = $this->db->query("select * from movie where movieName = ?;", "s", $name);

        return $select;
    }

    function addComment($username, $commentText)
    {
	// db handler
	global $db;

	$query = "insert into Comment values(:name, :commentText)";

	// execute the sql
	$statement = $db->prepare($query);

	$statement->bindValue(':name', $username);
	$statement->bindValue(':commentText', $commentText);

	$statement->execute();

	// release; free the connection to the server so other sql statements may be issued 
	$statement->closeCursor();
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
	$statement->bindValue(':commentText',$commentText);
	$statement->bindValue(':name',$name);
	//making sure it runs against the database
	$statement->execute();
	$statement->closeCursor();

}


function deleteComment($username)
{
	global $db;
	$query = "delete from Comment where username=:name";
	$statement = $db->prepare($query);
	$statement->bindValue(':name',$name);
	//making sure it runs against the database
	$statement->execute();
	$statement->closeCursor();
}

}
