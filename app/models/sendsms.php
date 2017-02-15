<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sendsms
 *
 * @author bouraima joezer
 */
use Phalcon\Mvc\Model;

class sendsms extends Model
{
    private $idsms;
    private $expediteur;
    private $destinataire;
    private $message;
    private $status;
    private $date;
    private $iduser;
    
    
    /*
     * declaration des getters
     */
    function getIdsms()
    {
        return $this->idsms;
    }

    function getExpediteur()
    {
        return $this->expediteur;
    }

    function getDestinataire()
    {
        return $this->destinataire;
    }

    function getMessage()
    {
        return $this->message;
    }

    function getStatus()
    {
        return $this->status;
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

    function setExpediteur($expediteur)
    {
        $this->expediteur = $expediteur;
    }

    function setDestinataire($destinataire)
    {
        $this->destinataire = $destinataire;
    }

    function setMessage($message)
    {
        $this->message = $message;
    }

    function setStatus($status)
    {
        $this->status = $status;
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
        $this->setSource("sendsms");
        /*
         * relation avec la table utilisateur
         */
        $this->belongsTo("iduser", "user", "iduser");
    }


}
