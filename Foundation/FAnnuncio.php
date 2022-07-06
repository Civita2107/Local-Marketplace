<?php

class FAnnuncio extends FDatabase{

public function __construct(){

    parent::__construct();
    $this->table = 'annuncio';
    $this->values = '(:titolo,:descrizione,:prezzo,:idFoto,:data,:idAnnuncio,:idVenditore,:idCompratore,:arrayFoto)';
    $this->class = 'FAnnuncio';

    }

    public function bind($stmt, EAnnuncio $annuncio)
    {
        $stmt->bindParam(':titolo', $annuncio->getTitolo(), PDO::PARAM_STR);
        $stmt->bindParam(':descrizone', $annuncio->getDescrizione(), PDO::PARAM_STR);
        $stmt->bindParam(':prezzo', $annuncio->getPrezzo(), PDO::PARAM_STR);
        $stmt->bindParam(':idFoto', $annuncio->getIdFoto(), PDO::PARAM_INT);
        $stmt->bindParam(':data', $annuncio->getData(), PDO::PARAM_STR);
        $stmt->bindParam(':idAnnuncio', $annuncio->getIdAnnuncio(), PDO::PARAM_INT);
        $stmt->bindParam(':idVenditore', $annuncio->getIdVenditore(), PDO::PARAM_INT);
        $stmt->bindParam(':idCompratore', $annuncio->getIdCompratore(), PDO::PARAM_INT);
        //arrayfoto???
    }//per caricare tutti i dati nel database

    public  function getFromRow($row)
    {
        $ann = new EAnnuncio ($row['titolo'], $row['descrizione'], $row['prezzo'], $row['idfoto'],$row['idAnnuncio'],$row['idVenditore'], $row['idCompratore'], $row['arrayfoto']);
        $ann->setIdAnnuncio($row['idAnnuncio']);
        $ann->setIdVenditore($row['idVenditore']);
        $ann->setIdCompratore($row['idCompratore']);
        $ann->setData($row['data']);
        return $ann;
    } //Crea un array con tutti gli elementi dell'Annuncio


    public function search($attributo, $valore){
        $array = parent::search($attributo,$valore);
        $arrayAnnunci = array();
        if(($array!=null) && (count($array)>0)){
            foreach($array as $i){
                $ann = $this->getFromRow($i);
                array_push($arrayAnnunci, $ann);
            }
            return $arrayAnnunci;
        }
        else return null;

    } //Cerco un annuncio attraverso un paramentro chiave-valore

    public function store($annuncio)
    {
        $id = parent::store($annuncio);
        if ($id) {

            $foto = file_get_contents('./pics/annunci.png');
            $fotoObj = new EFotoAnnuncio($foto, 'pic/png');
            $fotoObj->setIdAnn($id);
            $fotoAnn = new FFotoAnnuncio();
            $fotoAnn->store($fotoObj);
            return $id;
        }
        else {
            return false;
        }
    }

    private function buildRow($row)
    {
        //caricamento annunci dell'utente
        $fAnn = new FAnnuncio();
        $arrayAnn = $fAnn->loadByIdUser($row['idUser']);
        $row['annuncio'] = $arrayAnn;
        // da completare con preferiti
        return $row;
    }


    public function loadById($id)
    {
        $row = parent::loadbyId($id);//attraverso il metodo della classe padre restituisco la riga
        $arAnn = $row[0];
        if(($row!=null) && (count($row)>0)){
            $ann = $this->getFromRow($arAnn);
            return $ann;
        }
        else return null;{
        }
    }

    // metodo che trova le recensioni relativi a un utente
    public function loadByIdUser($iduser){
        $query = "SELECT * FROM ".$this->table." WHERE idUser=".$iduser.";";
        try{
            $this->connection->beginTransaction();
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->connection->commit();
            $arrayann=array();
            foreach ($rows as $row){
                $ann = $this->getFromRow($row);
                array_push($arrayann,$ann);
            }
            return $arrayann;
        }
        catch (PDOException $e){
            $this->connection->rollback();
            echo "Attenzione, errore: ".$e->getMessage();
            return null;
        }
    }


}