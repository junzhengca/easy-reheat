<?php
    namespace MicrosoftCognitiveServices;

    class CVVisualFeatures {
        public static $categories = "Categories";
        public static $tags = "Tags";
        public static $description = "Description";
        public static $faces = "Faces";
        public static $image_type = "ImageType";
        public static $color = "Color";
        public static $adult = "Adult";
    }

    class CVDetails {
        public static $celebrities = "Celebrities";
        public static $none = false;
    }

    class CVLanguage {
        public static $english = "en";
        public static $chinese = "zh";
    }

    /* Microsoft Computer Vision SDK
     * You must have an active subscription
     */
    class ComputerVision {
        public $base_url = "https://api.projectoxford.ai/vision/v1.0/";
        function __construct($key){
            $this->key = $key;
        }

        /* (CVVisualFeatures, CVDetails, CVLanguage, string)
         * Analyze an image using Microsoft Cognitive Services
         */
        function analyze($visual_features, $details, $language, $image_url){
            //open connection
            $ch = curl_init();
            $url = $this->base_url . "analyze";
            $query = "";
            if($visual_features){
                $query .= "&visualFeatures=" . $visual_features;
            }
            if($details){
                $query .= "&details=" . $details;
            }
            if($language){
                $query .= "&language=" . $language;
            }
            $query .= "&subscription-key=" . $this->key;
            ltrim($query, '&');
            $url .= "?" . $query;
            //set the url, number of POST vars, POST data
            echo $url;
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, 1);
            $request_body = json_encode(array(
                "url"=>$image_url
            ));
            curl_setopt($ch,CURLOPT_POSTFIELDS, $request_body);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return json_encode($result, true);
        }
    }
?>
