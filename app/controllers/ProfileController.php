<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of ProfileController
 *
 * @author karth solution
 */
use Phalcon\Mvc\Controller;

class ProfileController extends Controller
{

    public function initialize()
    {
        $this->view->setMainView('board');
        $this->tag->setTitle('Bienvenue');
    }

    public function indexAction()
    {
        
    }

    public function newProfileAction()
    {
        $profils = profile::find();
        $this->view->profils = ($profils)? $profils :[];

        if ($this->request->isPost()) {

            $nom = $this->request->getPost("profile");
            $config = implode(",", $this->request->getPost("config"));

            $newProfile = new Profile();
            $newProfile->setNomprofile($nom);
            $newProfile->setPermission($config);
            if ($newProfile->save()) {
                $this->flashSession->success("le profil a ete creer avec succes");
                $this->response->redirect("profile/newProfile");
            } else {
                $this->flashSession->warning("le profil que vous tentez de creer a échouer  ");
                $this->response->redirect("profile/newProfile");
            }
        }
    }

    public function updateAction()
    {
        $id = $this->request->get("id");
        ((int) $id) ? $id = $this->request->get('id') : $this->response->redirect("profile/newProfile");

        $profil = profile::findFirstByIdprofile($id);
        $this->view->profil = ($profil) ? $profil : [];

        if ($this->request->isPost()) {
            $nom = $this->request->getPost("profile");
            $config = implode(",", $this->request->getPost("config"));

            $profil->setNomprofile($nom);
            $profil->setPermission($config);
            if ($profil->update()) {
                $this->flashSession->success("le profil a ete mise a jour avec succe");
            } else {
                $this->flashSession->warning("la mise a jour du profile a echouer   ");
            }
        }
    }

    public function deleteAction()
    {
        $id = $this->request->get("id");
        ((int) $id) ? $id = $this->request->get('id') : $this->response->redirect("profile/newProfile");
        $profil = profile::findFirstByIdprofile($id);

        if ($profil) {
            if ($profil->delete()) {
                $this->response->redirect("profile/newProfile");
            }
        }
    }

    public function newUserAction()
    {
        $profils = profile::find();
        $this->view->profils = ($profils) ? $profils : [];

        $users = user::find();
        $this->view->users = ($users) ? $users : [];

        if ($this->request->isPost()) {
            $nom = $this->request->getPost("nom");
            $pseudo = $this->request->getPost("pseudo");
            $mail = $this->request->getPost("mail");
            $idprofile = $this->request->getPost("profil");
            $pwda = $this->request->getPost("passworda");
            $pwdb = $this->request->getPost("passwordb");
            $actif = ($this->request->getPost("actif") ? "1" : "0");
            if (empty($nom)) {
                $this->flashSession->error("Veuillez saisir le nom de l utilisateur");
                $this->response->redirect("profile/newUser");
            } elseif (empty($pseudo)) {
                $this->flashSession->error("Veuillez saisir le prenom de l utilisateur");
            } elseif (empty($mail)) {
                $this->flashSession->error("Veuillez saisir le nom de l utilisateur");                
            } elseif (empty($pwda)) {
                $this->flashSession->error("Veuillez entrer un mot de passe");             
            } elseif ($pwda != $pwdb) {
                $this->flashSession->error("Mot de passe non conforme");
                $this->response->redirect("profile/newUser");
            } else {
                $newUser = new user();

                $newUser->setFulname($nom);
                $newUser->setPseudo($pseudo);
                $newUser->setEmail($mail);
                $newUser->setIdprofile($idprofile);
                $newUser->setPassword(sha1($pwda));
                $newUser->setActif($actif);

                if ($newUser->save()) {
                    $this->flashSession->success("Utilisateur creer avec succes");
                    $this->response->redirect("profile/newUser");
                } else {
                    $this->flashSession->error("L utilisateur que vous tentez de creer a echouer");
                }
            }
        }
    }

    public function updateUserAction()
    {
        $profils = profile::find();
        $this->view->profils = $profils;

        $id = $this->request->get('id');
        ((int) $id) ? $id = $this->request->get('id') : $this->response->redirect("profile/newUser");

        $users = user::findFirstByIduser($id);
        $this->view->users = ($users) ? $users : [];

        if ($this->request->isPost()) {
            $nom = $this->request->getPost("nom");
            $pseudo = $this->request->getPost("pseudo");
            $mail = $this->request->getPost("mail");
            $idprofile = $this->request->getPost("profil");
            $pwda = $this->request->getPost("passworda");
            $pwdb = $this->request->getPost("passwordb");
            $actif = ($this->request->getPost("actif") ? "1" : "0");
            if (empty($nom)) {
                $this->flashSession->error("Veuillez saisir le nom de l utilisateur");
            } elseif (empty($pseudo)) {
                $this->flashSession->error("Veuillez saisir le prenom de l utilisateur");
            } elseif (empty($mail)) {
                $this->flashSession->error("Veuillez saisir le nom de l utilisateur");
            } else {
                if ($users) {
                    $users->setFulname($nom);
                    $users->setPseudo($pseudo);
                    $users->setEmail($mail);
                    $users->setIdprofile($idprofile);
                    //$users->setPassword(sha1($pwda));
                    $users->setActif($actif);
                }
                if ($users->save()) {
                    $this->flashSession->success("Le profile utilisateur a ete modifier avec succes");
                } else {
                    $this->flashSession->error("L utilisateur que vous tentez de creer a echouer");
                }
            }
        }
    }

    public function passAction()
    {

        $id = $this->request->get('id');
        ((int) $id) ? $id = $this->request->get('id') : $this->response->redirect("profile/newUser");
        // die(print_r("-----------".$id));
        $user = user::findFirstByIduser($id);
        if ($this->request->isPost()) {
            $newpass = $this->request->getPost("newpass");
            $confirm = $this->request->getPost("confirmpass");
            $lastpass = $this->request->getPost("lastpass");

            if ($user == TRUE) {
                if ($newpass == $confirm) {
                    if (sha1($lastpass) == $user->password) {
                        $user->setPassword(sha1($newpass));
                        if ($user->save()) {
                            $this->flashSession->success("le mot de passe de l utilisateur a ete changer avec succes");
                            $this->response->redirect("profile/updateUser?id=" . $id);
                        }
                    } else {
                        $this->flashSession->success("l ancien mot de passe est incorrect");
                        $this->response->redirect("profile/updateUser?id=" . $id);
                    }
                } else {
                    $this->flashSession->error("les mot de passe ne sont pas conforme");
                    $this->response->redirect("profile/updateUser?id=" . $id);
                }
            } else {
                /*
                 * a renvoyer sur une page 404 erreur specifique au programme
                 */
                $this->response->redirect("profile/newUser");
            }
        }
    }
    
    
    public function deleteUserAction()
    {
        $id = $this->request->get("id");
        ((int) $id) ? $id = $this->request->get('id') : $this->response->redirect("profile/newUser");
        $user = user::findFirstByIduser($id);

        if ($user) {
            if ($user->delete()) {
                $this->response->redirect("profile/newUser");
            }
        }
    }
}
