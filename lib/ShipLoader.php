<?php


class ShipLoader
{
    private $pdo;

    /**
     * @return Ship[]
     * @throws Exception
     */
    public function getShips()
    {
        $shipsData = $this->queryForShips();

        $ships = array();
        foreach($shipsData as $shipData) {     //we maken van onze array van array's, maken we een array van objecten
            $ships[] = $this->createShipFromData($shipData);
        }
        return $ships;
//        $ship = new Ship('Jedi Starfighter');
////    $ship->setName('Jedi Starfighter');
//        $ship->setWeaponPower(5);
//        $ship->setJediFactor(15);
//        $ship->setStrength(30);
//        $ships['starfighter'] = $ship;
//
//        $ship2 = new Ship('CloakShape Fighter');
//        $ship2->setWeaponPower(2);
//        $ship2->setJediFactor(2);
//        $ship2->setStrength(70);
//        $ships['cloakshapefighter'] = $ship2;
//
//        $ship3 = new Ship('Super Star Destroyer');
//        $ship3->setWeaponPower(70);
//        $ship3->setJediFactor(0);
//        $ship3->setStrength(500);
//        $ships['destroyer'] = $ship3;
//
//        $ship4 = new Ship('RZ-1 A-wing interceptor');
//        $ship4->setWeaponPower(4);
//        $ship4->setJediFactor(4);
//        $ship4->setStrength(50);
//        $ships['interceptor'] = $ship4;
//
////    var_dump($ships); die;
//        return $ships;
//
//        /*
//            return array(
//                'starfighter' => array(
//                    'name' => 'Jedi Starfighter',
//                    'weapon_power' => 5,
//                    'jedi_factor' => 15,
//                    'strength' => 30,
//                ),
//                'cloakshape_fighter' => array(
//                    'name' => 'CloakShape Fighter',
//                    'weapon_power' => 2,
//                    'jedi_factor' => 2,
//                    'strength' => 70,
//                ),
//                'super_star_destroyer' => array(
//                    'name' => 'Super Star Destroyer',
//                    'weapon_power' => 70,
//                    'jedi_factor' => 0,
//                    'strength' => 500,
//                ),
//                'rz1_a_wing_interceptor' => array(
//                    'name' => 'RZ-1 A-wing interceptor',
//                    'weapon_power' => 4,
//                    'jedi_factor' => 4,
//                    'strength' => 50,
//                ),
//            );*/
    }

    /**
     * @param $id
     * @return Ship|null
     */
    public function findOneById($id){
        $pdo = $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM ship WHERE id = :id');
        $statement->execute(array('id' => $id));
        $shipArray = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$shipArray) {      //als je een ship niet kunt ophalen, return je null, anders heb object
            return null;
        }

        return $this->createShipFromData($shipArray);
    }

    private function createShipFromData(array $shipData){
        $ship = new Ship($shipData['name']);
        $ship->setId($shipData['id']);
        $ship->setWeaponPower($shipData['weapon_power']);
        $ship->setJediFactor($shipData['jedi_factor']);
        $ship->setStrength($shipData['strength']);

        return $ship;
    }

    private function queryForShips() {
        $pdo = $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM ship');
        $statement->execute();
        $shipsArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $shipsArray;
    }

    /** @return PDO */
    private function getPDO(){
        if($this->pdo === null){            //zorgt ervoor dat de pdo maar 1x word uitgevoerd
            $pdo = new PDO('mysql:host=localhost;dbname=oo_battle', 'root', 'ArtHur17');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->pdo = $pdo;
        }
        return $this->pdo;          //ongeacht of deze reeds is aangemaakt of net is aangemaakt, slaan we dit op in $pdo
    }
}