<?php
/**
 * The Cuploadify Component class.
 * This script will take care of uploading the files specified by the uploadify DOM element.
 * If a session_id was specified in the uplaodified element, this component will also be responsible
 * for switching over to said session.
 *
 * @copyright Copyright 2011, AM05, inc. (http://am05.com)
 * @author Amos Chan <amos.chan@chapps.org>
 * @since Cuploadify v 1.0
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class CuploadifyComponent extends Object {
    /**
     * The instantiating controller.
     *
     * @var boolean
     * @access public
     */
    var $controller;

    /**
     * Switches the session to the session_id sepcified from request.
     *
     * @param object $controller Instantiating controller
     * @param array $settings Configuration settings
     * @return void
     */
    function initialize(&$controller, $settings=array()) {
        $this->controller = $controller;
        CakeLog::write("debug", "intializing cuploadify component..."); 
        if (isset($_REQUEST["session_id"])) {
            CakeLog::write("debug", "session found.."); 
            $session_id = $_REQUEST["session_id"];
            $this->controller->Session->id($session_id);
            CakeLog::write("debug", "session switched: $session_id"); 
        }
    }

    /** Uploads data specified by the uploadify DOM element. */
    function upload() {
        error_log("uploading");
        if (!empty($_FILES)) { $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
            error_log("target path: $targetPath");
            $targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
            
            // $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
            // $fileTypes  = str_replace(';','|',$fileTypes);
            // $typesArray = split('\|',$fileTypes);
            // $fileParts  = pathinfo($_FILES['Filedata']['name']);
            
            // if (in_array($fileParts['extension'],$typesArray)) {
                // Uncomment the following line if you want to make the directory if it doesn't exist
                // mkdir(str_replace('//','/',$targetPath), 0755, true);
                
                move_uploaded_file($tempFile,$targetFile);
                echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
            // } else {
            // 	echo 'Invalid file type.';
            // }
        }
    }
}
