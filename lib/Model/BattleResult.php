<?php


class BattleResult
{
    private $usedJediPowers;
    private $winningShip;
    private $losingShip;

    public function __construct($usedJediPowers, Ship $winningShip = null, Ship $losingShip = null) //boolean, ship object and ship object
    {
        $this->usedJediPowers = $usedJediPowers;
        $this->winningShip = $winningShip;
        $this->losingShip = $losingShip;
    }

    /** @return boolean */
    public function wereJediPowersUsed(){
        return $this->usedJediPowers;
    }

    /** @return Ship|null */
    public function getWinningShip(){
        return $this->winningShip;
    }

    /** @return Ship|null */
    public function getLosingShip(){
        return $this->losingShip;
    }

    public function isThereAWInner(){
        return$this->getWinningShip() !== null;
    }

}