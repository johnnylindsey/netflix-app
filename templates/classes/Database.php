<?php
class Database
{
    private $mysqli;

    
    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->mysqli = new mysqli(Config::$db["host"], 
                Config::$db["user"], Config::$db["pass"], Config::$db["database"]);
    }
    

/*
    public function __construct()
    {
        try {
            error_reporting(E_ALL);
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $this->mysqli = new PDO(
                Config::$db["host"],
                Config::$db["user"],
                Config::$db["pass"]
            );
            echo "Works";
        } catch (PDOException $e) {
            // Call a method from any object, use the object's name followed by -> and then method's name
            // All exception objects provide a getMessage() method that returns the error message 
            $error_message = $e->getMessage();
            echo "<p>An error occurred while connecting to the database: $error_message </p>";
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            echo "<p>Error message: $error_message </p>";
        }
    }
*/
    
    public function query($query, $bparam=null, ...$params) {
        $stmt = $this->mysqli->prepare($query);

        if ($bparam != null)
            $stmt->bind_param($bparam, ...$params);

        if (!$stmt->execute()) {
            return false;
        }

        if (($res = $stmt->get_result()) !== false) {
            return $res->fetch_all(MYSQLI_ASSOC);
        }

        return true;
    }
    


/*
    public function query($query, $bparam = null, ...$params)
    {
        $stmt = $this->mysqli->prepare($query);

        for ($i = 1; $i <= count($params); $i++) {
            $stmt->bindParam($bparam, ...$params);
        }

        if (($res = $stmt->execute()) === false) {
            return false;
        }

        if ($res !== false) {
            if ($res) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return "";
            }
        }

        return true;
    }

    */
}
