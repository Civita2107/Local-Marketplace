<?php

class EUtente implements JsonSerializable
{
    private string $nome;
    private string $cognome;
    private  $idUser;
    private string $email;
    private string $password;
    private $idFoto;
    private DateTime $dataIscrizione;
    private DateTime $dataFineBan;
    private $ban;
    private bool $admin;

    /**
     * @param string $nome
     * @param string $cognome
     * @param int $idUser
     * @param string $email
     * @param string $password
     * @param $idFoto
     * @param $dataIscrizione
     * @param $dataFineBan
     * @param $ban
     * @param bool $admin
     */
    public function __construct(string $nome = null, string $cognome=null, string $email=null, $idFoto=null, $dataIscrizione=null, $dataFineBan=null, $ban=null, string $password=null, bool $admin=null)
    {
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $email;
        $this->password = $password;
        $this->idFoto = $idFoto;
        $this->dataIscrizione = $dataIscrizione;
        $this->dataFineBan = $dataFineBan;
        $this->ban = $ban;
        $this->admin = $admin;
    }


    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser( $idUser): void
    {
        $this->idUser = $idUser;
    }
    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getCognome(): string
    {
        return $this->cognome;
    }

    /**
     * @param string $cognome
     */
    public function setCognome(string $cognome): void
    {
        $this->cognome = $cognome;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getIdFoto(): int
    {
        return $this->idFoto;
    }

    /**
     * @param int $idFoto
     */
    public function setIdFoto(int $idFoto): void
    {
        $this->idFoto = $idFoto;
    }

    /**
     * @return DateTime
     */
    public function getDataIscrizione(): DateTime
    {
        return $this->dataIscrizione;
    }

    /**
     * @param DateTime $dataIscrizione
     */
    public function setDataIscrizione(DateTime $dataIscrizione): void
    {
        $this->dataIscrizione = $dataIscrizione;
    }

    /**
     * @return DateTime
     */
    public function getDataFineBan(): DateTime
    {
        return $this->dataFineBan;
    }

    /**
     * @param DateTime $dataFineBan
     */
    public function setDataFineBan(DateTime $dataFineBan): void
    {
        $this->dataFineBan = $dataFineBan;
    }
    /**
     * @return  mixed $ban
     */
    public function isBan(): bool
    {
        return $this->ban;
    }

    /**
     * @param mixed $ban
     */
    public function setBan($ban): void
    {
        $this->ban = $ban;
    }
    /**
     * @return bool
     */
    public function getAdmin(): bool
    {
        return $this->admin;
    }

    /**
     * @param bool $admin
     */
    public function setAdmin(bool $admin): void
    {
        $this->admin = $admin;
    }



    public function jsonSerialize()
    {
        return
            [
                'nome'   => $this->getNome(),
                'cognome' => $this->getCognome(),
                'idUser'   => $this->getIdUser(),
                'email'   => $this->getEmail(),
                'password'   => $this->getPassword(),
                'idFoto'   => $this->getIdFoto(),
                'dataIscrizione'   => $this->getDataIscrizione(),
                'dataFineBan'   => $this->getDataFineBan(),
                'ban'   => $this->isBan(),
                'admin' => $this->getAdmin()
            ];
    }
}