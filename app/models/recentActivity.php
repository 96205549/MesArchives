<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of recentActivity
 *
 * @author twicejo-tech
 */
use Phalcon\Mvc\Model;

class recentActivity extends Model{
    
    private $id;
    private $activite;
    private $date;
    private $iduser;
    
    
    function getId() {
        return $this->id;
    }

    function getActivite() {
        return $this->activite;
    }

    function getDate() {
        return $this->date;
    }

    function getIduser() {
        return $this->iduser;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setActivite($activite) {
        $this->activite = $activite;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setIduser($iduser) {
        $this->iduser = $iduser;
    }

     public function initialize()
    {
        $this->setSource("recentactivity");
        
        $this->belongsTo("iduser", "user", "iduser");
    }

}
