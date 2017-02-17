<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of FileController
 *
 * @author karth solution
 */
use Phalcon\Mvc\Controller;

class FileController extends controller
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

    public function newFileAction()
    {
        $iduser = $this->session->get('userid');
        if ($this->request->isPost()) {
            if ($this->request->hasFiles() == true) {
                $descfile = $this->request->getPost("descfile");
                $uploaddocs = $this->request->getUploadedFiles();
                $isuploads = false;
                foreach ($uploaddocs as $upload) {
                    $extension = new SplFileInfo($upload->getName());
                    $type = $extension->getExtension();
                    if (!in_array(strtolower($type), ['mp3', 'mp4', 'mov', 'flv'])) {
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
                        $newFolder->nomfile = $this->rootfile . $value;
                        $newFolder->date = time();
                        $newFolder->extension = $tabExt[$keya];
                        $newFolder->taille = $tabTaille[$keya];
                        $newFolder->iduser = $iduser;
                        $newFolder->save();
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
        $fichiers = fichier::find(["iddos=:idd:", "bind" => ["idd" => '0']]);
        $this->view->fichiers = ($fichiers) ? $fichiers : [];
    }

    public function deleteFileAction()
    {     
        $id = $this->request->get('id');
        if (!(int) $id) {
            return $this->response->redirect('file/newFile');
        }
        $docFiles = fichier::findFirst(["idfile =?0", "bind" => [$id]]);
        if ($docFiles == TRUE) {
            if ($docFiles->delete()) {
                $this->flashSession->success("Le fichier a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s");
            }
        }
        return $this->response->redirect("file/newFile");
    }
}
