<?php
/**
 * Created by PhpStorm.
 * User: Rana
 * Date: 4/21/2016
 * Time: 6:14 PM
 */

namespace App\Controller\Component;


use Cake\Controller\Component;

class FileUploadComponent extends Component
{

    public function upload_file($file, $path = null, $validation = ['jpg', 'png'])
    {
        /*echo "<pre>";
        print_r($file);
        echo "</pre>";
        die;*/
        $base_upload_path = WWW_ROOT;
        $result = array();
        if (isset($file) && ($file['error'] == 0) ) {
            $ext=explode(".", $file["name"]);
            if(in_array(strtolower(end($ext)),$validation)){
                $tmp_name = $file["tmp_name"];
                $name = time() . '_' . str_replace(' ', '_', $file['name']);
                if ($path) {
                    if (!file_exists($path)) {
                        mkdir($path, 777, true);
                    }
                    $name = $path . '/' . $name;
                }
                if (move_uploaded_file($tmp_name, $base_upload_path . '/' . $name)) {
                    $result['status'] = true;
                    $result['file_path'] = $name;
                    return $result;
                } else {
                    $result['status'] = false;
                    $result['message'] = 'Failed to upload';
                    return $result;
                }
            }else{
                $result['status'] = false;
                $result['message'] = 'Invalid file type';
                return $result;
            }

        } else {

            $result['status'] = false;
            return $result;
        }

    }
}