<?php
/* La classe FUtente fornisce query per gli oggetti EUtente */
class FUtente extends FDatabase
{
    public function __construct()
    {
        parent::__construct(); //richiama il costruttore di FDatabase
        $this->table = 'utente';
        $this->valori = '(:$nome, :$cognome, :$username, :$password, :$email)';
        $this->class = 'FUtente';
    }

// metodo che lega gli attributi dell'utente che si vogliono inserire con i parametri della INSERT
    public static function bind($stmt, EUtente $user)
    {
        $stmt->bindValue(':idUser', NULL, PDO::PARAM_INT);
        $stmt->bindValue(':nome', $user->getNome(), PDO::PARAM_STR);
        $stmt->bindValue(':cognome', $user->getCognome(), PDO::PARAM_STR);
        $stmt->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
    }

// metodo che crea un oggetto EUtente a partire dalla tupla della tabella utente
    public function getFromRow($row)
    {
        $utObj = new EUtente($row['nome'], $row['cognome'], $row['username'], $row['password'], $row['email']);
        $utObj->setIdUser($row['idUser']);
        $utObj->setRecensioni($row['recensioni']);
        $utObj->setAnnunci(['annunci']);
        $utObj->setStorico(['storico']);
        $utObj->setFotoUtente(['fotoUtente']);
        return $utObj;
    }
// metodo che costruisce una row completa per "utente" così da poterla passare
// direttamente al metodo getFromRow
    private function buildRow($row)
    {
        //caricamento recensioni dell'utente
        $frece = new FRecensione();
        $arrayrece = $frece->loadByIdUser($row['idUser']);
        $row['recensione'] = $arrayrece;
        // da completare con preferiti
        return $row;
    }

//Metodo che esegue la load dell'utente in base all'id
    public function loadById($idutente)
    {
        $row = parent::loadById($idutente);
        if (($row != null) && (count($row) > 0)) {
            $rowAss = $row[0];
            $rowCompl = $this->buildRow($rowAss);
            $ut = $this->getFromRow($rowCompl);
            return $ut;
        } else {
            return null;
        }
    }

//Metodo load di oggetti EUtente dal db dato un gruppo di id
    public function loadAllByIds($idsut)
    {
        $utrows = parent::loadAllByIds($idsut);// TODO: Change the autogenerated stub
        if (($utrows != null) && (count($utrows) > 0)) {
            $arrayUt = array();
            foreach ($utrows as $rowAss) {
                $rowCompl = $this->buildRow($rowAss);
                $utente = $this->getFromRow($rowCompl);
                array_push($arrayUt, $utente);
            }
            return $arrayUt;
        } else return null;
    }

// Metodo che verifica se un utente è presente nel db
    public function existUtente($username, $password)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE username= '" . $username . "' AND password='" . $password . "';";
        try {
            $this->localmp->beginTransaction();
            $stmt = $this->localmp->prepare($query);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->LOCALMP->commit();
            if (($row != null) && (count($row) > 0)) {
                $rowass = $row[0];
                $id = $rowass['idUser'];
                return $id;
            } else return false;
        } catch (PDOException $e) {
            $this->localmp->rollback();
            echo "Attenzione, errore: " . $e->getMessage();
            return null;
        }
    }

// metodo che restituisce gli utenti che contengono una determinata stringa in uno degli attributi
    public function search($attributo, $valore)
    {
        $utrows = parent::search($attributo, $valore); // TODO: Change the autogenerated stub
        if (($utrows != null) && (count($utrows) > 0)) {
            $arrayUt = array();
            foreach ($utrows as $rowass) {
                $rowCompl = $this->buildRow($rowass);
                $utente = $this->getFromRow($rowCompl);
                array_push($arrayUt, $utente);
            }
            return $arrayUt;
        } else return null;
    }

// metodo per verificare se è presente un utente con un certo username
    public function existUsername($username)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE username= '" . $username . "';";
        try {
            $this->localmp->beginTransaction();
            $stmt = $this->localmp->prepare($query);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->localmp->commit();
            if (($row != null) && (count($row) > 0)) {
                return true;
            } else return false;
        } catch (PDOException $e) {
            $this->localmp->rollback();
            echo "Attenzione, errore: " . $e->getMessage();
            return null;
        }
    }
// metodo che conta gli utenti registrati
    public function contaUtentiRegistrati()
    {
        $query = "SELECT COUNT(idUser) AS n FROM " . $this->table . ";";
        try {
            $this->localmp->beginTransaction();
            $stmt = $this->localmp->prepare($query);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->localmp->commit();
            return $row[0]['n'];


        } catch (PDOException $e) {
            $this->localmp->rollBack();
            echo "Attenzione, errore: " . $e->getMessage();
            return null;
        }
    }

    public  function store($utente){
        $id=parent::store($utente);

    }

    public function utentiByString ($array, $toSearch)
    {
        if ($toSearch == 'nome')
            $query = "SELECT * FROM utente where name = '" . $array[0] . "' OR surname = '" . $array[0] . "';";
        else
            $query = "SELECT * FROM utente where name = '" . $array[0] . "' AND surname = '" . $array[1] . "' OR name = '" . $array[1] . "' AND surname = '" . $array[0] . "';";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num == 0)
            $result = null;
        elseif ($num == 1)
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        else {
            $result = array();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $stmt->fetch())
                $result[] = $row;
        }
        return array($result, $num);
    }


    public static function loadUtentiByString($string){
        $utente = null;
        $toSearch = null;
        $pieces = explode(" ", $string);
        $lastElement = end($pieces);
        if ($pieces[0] == $lastElement) {
            $toSearch = 'nome';
        }
        list ($result, $rows_number)=utentiByString($pieces, $toSearch);
        if(($result!=null) && ($rows_number == 1)) {
            $utente=new EUtente($result['name'],$result['surname'], $result['email'], $result['password']);
        }
        else {
            if(($result!=null) && ($rows_number > 1)){
                $utente = array();
                for($i=0; $i<count($result); $i++){
                    $utente[]=new EUtente($result[$i]['name'],$result[$i]['surname'], $result[$i]['email'], $result[$i]['password']);
                }
            }
        }
        return $utente;

    }

}



