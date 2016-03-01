<?php
/**
 * CardsService class
 * Talks to the DB and performs operations
 */
class CardsService {

    private $servername = "localhost:2016";
    private $username = "350user";
    private $password = "350password";
    private $conn = NULL;

    /**
     * Begins the CardsService by opening and closing a database.
     */
    public function __construct() {
        $this->openDB();
        $this->closeDB();
        //echo "Service Started<br />";
    }

    /**
     * Opens the database and creates any missing databases.
     * @throws Exception if failure
     * @return void
     */
    private function openDB() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=tfDB", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE IF NOT EXISTS tfDBPDO;
            USE tfDBPDO;";
            // use exec() because no results are returned
            $this->conn->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS humans(
            id INT(7) UNSIGNED PRIMARY KEY,
            name VARCHAR(20) NOT NULL,
            job VARCHAR(50),
            phone VARCHAR(10)
            )";
            $this->conn->exec($sql);
            $sql="CREATE TABLE IF NOT EXISTS dogs (
            id INT(7) UNSIGNED PRIMARY KEY,
            ownerId INT(7) UNSIGNED,
            name VARCHAR(20)
            )";
            $this->conn->exec($sql);
            $sql="CREATE TABLE IF NOT EXISTS pictures (
            id INT(7) UNSIGNED PRIMARY KEY,
            pic VARCHAR(150)
            )";
            $this->conn->exec($sql);
        } catch(PDOException $e) {
            throw new Exception("Database Connection Error: $e.<br />");
        }
    }

    /**
     * Closes the open database.
     * @return void
     */
    private function closeDB() {
        $this->conn = NULL;
    }

    /**
     * Checks if dataase can connect.
     * @throws Exception on failed connection
     * @return String   Connection information
     */
    public function testConnection() {
        try {
            $this->openDB();
            return "DB connection successful!<br />";
        } catch (Exception $e) {
            throw "Error with DB - $e";
        }
        $this->closeDB();
    }

    /**
     * Retreive all information in database about each human
     * @return Array data in 'humans' table
     */
    public function getAllHumans() {
        try {
            $this->openDB();
            $stmt = $this->conn->prepare("SELECT id, name, job, phone FROM humans");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $this->closeDB();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

    /**
     * Get Human from ID number
     * @param  int    $idnum ID number of desired human
     * @return Array         contains info of human
     */
    public function getHumanFromId ($idnum) {
        try {
            $this->openDB();
            $stmt = $this->conn->prepare("SELECT id, name, job, phone FROM humans WHERE id=$idnum");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $this->closeDB();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

    /**
     * Retreive all information in database about each dog
     * @return Array data in 'dogs' table
     */
    public function getAllDogs() {
        try {
            $this->openDB();
            $stmt = $this->conn->prepare("SELECT id, ownerId, name FROM dogs");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $this->closeDB();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

    /**
     * Get dog from ID number
     * @param  int    $idnum ID number of desired dog
     * @return Array         contains info of dog
     */
    public function getDogFromId ($idnum) {
        try {
            $this->openDB();
            $stmt = $this->conn->prepare("SELECT id, ownerId, name FROM dogs WHERE id=$idnum");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $this->closeDB();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

    /**
     * Add human to database
     * @param  int    $idnum ID number (starts with 0 for humans)
     * @param  char[] $name  Name of human
     * @param  char[] $job   Human's occupation
     * @param  char[] $phone Phone number
     */
    public function addHuman( $idnum, $name, $job, $phone ) {
        try {
            $this->openDB();
            $sql = "INSERT INTO humans (id, name, job, phone) VALUES ($idnum, '$name', '$job', '$phone')";
            $this->conn->exec($sql);
            $this->closeDB();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

    /**
     * Add dog to database
     * @param  int    $idnum   ID number (starts with 1 for dogs)
     * @param  int    $ownerId Owner's ID number, if in system
     * @param  char[] $name    Dog's name
     */
    public function addDog( $idnum, $ownerId, $name ) {
        try {
            $this->openDB();
            $sql = "INSERT INTO dogs (id, ownerId, name) VALUES ($idnum, $ownerId, '$name')";
            $this->conn->exec($sql);
            $this->closeDB();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

    /**
     * Removes existing human from database
     * @param  int $id ID of human to remove
     * @throws Exception on failure
     * @return void
     */
    public function removeHuman( $id ) {
        try {
            $this->openDB();
            $sql = "DELETE FROM humans WHERE id=$id";
            $this->conn->exec($sql);
            $this->closeDB();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

    /**
     * Removes existing dog from database
     * @param  int $id ID of dog to remove
     * @throws Exception on failure
     * @return void
     */
    public function removeDog( $id ) {
        try {
            $this->openDB();
            $sql = "DELETE FROM dogs WHERE id=$id";
            $this->conn->exec($sql);
            $this->closeDB();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

    /**
     * Update existing human in database
     * @param  int    $idnum ID number (starts with 0 for humans)
     * @param  char[] $name  Name of human
     * @param  char[] $job   Human's occupation
     * @param  char[] $phone Phone number
     */
    public function updateHuman( $idnum, $name, $job, $phone ) {
        try {
            $this->openDB();
            $sql = "UPDATE humans SET name='$name', job='$job', phone='$phone' WHERE id=$idnum";
            $this->conn->exec($sql);
            $this->closeDB();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

    /**
     * Update dog in database
     * @param  int    $idnum   ID number (starts with 1 for dogs)
     * @param  int    $ownerId Owner's ID number, if in system
     * @param  char[] $name    Dog's name
     */
    public function updateDog( $idnum, $ownerId, $name ) {
        try {
            $this->openDB();
            $sql = "UPDATE dogs SET ownerId=$ownerId, name='$name' WHERE id=$idnum";
            $this->conn->exec($sql);
            $this->closeDB();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

    /**
     * Associate picture with an ID number
     * @param  int    $idnum ID number associated with picture
     * @param  char[] $img   URL of image
     */
    public function addPicture( $idnum, $img ) {
        try {
            $this->openDB();
            $sql = "INSERT INTO pictures (id, pic) VALUES ($idnum, '$img')";
            $this->conn->exec($sql);
            $this->closeDB();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

    /**
     * Get picture from an ID number
     * @param  int    $idnum ID number associated with picture
     * @return Array         URL of image
     */
    public function getPictureFromId( $idnum ) {
        try {
            $this->openDB();
            $stmt = $this->conn->prepare("SELECT pic FROM pictures WHERE id=$idnum");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $this->closeDB();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

    /**
     * [updatePicture description]
     * @param  int    $idnum ID number associated with picture
     * @param  char[] $img   URL of image
     * @return void
     */
    public function updatePicture( $idnum, $img ) {
        try {
            $this->openDB();
            $sql = "UPDATE pictures SET pic=$img WHERE id=$idnum";
            $this->conn->exec($sql);
            $this->closeDB();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

    /**
     * Delete picture associated with ID
     * @param  int    $idnum ID number associated with picture
     * @return void
     */
    public function removePicture( $idnum ) {
        try {
            $this->openDB();
            $sql = "DELETE FROM pictures WHERE id=$idnum";
            $this->conn->exec($sql);
            $this->closeDB();
        } catch (Exception $e) {
            $this->closeDB();
            throw $e;
        }
    }

}

?>