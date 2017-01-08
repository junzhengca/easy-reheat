<?php
//http://localhost/usb/microwave-time/api/?action=upload_image
    // error_reporting(E_ALL);

    // Helper function to generate a v4 UUID
    function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    // Convert base64 string to image file
    function base64_to_image($base64_string, $output_file) {
        if(true){ //base64_get_extension($base64_string)
            $ifp = fopen($output_file, "wb");
            $data = explode(',', $base64_string);
            fwrite($ifp, base64_decode($data[1]));
            fclose($ifp);
            return true;
            } else {
            return false;
        }
    }

    include "include/app.php";

    $app = new App();

    $app->add("upload_image", function(){
        $targetDir = "images/";
        $targetFile = gen_uuid();
        if(base64_to_image($_POST["file"], $targetDir . $targetFile)){
            $res = shell_exec("python3 ../checking.py 'http://52.229.117.35/microwave-time/api/" . $targetDir . $targetFile . "' 2>&1");
            echo $targetFile;
            $res = explode("\n", $res);
            $json = array();
            if($res[0] == "0"){
                $json["warning"] = false;
            } else {
                $json["warning"] = true;
            }
            $json["score"] = array();
            for ($i = 1; $i <= max(array_keys($res)); $i++){
                array_push($json["score"], $arr=preg_split("/\s+(?=\S*+$)/",$str));
            }
            file_put_contents($targetDir . $targetFile . ".json", json_encode($json));
        } else {
            echo "500";
        }
    });

    $app->add("score_image", function(){

    });

    $app->add("food_info", function(){

    });

    $app->route($_GET["action"]);
?>
