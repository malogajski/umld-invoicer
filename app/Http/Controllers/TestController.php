<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ZipArchive;

class TestController extends Controller
{
    public function demo(Request $request)
    {

        return $request;
    }

    public function test()
    {
        return view('test');
    }

    public function index(Request $request)
    {
        // Get Project path
        define('_PATH', dirname(__FILE__));
        // Unzip path
        $path = _PATH . "/images/";

        // Unzip selected zip file
        if (isset($_POST['unzip'])) {
            $filename = $_FILES['file']['name'];

            // Get file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $valid_ext = array('zip');

            // Check extension
            if (in_array(strtolower($ext), $valid_ext)) {
                $tmp_name = $_FILES['file']['tmp_name'];

                $zip = new ZipArchive;
                $res = $zip->open($tmp_name);
                if ($res === TRUE) {

                    // Extract file
                    if ($zip->extractTo($path)) {
                        unset($_FILES['file']);
                        echo '<script>';
                        echo 'alert("File [' . $filename . '] successfully uploaded")';
                        echo 'alert("File [' . $path . '] successfully uploaded")';
                        echo '</script>';

                        $this->delTree($path . '__MACOSX');
                    } else {
                        echo '<script>';
                        echo 'alert("File NOT uploaded!")';
                        echo '</script>';
                    }
                    $zip->close();

                } else {
                    echo 'failed!';
                }
            }
        }
//        return back();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function delTree($dir): bool
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

}
