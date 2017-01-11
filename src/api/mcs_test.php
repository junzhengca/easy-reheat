<?php
    include "../config.php";
    include "include/MicrosoftCognitiveServices.php";
    //phpinfo();
    // Only execute if dev mode is true
    if(\EasyReheat\GlobalConfig::$dev_mode){
        $cv = new \MicrosoftCognitiveServices\ComputerVision("ede4019e77124fa495407438f3e2c9d4");
        $result = $cv->analyze(
            \MicrosoftCognitiveServices\CVVisualFeatures::$tags,
            \MicrosoftCognitiveServices\CVDetails::$none,
            \MicrosoftCognitiveServices\CVLanguage::$english,
            "http://nitzapizza.com/wp-content/uploads/2011/07/maxresdefault-1.jpg"
        );
        print_r($result);
    }

?>
