<?php
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{

     public function initialize() {
        $this->view->setMainView('main');
        $this->tag->setTitle('Bienvenue');
        //parent::initialize();
    }
    
    
    public function indexAction()
    {
        "<h1>hello</h1>";     
    }

}

