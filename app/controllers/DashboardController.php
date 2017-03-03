<?php
use Phalcon\Mvc\Controller;

class DashboardController extends Controller
{

    public function initialize()
    {
        $this->view->setMainView('board');
        $this->tag->setTitle('dashboard');
        //parent::initialize();
        $corbeilles = corbeille:: find(['order' => ' idcorb DESC']);
        $this->view->corbeilles = ($corbeilles) ? $corbeilles : [];
    }

    public function indexAction()
    {
        $logs = recentActivity::find(['order' => ' id DESC','limit'=>8]);
        $folders = dossier::find();
        $files = fichier::find(["type='1'"]);
        $zip = fichier::find(["type='2'"]);

        $this->view->logs = $logs;
        $this->view->folders = $folders;
        $this->view->files = $files;
        $this->view->zip = $zip;
    }
    /*
     * gestion de la corbeille
     */

    public function corbeilleAction()
    {
        $corbeilles = corbeille:: find(['order' => ' idcorb DESC']);
        $this->view->corbeilles = ($corbeilles) ? $corbeilles : [];
    }
    /*
     * paramètre de configuration
     */

    public function settingsAction()
    {
        "<h1>hello</h1>";
    }
    
    
    /*
     * personnalisation du profile par l'utilisateur
     */
    
    public function profileAction()
    {
          $profils = profile::find();
        $this->view->profils = $profils;

        $id = $this->request->get('id');
        ((int) $id) ? $id = $this->request->get('id') : $this->response->redirect("dashboard/index");

        $users = user::findFirstByIduser($id);
        if($users == FALSE){
             return ;// $this->response->redirect('profile/newUser');
        }
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
         //$this->view->page = "permission";
    }

    /*
     * modification du mot de passe
     */
    
      public function passAction()
    {

        $id = $this->request->get('id');
        ((int) $id) ? $id = $this->request->get('id') : $this->response->redirect("dashboard/index");
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
                            $this->response->redirect("dashboard/profile?id=" . $id);
                        }
                    } else {
                        $this->flashSession->success("l&apos;ancien mot de passe est incorrect");
                         $this->response->redirect("dashboard/profile?id=" . $id);
                    }
                } else {
                    $this->flashSession->error("les mot de passe ne sont pas conforme");
                     $this->response->redirect("dashboard/profile?id=" . $id);
                }
            } else {
                /*
                 * a renvoyer sur une page 404 erreur specifique au programme
                 */
               $this->response->redirect("dashboard/index");
            }
        }
         //$this->view->page = "permission";
    }
    
    
    
    
    /*
     * suppression de la corbeille
     */
    
    
    public function deleteCorbeilleAction()
    {
        $id = $this->request->get('id');
        if (!(int) $id) {
            return $this->response->redirect("Dashboard/corbeille");
        }
        $corbeille = corbeille::findFirstByIdcorb($id);
        if ($corbeille == TRUE) {
            if ($corbeille->delete()) {
                $this->flashSession->success("supression reussit");
            } else {
                $this->flashSession->error("Echec de supression");
            }
        }
        return $this->response->redirect("Dashboard/corbeille");
    }

    /*
     * supprimer plusieurs donnée de la corbeille
     */
    public function dropDrashAction()
    {
        if ($this->request->isPost()) {
            $allId = $this->request->getPost("allCheck");
            $taille = sizeof($allId);
            $i = 0;
            foreach ($allId as $id) {
                $corbeille = corbeille::findFirstByIdcorb($id);
                if ($corbeille) {
                    $corbeille->delete();
                    $i++;
                }
            }
//            if($i == $taille){
//                
//            }
            return $this->response->redirect("Dashboard/corbeille");
        }
    }
/*
 * vider la corbeille
 */
    public function formatCorbeilleAction()
    {
        $corbeilles = corbeille::find();
        $taille = sizeof($corbeilles);
        if (!$this->request->isAjax()) {
            if ($corbeilles) {
                $i = 0;
                foreach ($corbeilles as $corb) {
                    $corb->delete();
                    $i++;
                }
                if ($taille == $i) {
                    return $this->response->redirect("Dashboard/corbeille");
                }
            }
        }
        if ($this->request->isAjax()) {
            $reponse = ["msg" => NULL, "success" => FALSE];

            if ($corbeilles) {
                $i = 0;
                foreach ($corbeilles as $corb) {
                    $corb->delete();
                    $i++;
                }
                if ($taille == $i) {
                    $reponse['msg'] = "Un nouveau groupe a ete creer avec succes";
                    $reponse["success"] = true;
                }
            }
            return json_encode($reponse);
        }
    }
    
    
    
    
}
