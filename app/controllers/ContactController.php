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
        $corbeilles = corbeille:: find(['order' => ' idcorb DESC']);
        $this->view->corbeilles = ($corbeilles) ? $corbeilles : [];
    }

    public function indexAction()
    {
        
    }

    public function newContactAction()
    {

        if ($this->request->isPost()) {

            $fulname = $this->request->getPost("fulname");
            $mobile = $this->request->getPost("mobile");
            $email = $this->request->getPost("email");
            $groupe = $this->request->getPost("groupid");

            if (empty($fulname)) {
                $this->flashSession->error("Veuillez entrer le nom d&apos utilisateur");
            } elseif (empty($mobile)) {
                $this->flashSession->error("Veuillez renseigner le numero du client");
            } elseif (empty($email)) {
                $this->flashSession->error("Veuillez renseigner le mail du client");
            } elseif (!(int) $mobile) {
                $this->flashSession->error("Le numero ne peut &ecirc;tre une chaine de caractere");
            } elseif ((strlen($mobile) < 8)) {
                $this->flashSession->error("Veuillez renseigner un numero correcte");
            } else {
                $newContact = new contact();
                $newContact->setFulname($fulname);
                $newContact->setMobile($mobile);
                $newContact->setEmail($email);
                $newContact->setIdgroupe($groupe);
                $newContact->setIduser($this->session->get('userid'));
                if ($newContact->save()) {
                    $this->flashSession->success("Enregistrement avec succ&egrave;s");
                } else {
                    $this->flashSession->error("L&apos; enregistrement a echou&eacute;");
                }
            }
            $this->view->setVars(["fulname" => $fulname, "mobile" => $mobile, "email" => $email]);
        }

        $groupes = groupe::find();
        $this->view->groupes = $groupes;
        $this->view->page = "contact";
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
            $this->view->page = "contact";
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
    /*
     * update groupe
     */

    public function updateGroupeAction()
    {
        $id = $this->request->get("id");
        ((int) $id) ? $id = $this->request->get('id') : $this->response->redirect("contact/newContact");
        $getGroupe = groupe::findFirstByIdgroupe($id);
        if($getGroupe == FALSE){
            $this->response->redirect("contact/newContact");
        }
        $groupes = groupe::find();
        $this->view->groupes = $groupes;
        $this->view->getGroupe = $getGroupe;
        $this->view->page = "contact";
        
        if(!$this->request->isAjax() && $this->request->isPost()){
            $id= $this->request->getPost("idgroup");
            $nomgroup= $this->request->getPost("groupname");
            
             $group = groupe::findFirstByIdgroupe($id);

            if ($group) {
                $group->nomgroupe = $nomgroup;
                $group->iduser = $this->session->get('userid');

                if ($group->update()) {
                    //$this->disable();
                   $this->flashSession->success("le groupe de contact a &eacute;t&eacute; modifi&eacute; avec succ&egrave;");
                    $this->response->redirect("contact/updateGroupe?id=".$id);
                } else {
                    $this->flashSession->error("Echec de modification");
                    $this->response->redirect("contact/updateGroupe?id=".$id);
                }
            }
        }

        if ($this->request->isAjax()) {
            $reponse = ["success" => false, "msg" => null, "id" => null];

            $id = $this->request->getPost('upid');

            $nom = $this->request->getPost('upgroupe');


            $groupe = groupe::findFirstByIdgroupe($id);

            if ($groupe) {
                $groupe->nomgroupe = $nom;
                $groupe->iduser = $this->session->get('userid');

                if ($groupe->update()) {
                    $reponse["msg"] = "modification &eacute;ffectuer avec succ&egrave;s";
                    $reponse["success"] = true;
                } else {
                    $reponse["msg"] = "echec de modification";
                }
            }
            return json_encode($reponse);
        }
    }
    /*
     * delete groupe
     */

    public function deleteGroupeAction()
    {
        if (!$this->request->isAjax()) {

            $id = $this->request->get('id');
            ((int) $id) ? $id = $this->request->get('id') : $this->response->redirect("contact/newContact");
             $groupe = groupe::findFirstByIdgroupe($id);
            if ($groupe == TRUE) {
                 $membres = contact::find(["idgroupe=:val:", "bind" => ["val" => $groupe->idgroupe]]);
                if ($membres) {
                    foreach ($membres as $mb) {
                        $del = $mb->delete();
                    }
                }
                if ($groupe->delete()) {
                    $this->flashSession->success("le groupe de contact a &eacute;t&eacute; supprim&eacute; avec succ&egrave;");
                    $this->response->redirect("contact/newContact");
                   
                } else {
                    $this->flashSession->error("le groupe de contact que vous &eacute;ssayez de supprim&eacute; a &eacute;chou&eacute;");
                   $this->response->redirect("contact/newContact");
                    
                }
            }
            
            
        }
        if ($this->request->isAjax()) {
            $reponse = ["success" => false, "msg" => null];
            $id = $this->request->get('id');
            $groupe = groupe::findFirstByIdgroupe($id);
            if ($groupe == TRUE) {
                $membres = contact::find(["idgroupe=:val:", "bind" => ["val" => $groupe->idgroupe]]);
                if ($membres) {
                    foreach ($membres as $mb) {
                        $del = $mb->delete();
                    }
                }
                if ($groupe->delete()) {
                    $reponse["msg"] = "le groupe a &eacute;t&eacute; supprimer avec succ&egrave;s";

                    $reponse["success"] = true;
                } else {
                    $reponse["msg"] = "echec de suppression";
                }
            }
            return json_encode($reponse);
        }
    }
    
    /*
     * gestions des contacts
     */

    public function mesContactsAction()
    {
        $contacts = contact:: find();
        $this->view->contacts = $contacts;
        $this->view->page = "contact";
    }

    public function updateAction()
    {
        $id = $this->request->get('id');
        if (!(int) $id) {
            return $this->response->redirect('contact/newContact');
        }

        $oldContact = contact::findFirstById($id);
        if ($oldContact == FALSE) {
            return $this->response->redirect('contact/newContact');
        }
        $this->view->contact = ($oldContact) ? $oldContact : [];

        if ($this->request->isPost()) {
            $fulname = $this->request->getPost("fulname");
            $mobile = $this->request->getPost("mobile");
            $email = $this->request->getPost("email");
            $groupe = $this->request->getPost("groupid");
            //die(print_r($groupe));
            if (empty($fulname)) {
                $this->flashSession->error("Veuillez entrer le nom d&apos utilisateur");
            } elseif (empty($mobile)) {
                $this->flashSession->error("Veuillez renseigner le numero du client");
            } elseif (empty($email)) {
                $this->flashSession->error("Veuillez renseigner le mail du client");
            } elseif (!(int) $mobile) {
                $this->flashSession->error("Le numero ne peut &ecirc;tre une chaine de caractere");
            } elseif ((strlen($mobile) < 8)) {
                $this->flashSession->error("Veuillez renseigner un numero correcte");
            } else {

                $oldContact->setFulname($fulname);
                $oldContact->setMobile($mobile);
                $oldContact->setEmail($email);
                $oldContact->setIdgroupe($groupe);
                $oldContact->setIduser($this->session->get('userid'));
                if ($oldContact->update()) {
                    $this->flashSession->success("Enregistrement avec succ&egrave;s");
                } else {
                    $this->flashSession->error("L&apos; enregistrement a echou&eacute;");
                }
            }
        }
        $groupes = groupe::find();
        $this->view->groupes = $groupes;
        $this->view->page = "contact";
    }

    public function deleteAction()
    {
        $id = $this->request->get('id');
        if (!(int) $id) {
            return $this->response->redirect('contact/newContact');
        }
        $oldContact = contact::findFirstById($id);
        if ($oldContact) {
            if ($oldContact->delete()) {
                $this->flashSession->success("suppression r&eacute;ussir");
            } else {
                $this->flashSession->error("Echec de la suppression");
            }
            return $this->response->redirect("contact/mesContacts");
        }
        $this->response->redirect("contact/newContact");
        $this->view->page = "contact";
    }
}
