<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of FolderController
 *
 * @author karth solution
 */
use Phalcon\Mvc\Controller;

class FolderController extends Controller
{

    public function initialize()
    {
        $this->view->setMainView('board');
        $this->tag->setTitle('Bienvenue');
        //parent::initialize();
    }

    public function indexAction()
    {
        
    }

    public function newFolderAction()
    {
        
    }

    public function mesFoldersAction()
    {
        
    }
}