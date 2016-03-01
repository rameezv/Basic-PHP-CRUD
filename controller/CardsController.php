<?php
/**
 * CardsController and TableRows classes
 */

/**
 * TableRows creator for Arrays
 */
class TableRows extends RecursiveIteratorIterator {
    private $currid = NULL;

    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td><a href='picture.php?id=$this->currid'>".parent::current()."</a></td>";
    }

    function beginChildren() {
        echo "<tr>";
        $this->currid = parent::current();
    }

    function endChildren() {
        echo "<td data='$this->currid'><a href='update.php?id=$this->currid'>UPDATE</a></td></tr>" . "\n";
    }
}

/**
 * CardsController
 * Controls the CRUD functions of the CardsService.
 */
class CardsController {

    private $cardsService = NULL;   // CardsService holder

    /**
     * Creates a new CardsService attached to a CardsController
     */
    public function __construct() {
        $this->cardsService = new CardsService();
    }

    /**
     * Displays all humans and dogs in database
     * @return void
     */
    public function display() {
        $this->viewAllHumans();
        $this->viewAllDogs();
    }

    /**
     * Add a human to the database
     * @param int    $id    ID number (starts with 0 for humans)
     * @param char[] $name  Name of human
     * @param char[] $job   Human's occupation
     * @param char[] $phone Phone number
     */
    public function addHuman( $id, $name, $job, $phone ) {
        $this->cardsService->addHuman($id, $name, $job, $phone);
    }

    /**
     * Add a dog to the database
     * @param int    $id      ID number (starts with 1 for dogs)
     * @param int    $ownerId Owner's ID number, if in system
     * @param char[] $name    Dog's name
     */
    public function addDog( $id, $ownerId, $name ) {
        if ($ownerId < 10000) {
            $ownerId = 0;
            echo "<b>".$ownerId."</b>";
        }
        $this->cardsService->addDog($id, $ownerId, $name);
    }

    /**
     * Remove a human from the database
     * @param  int $id ID of human to remove
     * @return void
     */
    public function removeHuman( $id ) {
        $this->cardsService->removeHuman($id);
    }

    /**
     * Remove a dog from the database
     * @param  int $id ID of dog to remove
     * @return void
     */
    public function removeDog( $id ) {
        $this->cardsService->removeDog($id);
    }

    /**
     * update info on existing human
     * @param  int    $id    ID number (starts with 0 for humans)
     * @param  char[] $name  Name of human
     * @param  char[] $job   Human's occupation
     * @param  char[] $phone Phone number
     * @return void
     */
    public function updateHuman( $id, $name, $job, $phone ) {
        $this->cardsService->updateHuman($id, $name, $job, $phone);
    }

    /**
     * update info on existing dog
     * @param  int    $id      ID number (starts with 1 for dogs)
     * @param  int    $ownerId Owner's ID number, if in system
     * @param  char[] $name    Dog's name
     * @return void
     */
    public function updateDog( $id, $ownerId, $name ) {
        $this->cardsService->updateDog($id, $ownerId, $name);
    }

    /**
     * Associate picture with an ID number
     * @param  int    $id    ID number associated with picture
     * @param  char[] $img   URL of image
     */
    public function addPic( $id, $img ) {
        $this->cardsService->addPicture($id, $img);
    }

    /**
     * Update picture for an ID number
     * @param  int    $id    ID number associated with picture
     * @param  char[] $img   URL of image
     * @return void
     */
    public function updatePic( $id, $img ) {
        $this->cardsService->updatePicture($id, $img);
    }

    /**
     * [removePic description]
     * @param  int    $id    ID number associated with picture
     * @return void
     */
    public function removePic ($id) {
        $this->cardsService->removePicture($id);
    }

    /**
     * Display all humans in database as TableRows
     * @return void
     */
    public function viewAllHumans() {
        echo "<h2>Humans</h2><table class='human'>";
        foreach(new TableRows(new RecursiveArrayIterator($this->cardsService->getAllHumans())) as $k=>$v) {
            echo $v . " ";
        }
        echo "</table>";
    }

    /**
     * Display all dogs in database as TableRows
     * @return void
     */
    public function viewAllDogs() {
        echo "<h2>Dogs</h2><table class='dog'>";
        foreach(new TableRows(new RecursiveArrayIterator($this->cardsService->getAllDogs())) as $k=>$v) {
            if ($k == 'id') {
                echo $v;
            } else {
                echo $v;
            }
        }
        echo "</table>";
    }

    /**
     * Get Human from ID
     * @param  int    $id id of desired human
     * @return Array      human info
     */
    public function getHumanFromId($id) {
        return $this->cardsService->getHumanFromId($id);
    }

    /**
     * Get Dog from ID
     * @param  int    $id id of desired dog
     * @return Array      dog info
     */
    public function getDogFromId($id) {
        return $this->cardsService->getDogFromId($id);
    }

    /**
     * Get Pic from ID
     * @param  int    $id id of entity
     * @return Array      url of image
     */
    public function getPicFromId($id) {
        return $this->cardsService->getPictureFromId($id);
    }

    /**
     * Checks to see if a human ID is already in use
     * @param  int    $id ID to check
     * @return Boolean    returns true if ID is in use, false otherwise
     */
    public function checkIDInUseHuman($id) {
        return ($this->getHumanFromId($id) != false);
    }

    /**
     * Checks to see if a dog ID is already in use
     * @param  int    $id ID to check
     * @return Boolean    returns true if ID is in use, false otherwise
     */
    public function checkIDInUseDog($id) {
        return ($this->getDogFromId($id) != false);
    }

}

?>