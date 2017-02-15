<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of users
 *
 * @author karth solution
 */
use Phalcon\Mvc\Model;

class user extends Model
{
    /*
     * declaration des variables
     */

    private $iduser;
    private $fulname;
    private $pseudo;
    private $email;
    private $idprofile;
    private $password;
    private $actif;

    /*
     * declaration des getters
     */

    function getIduser()
    {
        return $this->iduser;
    }

    function getFulname()
    {
        return $this->fulname;
    }

    function getPseudo()
    {
        return $this->pseudo;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getIdprofile()
    {
        return $this->idprofile;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getActif()
    {
        return $this->actif;
    }
    /*
     * declaration des setters
     */

    function setFulname($fulname)
    {
        $this->fulname = $fulname;
    }

    function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    function setEmail($mail)
    {
        $this->email = $mail;
    }

    function setIdprofile($profile)
    {
        $this->idprofile = $profile;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setActif($actif)
    {
        $this->actif = $actif;
    }

    public function initialize()
    {
        $this->setSource("user");
        
        $this->belongsTo("idprofile", "profile", "idprofile");
    }
}
