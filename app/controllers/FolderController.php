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
    /*
     * create new folder 
     */

    public function newFolderAction()
    {
        $iduser = $this->session->get('userid');
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
                                    $newFolder->nomfile = $this->rootfile . $value;
                                    $newFolder->iddos = $newDossier->iddos;
                                    $newFolder->date = time();
                                    $newFolder->iduser = $iduser;
                                    $newFolder->save();
                                }
                            }
                            $i++;
                        }
                        if ($i == $nbre) {
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
        $dossiers = dossier::find();
        $this->view->dossiers = ($dossiers) ? $dossiers : [];
    }
    /*
     * folder listes
     */

    public function mesFoldersAction()
    {
        $dossiers = dossier::find();
        $this->view->dossiers = ($dossiers) ? $dossiers : [];
    }
    /*
     * open folder
     */

    public function openFolderAction()
    {
        $id = $this->request->get('id');
        $docFiles = fichier::find(["iddos=:iddos:", "bind" => ["iddos" => $id]]);
        $dossier = dossier::findFirstByiddos($id);
        $this->view->dossier = ($dossier) ? $dossier : [];
        $this->view->docFiles = ($docFiles) ? $docFiles : [];
    }
    /*
     * delete folder
     */

    public function deleteFolderAction()
    {
        
    }

    public function updateFileAction()
    {
        /* $id = $this->request->get('id');
          $docFiles = fichier::find();
          $this->view->dossiers = $docFiles; */
    }
    
     public function deleteFileAction()
    {     
        $id = $this->request->get('id');
        ///$id = explode("_", $val[0]);
        if (!(int) $id) {
            return $this->response->redirect('folder/mesFolders');
        }
        $docFiles = fichier::findFirst(["idfile =?0", "bind" => [$id]]);
        if ($docFiles == TRUE){ 
            $idf= $docFiles->iddos;
            if ($docFiles->delete()) {
                $this->flashSession->success("Le fichier a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s");
            }
        }
        return $this->response->redirect("folder/openFolder?id=".$idf);
    }
}
