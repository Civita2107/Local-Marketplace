<?php

class FFotoAnnuncio extends FDatabase{

    private static $table = "fotoAnnuncio";
    private static $class = "FFotoAnnuncio";
    private static $values = "(:idFoto, :nomeFoto, :altezza, :larghezza, :tipo, :data, :idAnn)";

    public function __construct() {}

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return self::$table;
    }

    /**
     * @return string
     */
    public static function getClass(): string
    {
        return self::$class;
    }

    /**
     * @return string
     */
    public static function getValues(): string
    {
        return self::$values;
    }

    public static function bind($stmt, EFotoAnnuncio $fotoAnnuncio, $nome_file){
        $path = $_FILES[$nome_file]['tmp_name'];
        $file = fopen($path, 'r') or die ("Attenzione! Impossibile da aprire!");
        $stmt->bindValue(':id', NULL, PDO::PARAM_INT);
        $stmt->bindValue(':nFoto', $fotoAnnuncio->getNomeFoto(), PDO::PARAM_STR);
        $stmt->bindValue(':altezza', $fotoAnnuncio->getAltezza(), PDO::PARAM_INT);
        $stmt->bindValue(':larghezza', $fotoAnnuncio->getLarghezza(), PDO::PARAM_INT);
        $stmt->bindValue(':tipo', $fotoAnnuncio->getTipo(), PDO::PARAM_STR);
        $stmt->bindValue(':data', fread($file, filesize($path)), PDO::PARAM_LOB);
        $stmt->bindValue(':idAnn', $fotoAnnuncio->getIdAnn(), PDO::PARAM_INT);
        unset($file);
        unlink($path);
    }

    public static function store(EFotoAnnuncio $fotoAnnuncio, $nome_file){
        $db = parent::getInstance();
        $db->storeMediaDB(static::getClass(), $fotoAnnuncio, $nome_file);
    }

    public static function exist($field, $id) {
        $db = parent::getInstance();
        $result = $db->existDB(static::getClass(), $field, $id);
        if ($result != null)
            return true;
        else
            return false;
    }

    public static function delete($field, $id) {
        $db = parent::getInstance();
        $db->deleteDB(static::getClass(), $field, $id);
    }

    public static function loadByField($parametri = array(), string $ordinamento, string $limite) {
        $foto = null;
        $db = parent::getInstance();
        $result = $db->searchDB(static::getClass(), $parametri, $ordinamento, $limite);
        if (count())
    }
}