<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of dossier
 *
 * @author bouraima joezer
 */
use Phalcon\Mvc\Model;

class dossier extends Model
{

    private $iddos;
    private $nomdos;
    private $date;
    private $iduser;

    /*
     * declaration des getters
     */
    function getIddos()
    {
        return $this->iddos;
    }

    function getNomdos()
    {
        return $this->nomdos;
    }

    function getDate()
    {
        return $this->date;
    }

    function getIduser()
    {
        return $this->iduser;
    }

    /*
     * declaration des setters
     */
    function setIddos($iddos)
    {
        $this->iddos = $iddos;
    }

    function setNomdos($nomdos)
    {
        $this->nomdos = $nomdos;
    }

    function setDate($date)
    {
        $this->date = $date;
    }

    function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    public function initialize()
    {
        /*
         * initialisation de la table
         */
        $this->setSource("dossier");
        /*
         * relation avec la table utilisateur
         */
        $this->belongsTo("iduser", "user", "iduser");
        /*
         * relation avec la table fichier
         */
        $this->hasMany("iddos", "fichier", "iddos");
    }
}
