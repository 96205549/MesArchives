<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of corbeille
 *
 * @author bouraimajoezer
 */
use Phalcon\Mvc\Model;

class corbeille extends Model
{
    private $idcorb;
    private $nomfile;
    private $description;
    private $iddos;
    private $date;
    private $iduser;
    
    /*
     * declaration des getters
     */
    function getIdcorb()
    {
        return $this->idcorb;
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
    function setIdcorb($idcorb)
    {
        $this->idcorb = $idcorb;
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
        $this->setSource("corbeille");
        /*
         * relation avec la table utilisateur
         */
        $this->belongsTo("iduser", "user", "iduser");
    }


}
