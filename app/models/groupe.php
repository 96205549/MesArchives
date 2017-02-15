<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of groupe
 *
 * @author bouraima joezer
 */
use Phalcon\Mvc\Model;

class groupe extends Model
{
    
    private $idgroupe;
    private $nomgroupe;
    private $iduser;

    /*
     * declaration des getters
     */

    function getIdgroupe()
    {
        return $this->idgroupe;
    }

    function getNomgroupe()
    {
        return $this->nomgroupe;
    }

    function getIduser()
    {
        return $this->iduser;
    }
    /*
     * declaration des setters
     */

    function setIdgroupe($id)
    {
        $this->idgroupe = $id;
    }

    function setNomgroupe($nomgroupe)
    {
        $this->nomgroupe = $nomgroupe;
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
        $this->setSource("groupe");
        /*
         * relation avec la table contact
         */
        $this->hasMany("idgroupe", "contact", "idgroupe");
        /*
         * relation avec la table groupe
         */
        $this->belongsTo("iduser", "user", "iduser");
    }
}
