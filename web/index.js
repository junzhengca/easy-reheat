function upload(){
  document.getElementById("input").click();
}

function change(){
    $(".button").addClass('animated bounceOut');
    // get rid of old page content
    setTimeout(function(){
        $("#loading-block").fadeIn();
        document.getElementById("block2").style.display = "none";

        // send the image to the server when the user inputs a file
        image_to_base64("input", function(base64){
            // process the server response and display it
            food = new MicrowaveFood(base64, function(food){
                $("#loading-block").fadeOut();
                if(food !== false){
                    food.get_tags(function(data){
                        console.log(data.score);
                        new_html = "Based on our sophisticated scientific algorithm, your dish may contain ...<br>";
                        for (i=0; i<data.score.length; i++){
                            new_html += "<span class='label label-default'>" + tags[i][0] + "</span>"
                        }
                        new_html += "<br><br>Microwave Time: " + data.total_cook_time + "<br>" + "Cal: " + food.how_much_cal().toString();
                        document.getElementById("block3").innerHTML = new_html;
                    });
                } else {
                    new_html = "Failed to upload image";
                    document.getElementById("block3").innerHTML = new_html;
                }

            });
        });
    }, 500);
}
