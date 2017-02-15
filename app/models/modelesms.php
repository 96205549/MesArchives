<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelesms
 *
 * @author bouraima joezer
 */
use Phalcon\Mvc\Model;

class modelesms extends Model
{
    private $idsms;
    private $sms;
    private $date;
    private $iduser;
    
    /*
     * declaration des getters
     */
    function getIdsms()
    {
        return $this->idsms;
    }

    function getSms()
    {
        return $this->sms;
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
    function setIdsms($idsms)
    {
        $this->idsms = $idsms;
    }

    function setSms($sms)
    {
        $this->sms = $sms;
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
        $this->setSource("modelesms");
        /*
         * relation avec la table utilisateur
         */
        $this->belongsTo("iduser", "user", "iduser");
    }


}
