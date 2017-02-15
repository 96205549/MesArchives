<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of profile
 *
 * @author bouraima joezer
 */
use Phalcon\Mvc\Model;

class profile extends Model
{

    private $idprofile;
    private $nomprofile;
    private $permission;

    /*
     * declaration des getters
     */

    function getIdprofile()
    {
        return $this->idprofile;
    }

    function getNomprofile()
    {
        return $this->nomprofile;
    }

    function getPermission()
    {
        return $this->permission;
    }
    /*
     * declaration des setters
     */

    function setIdprofile($idprofile)
    {
        $this->idprofile = $idprofile;
    }

    function setNomprofile($nomprofile)
    {
        $this->nomprofile = $nomprofile;
    }

    function setPermission($permission)
    {
        $this->permission = $permission;
    }

    public function initialize()
    {
        $this->setSource("profile");
        $this->hasMany("idprofile", "user", "profile");
    }
}
