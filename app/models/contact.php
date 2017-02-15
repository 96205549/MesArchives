<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of contact
 *
 * @author bouraima joezer
 */
use Phalcon\Mvc\Model;

class contact extends Model
{
    private $id;
    private $fulname;
    private $mobile;
    private $email;
    private $idgroupe;
    private $iduser;
    
    /*
     * declaration des getters
     */
    function getId()
    {
        return $this->id;
    }

    function getFulname()
    {
        return $this->fulname;
    }

    function getMobile()
    {
        return $this->mobile;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getIdgroupe()
    {
        return $this->idgroupe;
    }

    function getIduser()
    {
        return $this->iduser;
    }

    /*
     * declaration des setters
     */
    function setId($id)
    {
        $this->id = $id;
    }

    function setFulname($fulname)
    {
        $this->fulname = $fulname;
    }

    function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setIdgroupe($idgroupe)
    {
        $this->idgroupe = $idgroupe;
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
        $this->setSource("contact");
        /*
         * relation avec la table utilisateur
         */
        $this->belongsTo("iduser", "user", "iduser");
    }


}
