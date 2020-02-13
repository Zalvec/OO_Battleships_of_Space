<?php


class Ship {
    /** PROPERTIES **/
    private $name;
    private $weaponPower = 0;
    private $jediFactor = 0;
    private $strength = 0;
    private $underRepair;
    private $id;

    /** METHODS **/

    /**
     *@param int $name
     */
    public function __construct($name) {
        $this->name = $name;
        $this->underRepair = mt_rand(1, 100) < 30;
    }

    public function isFunctional() {   //werkt zoals een get method  - word automatisch uitgevoerd
        return !$this->underRepair;
    }

    public function sayHello() {
        echo "POWEEERRR!!! UN-LIMITED POOOWEEEERRRRRR!!!";
    }

    public function doesGivenShipHaveMoreStrength($givenShip) {
        return $givenShip->strength > $this->strength;
    }

    //via code → generate... → getters and setters
    /** Get functions */
    public function getName() {
        return $this->name;
    }

    public function getNameAndSpecs($useShortFormat = false) {
        if($useShortFormat) {
            return sprintf(
                '%s: %s/%s/%s',
                $this->name,
                $this->weaponPower,
                $this->jediFactor,
                $this->strength
            );
        } else {
            return sprintf(
                '%s: w:%s, j:%s, s:%s',
                $this->name,
                $this->weaponPower,
                $this->jediFactor,
                $this->strength
            );
        }
    }

    public function getWeaponPower() {
        return $this->weaponPower;
    }

    public function getJediFactor() {
        return $this->jediFactor;
    }

    public function getStrength() {
        return $this->strength;
    }

    /** @return mixed */
    public function getId(){
        return $this->id;
    }

    /** Set functions */

    /**@param int $name */
    public function setName($name) {
        $this->name = $name;
    }

    public function setWeaponPower($weaponPower) {
        $this->weaponPower = $weaponPower;
    }

    public function setJediFactor($jediFactor) {
        $this->jediFactor = $jediFactor;
    }
    /**
     *@throws
     *@param int $strength
     */
    public function setStrength($strength) {
        if (!is_numeric($strength)) {
            throw new Exception("Strength must be a number, duh! So don't use '$strength' as a number");
        }
        $this->strength = $strength;
    }



    /** @param mixed $id */
    public function setId($id){
        $this->id = $id;
    }


}