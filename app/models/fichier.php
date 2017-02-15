<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fichier
 *
 * @author bouraima joezer
 */
use Phalcon\Mvc\Model;

class fichier extends Model
{
    private $idfile;
    private $nomfile;
    private $description;
    private $iddos;
    private $date;
    private $iduser;
    
    /*
     * declaration des getters
     */
    function getIdfile()
    {
        return $this->idfile;
    }

    function getNomfile()
    {
        return $this->nomfile;
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
    function setIdfile($idfile)
    {
        $this->idfile = $idfile;
    }

    function setNomfile($nomfile)
    {
        $this->nomfile = $nomfile;
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
        $this->setSource("fichier");
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