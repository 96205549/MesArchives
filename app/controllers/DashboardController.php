<?php
use Phalcon\Mvc\Controller;

class DashboardController extends Controller
{

     public function initialize() {
        $this->view->setMainView('board');
        $this->tag->setTitle('dashboard');
        //parent::initialize();
    }
    
    
    public function indexAction()
    {
        "<h1>hello</h1>";   
        
    }
    /*
     * gestion des contacts
     */
    public function newContactAction()
    {
        "<h1>hello</h1>";     
    }
    public function mesContactsAction()
    {
        "<h1>hello</h1>";     
    }
    /*
     * gestion de la corbeille
     */
    
    public function corbeilleAction()
    {
        "<h1>hello</h1>";     
    }
    
    /*
     * gestions des archives
     */
    public function newArchiveAction()
    {
        "<h1>hello</h1>";     
    }
    public function mesArchivesAction()
    {
        "<h1>hello</h1>";     
    }
    
    /*
     * gestion des messages
     */
    
    public function newMessageAction()
    {
        "<h1>hello</h1>";     
    }
    public function mesMessagesAction()
    {
        "<h1>hello</h1>";     
    }
    
    /*
     * gestions des fichiers
     */
    
    public function newFolderAction()
    {
           
    }
    public function mesFoldersAction()
    {
        "<h1>hello</h1>";     
    }
    /*
     * gestions des fichiers
     */
    
    public function newFileAction()
    {
        "<h1>hello</h1>";     
    }
    /*
     * gestion des utilisateurs
     */
    public function newUserAction()
    {
        "<h1>hello</h1>";     
    }
    /*
     * gestions des profiles
     */
    public function newProfileAction()
    {
        "<h1>hello</h1>";     
    }
    
    /*
     * paramètre de configuration
     */
    public function settingsAction()
    {
        "<h1>hello</h1>";     
    }

}

