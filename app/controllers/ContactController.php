<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of ContactController
 *
 * @author karth solution
 */
use Phalcon\Mvc\Controller;

class ContactController extends controller
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

    public function newContactAction()
    {

        if ($this->request->isPost()) {
            
        }

        $groupes = groupe::find();
        $this->view->groupes = $groupes;
    }

    public function newGroupeAction()
    {

        if ($this->request->isPost() && !$this->request->isAjax()) {

            $groupe = $this->request->getPost("nomgroupe");

            if (empty($groupe)) {
                $this->flashSession->error("Veuillez renseigner le nom du groupe");
                $this->response->redirect("contact/newContact");
            } else {
                $newgroup = new groupe();

                $newgroup->setNomgroupe($groupe);
                $newgroup->setIduser($this->session->get('userid'));
                if ($newgroup->save()) {
                    $this->flashSession->success("Un nouveau groupe a ete creer avec succes");
                    $this->response->redirect("contact/newContact");
                } else {
                    $this->flashSession->error("Echec le groupe n&apos; a pas pu etre creer");
                    $this->response->redirect("contact/newContact");
                }
            }
        }
        if ($this->request->isAjax()) {
            $reponse = ["msg" => NULL, "success" => FALSE, "id" => NULL];
            $groupe = $this->request->getPost("nomgroupe");

            if (empty($groupe)) {
                $reponse['msg'] = "Veuillez renseigner le nom du groupe";
            } else {
                $newgroup = new groupe();
                $newgroup->setNomgroupe($groupe);
                $newgroup->setIduser($this->session->get('userid'));
                if ($newgroup->save()) {
                    $reponse['msg'] = "Un nouveau groupe a ete creer avec succes";
                    $reponse['id'] = $newgroup->idgroupe;
                    $reponse["success"] = true;
                } else {
                    $reponse['msg'] = "Echec le groupe n&apos; a pas pu etre creer";
                }
            }
            return json_encode($reponse);
        }

        // }
    }

    public function mesContactsAction()
    {
        
    }
}
