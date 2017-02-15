<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of archive
 *
 * @author bouraima joezer
 */
use Phalcon\Mvc\Model;

class archive extends Model
{

    private $idarch;
    private $nomarch;
    private $description;
    private $iddos;
    private $date;
    private $iduser;

    /*
     * declaration des getters
     */
    function getIdarch()
    {
        return $this->idarch;
    }

    function getNomarch()
    {
        return $this->nomarch;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getIddos()
    {
        return $this->iddos;
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
    function setIdarch($idarch)
    {
        $this->idarch = $idarch;
    }

    function setNomarch($nomarch)
    {
        $this->nomarch = $nomarch;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    function setIddos($iddos)
    {
        $this->iddos = $iddos;
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
        $this->setSource("archive");
        /*
         * relation avec la table utilisateur
         */
        $this->belongsTo("iduser", "user", "iduser");
        /*
         * relation avec la table dossier
         */
        $this->belongsTo("iddos", "dossier", "iddos");
    }
}
