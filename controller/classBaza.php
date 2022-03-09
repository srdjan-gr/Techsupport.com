<?php

class Baza {

    private $db;

    public function __destruct()
    {
        mysqli_close($this->db);
    }

    // Metoda - Konekcija na bazu
    public function connect()
    {
        $this->db=@mysqli_connect("localhost:3309", "root", "", "ita_techsupport");
        if(!$this->db) return false;

        $this->query("SET NAMES utf8");
        return $this->db;
    }
    
    // Metoda 
    public function query($upit)
    {
        return mysqli_query($this->db, $upit);
    }

    public function fetch_assoc($rez)
    {
        return mysqli_fetch_assoc($rez);
    }
    
    public function fetch_object($rez)
    {
        return mysqli_fetch_object($rez);
    }

    public function error($upit)
    {
        return mysqli_errno($this->db);
    }

    public function error_number($upit)
    {
        return mysqli_errno($this->db);
    }

    public function num_rows($rez){
        return mysqli_num_rows($rez);
    }

    public function insert_id(){
        return mysqli_insert_id($this->db);
    }

}