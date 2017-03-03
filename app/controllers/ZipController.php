<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of ZipController
 *
 * @author karth solution
 */
use Phalcon\Mvc\Controller;

class ZipController extends controller
{

    public function getActivites($param, $userid) {
        $activity = new recentActivity();
        $activity->activite = $param;
        $activity->date = time();
        $activity->iduser = $userid;
        $activity->save();
    }
    
    public function initialize()
    {
        $this->view->setMainView('board');
        $this->tag->setTitle('Bienvenue');
        $corbeilles = corbeille:: find(['order' => ' idcorb DESC']);
        $this->view->corbeilles = ($corbeilles) ? $corbeilles : [];
        //parent::initialize();
    }

    public function indexAction()
    {
        
    }

    public function newArchiveAction()
    {
        $iduser = $this->session->get('userid');
         $pseudo = $this->session->get('pseudo');
        if ($this->request->isPost()) {
            if ($this->request->hasFiles() == true) {
                $descfile = $this->request->getPost("descfile");
                $uploaddocs = $this->request->getUploadedFiles();
                $isuploads = false;
                foreach ($uploaddocs as $upload) {
                    $extension = new SplFileInfo($upload->getName());
                    $type = $extension->getExtension();
                    if (in_array(strtolower($type), ['zip', 'rar'])) {
                        $path = $this->rootfile . $upload->getName();
                        $isuploads = $upload->moveTo($path);
                        $valeurdocument[] = $upload->getName();
                        $tabExt[] = $type;
                        $tabTaille[] = $upload->getSize();
                    }
                }

                //die(print_r($tabExt));

                if (!empty($valeurdocument)) {
                    $nbre = count($valeurdocument);
                    foreach ($valeurdocument as $keya => $value) {

                        $newFolder = new fichier();
                        $newFolder->description = $descfile[$keya];
                        $newFolder->nomfile = $value;
                        $newFolder->date = time();
                        $newFolder->extension = $tabExt[$keya];
                        $newFolder->taille = $tabTaille[$keya];
                        $newFolder->type = "2"; // type zip
                        $newFolder->iduser = $iduser;
                        $newFolder->save();
                        $i++;
                    }
                    if ($i == $nbre) {
                         $this->getActivites($pseudo." a ajouter un archive",$iduser);
                        $this->flashSession->success("Le document a &eacute;t&eacute; creer avec succ&egrave;s");
                    } else {
                        $this->flashSession->error("Le document que vous essayez de creer a echou&eacute;");
                    }
                } else {
                    $this->flashSession->error("D&eacute;sol&eacute;. Le format du fichier n&apos;est pas valide");
                }
            }
        }
        $fichiers = fichier::find(["iddos=:idd: and type=:val: order by idfile DESC", "bind" => ["idd" => '0', "val" => '2']]);
        $this->view->fichiers = ($fichiers) ? $fichiers : [];
    }

    public function deleteFileAction()
    {
         $iduser = $this->session->get('userid');
         $pseudo = $this->session->get('pseudo');
        $id = $this->request->get('id');
        if (!(int) $id) {
            return $this->response->redirect('zip/newArchive');
        }
        $docFiles = fichier::findFirst(["idfile =?0", "bind" => [$id]]);
        if ($docFiles == TRUE) {
            $corb = new corbeille();
            $corb->nomfile = $docFiles->nomfile;
            $corb->description = $docFiles->description;
            $corb->typefile = $docFiles->extension;
            $corb->taille = $docFiles->taille;
            $corb->date = $docFiles->date;
            $corb->iduser = $docFiles->iduser;
            $corb->iddos = $docFiles->iddos;
            $corb->save();
            if ($docFiles->delete()) {
                $this->getActivites($pseudo." a supprimer un fichier",$iduser);
                $this->flashSession->success("Le fichier a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s");
            }
        }
        return $this->response->redirect("zip/newArchive");
    }

    public function updateZipAction()
    {
        $iduser = $this->session->get('userid');
         $pseudo = $this->session->get('pseudo');
        $id = $this->request->get('id');
        if (!(int) $id) {
            return $this->response->redirect('file/newArchive');
        }
        if ($this->request->isPost()) {
            // if ($this->request->hasFiles() == true) {
            $descfile = $this->request->getPost("descfile");

            if ($this->request->hasFiles() == true) {

                $uploads = $this->request->getUploadedFiles();
                $idf = $this->request->get('id');
                $docFile = fichier::findFirst(["idfile =?0", "bind" => [$idf]]);
                
                $isuploads = false;
                foreach ($uploads as $upload) {

                    $extension = new SplFileInfo($upload->getName());
                    $type = $extension->getExtension();

                    if (in_array(strtolower($type), ['zip', 'rar', ''])) {
                        $path = $this->rootfile . $upload->getName();
                        $isuploads = $upload->moveTo($path);

                        if (empty($upload->getName())) {
                            $filname = $docFile->nomfile;
                            $taille= $docFile->taille;
                        } else {
                            $filname = $upload->getName();
                            $taille= $upload->getSize();
                        }
                    } else {
                        $this->flashSession->error("Le format du fichier non valide");
                    }
                }
            }







            $docFile->description = $descfile;
            $docFile->nomfile = $filname; //sizeof($uploaddocs) > 0 ? $upload->getName() : $docFile->nomfile;
            $docFile->date = time();
            $docFile->extension = empty($type) ? $docFile->extension : $type;
            $docFile->taille = $taille;
            $docFile->iduser = $iduser;
            $docFile->type = "2"; // type file
            if ($docFile->update()) {
                //$this->getActivites($pseudo." a modifier un fichier",$iduser);
                $this->flashSession->success("Le fichier a &eacute;t&eacute; mise &agrave; jour avec succ&egrave;s");
            } else {
                $this->flashSession->error("Echec de la mise &agrave; jour du fichier");
            }
        }
        $docFile = fichier::findFirst(["idfile =?0", "bind" => [$id]]);
        if ($docFile == TRUE) {
             $this->getActivites($pseudo." a modifier un fichier",$iduser);
            $this->view->docFile = $docFile;
        } else {
            return $this->response->redirect("file/newArchive");
        }
    }
}
