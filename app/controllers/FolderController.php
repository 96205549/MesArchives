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
        $corbeilles = corbeille:: find(['order' => ' idcorb DESC']);
        $this->view->corbeilles = ($corbeilles) ? $corbeilles : [];
        //parent::initialize();
    }

     public function getActivites($param, $userid) {
        $activity = new recentActivity();
        $activity->activite = $param;
        $activity->date = time();
        $activity->iduser = $userid;
        $activity->save();
    }
    
    public function indexAction()
    {
        
    }
    /*
     * create new folder 
     */

    public function newFolderAction()
    {
        $iduser = $this->session->get('userid');
        $pseudo = $this->session->get('pseudo');
        if ($this->request->isPost()) {
            if ($this->request->hasFiles() == true) {
                $folder = $this->request->getPost("foldername");
                $descfile = $this->request->getPost("descfile");
                $uploaddocs = $this->request->getUploadedFiles();
                //die(print_r($uploaddocs));
                if (empty($folder)) {
                    $this->flashSession->error("Veuillez renseigner le nom du dossier");
                }
                $newDossier = new dossier();
                $newDossier->nomdos = $folder;
                $newDossier->date = time();
                $newDossier->iduser = $iduser;


                if ($newDossier->save()) {
                    $isuploads = false;
                    foreach ($uploaddocs as $upload) {
                        $extension = new SplFileInfo($upload->getName());
                        $type = $extension->getExtension();
                        if (!in_array(strtolower($type), ['mp3', 'mp4', 'mov', 'flv'])) {
                            $path = $this->rootfile . $upload->getName();
                            $isuploads = $upload->moveTo($path);
                            $valeurdocument[] = $upload->getName();
                        }
                    }

                    // die(print_r($descfile));

                    if (!empty($valeurdocument)) {
                        $nbre = count($valeurdocument);
                        foreach ($valeurdocument as $keya => $value) {
                            foreach ($descfile as $keyb => $file) {
                                if ($keya == $keyb) {
                                    $newFolder = new fichier();
                                    $newFolder->description = $file;
                                    $newFolder->nomfile = $value;
                                    $newFolder->iddos = $newDossier->iddos;
                                    $newFolder->date = time();
                                    $newFolder->iduser = $iduser;
                                    $newFolder->save();
                                }
                            }
                            $i++;
                        }
                        if ($i == $nbre) {
                            $this->getActivites($pseudo." a ajouter le dossier ".$folder,$iduser);
                            $this->flashSession->success("Le document a &eacute;t&eacute; creer avec succ&egrave;s");
                        } else {
                            $this->flashSession->error("Le document que vous essayez de creer a echou&eacute;");
                        }
                    } else {
                        $this->flashSession->error("D&eacute;sol&eacute;. Le format du fichier n&apos;est pas valide");
                    }
                }
            }
        }
        $dossiers = dossier::find(['order' => 'iddos DESC']);
        $this->view->dossiers = ($dossiers) ? $dossiers : [];
        $this->view->page = "folder";
    }
    /*
     * folder listes
     */

    public function mesFoldersAction()
    {
        $dossiers = dossier::find(['order' => 'iddos DESC']);
        $this->view->dossiers = ($dossiers) ? $dossiers : [];
        $this->view->page = "folder";
    }
    /*
     * open folder
     */

    public function openFolderAction()
    {
        $id = $this->request->get('id');
        if (!(int) $id) {
            return $this->response->redirect('folder/newFolder');
        } else {
            $doc= dossier::findFirstByIddos($id);
            if($doc){
            $docFiles = fichier::find(["iddos=:iddos: order by idfile DESC", "bind" => ["iddos" => $id,]]);
            $dossier = dossier::findFirstByIddos($id);
            $this->view->dossier = ($dossier) ? $dossier : [];
            $this->view->docFiles = ($docFiles) ? $docFiles : [];
            }else{
                 $this->response->redirect("folder/newFolder");          
            }
        }
        $this->view->page = "folder";
    }
    /*
     * add file to openfolder
     */

    public function addFileAction()
    {
        $iduser = $this->session->get('userid');
        $pseudo = $this->session->get('pseudo');
        if ($this->request->isPost()) {
            if ($this->request->hasFiles() == true) {
                $iddos = $this->request->getPost("iddos");
                $folder = $this->request->getPost("foldername");
                $descfile = $this->request->getPost("descfile");
                $uploaddocs = $this->request->getUploadedFiles();

                if (empty($folder)) {
                    $this->flashSession->error("Veuillez renseigner le nom du dossier");
                }
                $newDossier = dossier:: findFirstByIddos($iddos);
                $newDossier->nomdos = $folder;
                $newDossier->date = time();
                $newDossier->iduser = $iduser;

                if ($newDossier->update()) {
                    $isuploads = false;
                    foreach ($uploaddocs as $upload) {
                        $extension = new SplFileInfo($upload->getName());
                        $type = $extension->getExtension();
                        if (!in_array(strtolower($type), ['mp3', 'mp4', 'mov', 'flv'])) {
                            $path = $this->rootfile . $upload->getName();
                            $isuploads = $upload->moveTo($path);
                            $valeurdocument[] = $upload->getName();
                        }
                    }

                    if (!empty($valeurdocument)) {
                        $nbre = count($valeurdocument);
                        foreach ($valeurdocument as $keya => $value) {
                            foreach ($descfile as $keyb => $file) {
                                if ($keya == $keyb) {
                                    $newFolder = new fichier();
                                    $newFolder->description = $file;
                                    $newFolder->nomfile = $value;
                                    $newFolder->iddos = $newDossier->iddos;
                                    $newFolder->date = time();
                                    $newFolder->iduser = $iduser;
                                    $newFolder->save();
                                }
                            }
                            $i++;
                        }
                        if ($i == $nbre) {
                            $this->getActivites($pseudo." a ajouter a ajouté des fichiers au dossier ".$folder,$iduser);
                            $this->flashSession->success("Le document a &eacute;t&eacute; creer avec succ&egrave;s");
                        } else {
                            $this->flashSession->error("Le document que vous essayez de creer a echou&eacute;");
                        }
                    } else {
                        $this->flashSession->error("D&eacute;sol&eacute;. Le format du fichier n&apos;est pas valide");
                    }
                }
            }

            $this->response->redirect("folder/openFolder?id=" . $iddos);
            $this->view->page = "folder";
        }
    }
    /*
     * delete folder
     */

    public function deleteFolderAction()
    {
        $iduser = $this->session->get('userid');
        $pseudo = $this->session->get('pseudo');
        $id = $this->request->get('id');
        $allFiles = fichier::find(["iddos=:idd:", "bind" => ["idd" => $id]]);
        if ($allFiles) {
            foreach ($allFiles as $value) {
                $corbeil = new corbeille();
                $corbeil->nomfile = $value->nomfile;
                $corbeil->description = $value->description;
                $corbeil->iddos = $value->iddos;
                $corbeil->date = $value->date;
                $corbeil->iduser = $value->iduser;
                $corbeil->save();
                $value->delete();
            }
            $doc = dossier::findFirstByIddos($id);
        }
        $corb = new corbeille();
        $corb->description = $doc->nomdos;
        $corb->date = $doc->date;
        $corb->iduser = $doc->iduser;
        $corb->iddos = $doc->iddos;
        $corb->save();
        if ($doc->delete()) {
            $this->getActivites($pseudo." a ajouter supprimé un dossier",$iduser);
            $this->flashSession->success("Le dossier a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s");
        }
        $this->response->redirect("folder/mesFolders");
        $this->view->page = "folder";
    }

   
    public function deleteFileAction()
    {
        $iduser = $this->session->get('userid');
        $pseudo = $this->session->get('pseudo');
        $id = $this->request->get('id');
        ///$id = explode("_", $val[0]);
        if (!(int) $id) {
            return $this->response->redirect('folder/mesFolders');
        }
        $docFiles = fichier::findFirst(["idfile =?0", "bind" => [$id]]);
        if ($docFiles == TRUE) {
            $idf = $docFiles->iddos;
            $corb = new corbeille();
            $corb->description = $docFiles->description;
            $corb->nomfile = $docFiles->nomfile;
            $corb->typefile = $docFiles->extension;
            $corb->taille = $docFiles->taille;
            $corb->date = $docFiles->date;
            $corb->iduser = $docFiles->iduser;
            $corb->iddos = $docFiles->iddos;
            $corb->save();
            if ($docFiles->delete()) {
                $this->getActivites($pseudo." a ajouter supprimé un fichier",$iduser);
                $this->flashSession->success("Le fichier a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s");
            }
        }
        $this->response->redirect("folder/openFolder?id=" . $idf);
        $this->view->page = "folder";
    }
    
    /*
     * modification des fichier d'un dossier
     */
    
    public function updateFileAction()
    {
        $pseudo = $this->session->get('pseudo');
        $iduser = $this->session->get('userid');
        $val = $this->request->get('id');
        $idfile = explode(".", $val)[0];
        $idfolder = explode(".", $val)[1];
        
        //die(print_r($val1.','.$val2));
        if (!(int) $idfile && !(int) $idfolder) {
            return $this->response->redirect('folder/newFolder');
        }
        if ($this->request->isPost()) {
            // if ($this->request->hasFiles() == true) {
            $descfile = $this->request->getPost("descfile");

            if ($this->request->hasFiles() == true) {

                $uploads = $this->request->getUploadedFiles();
                
                //die(print_r($idfile));
                $idf = $this->request->get('id');
                $docFile = fichier::findFirst(["idfile =?0", "bind" => [$idf]]);

                $isuploads = false;
                foreach ($uploads as $upload) {

                    $extension = new SplFileInfo($upload->getName());
                    $type = $extension->getExtension();

                    if (!in_array(strtolower($type), ['mp3', 'mp4', 'mov', 'flv'])) {
                        $path = $this->rootfile . $upload->getName();
                        $isuploads = $upload->moveTo($path);

                        if (empty($upload->getName())) {
                            $filname = $docFile->nomfile;
                        } else {
                            $filname = $upload->getName();
                        }
                    }
                }
            }







            $docFile->description = $descfile;
            $docFile->nomfile = $filname; 
            $docFile->date = time();
            $docFile->extension = empty($type) ? $docFile->extension : $type;
            $docFile->taille = empty($upload->getSize())? $docFile->taille : $upload->getSize();
            $docFile->iduser = $iduser;
            $docFile->type = "0"; // type file
            if ($docFile->update()) {
                $this->flashSession->success("Le fichier a &eacute;t&eacute; mise &agrave; jour avec succ&egrave;s");
                return $this->response->redirect("folder/updateFile?id=".$idf.'.'.$docFile->iddos);
            } else {
                $this->flashSession->error("Echec de la mise &agrave; jour du fichier");
                 return $this->response->redirect("folder/updateFile?id=".$idf.'.'.$docFile->iddos);
            }
        }
        $docFile = fichier::findFirst(["idfile =?0 and iddos=?1", "bind" => ["0"=>$idfile , "1"=>$idfolder]]);
        if ($docFile == TRUE) {
            $this->view->docFile = $docFile;
        } else {
            return $this->response->redirect("folder/newFolder");
        }
    }
    
    
}
