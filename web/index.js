function upload(){
  document.getElementById("input").click();
}

var img_uuid = null;

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
                img_uuid = food.img_url;
                $("#loading-block").fadeOut();
                if(food !== false){
                    var food = food;
                    food.get_tags(function(data){
                        console.log(data.score);
                        if(data.warning){
                            $("#warning-container").fadeIn();
                        }
                        new_html = "<span class='mic-time'>Suggested Microwave Time: " + data.total_cook_time + " Seconds.</span><br>" + "Appox. Calories: " + data.total_cal + "<br><br>";
                        new_html += "<img src='../api/images/" + food.img_url + "' /><br><br>";
                        new_html += "Based on our sophisticated scientific algorithm, your dish may contain ...<br>";
                        for (i=0; i<data.score.length; i++){
                            new_html += "<span class='label label-default'>" + data.score[i][0] + "</span>"
                        }
                        new_html += "<br><br><div class='row'><div class='col-md-4'><button onclick='feedback(1);' class='vote-button'><i class='fa fa-snowflake-o' aria-hidden='true'></i> Too Cold</button></div>"
                        new_html += "<div class='col-md-4'><button onclick='feedback(2);' class='vote-button'><i class='fa fa-thumbs-up' aria-hidden='true'></i> Perfect</button></div>"
                        new_html += "<div class='col-md-4'><button onclick='feedback(3);' class='vote-button'><i class='fa fa-fire' aria-hidden='true'></i> Too Hot</button></div></div>"
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

function feedback(){
    alert("Thanks for your feedback!");
    if(1){
        $.ajax({
            url:"../api/access_point.php?action=train&uuid=" + img_uuid + "&method=down",
            type:"GET",
            success:function(){window.location.reload();},
            error:function(){window.location.reload();console.log("failed to train");}
        });
    } else if (3){
        $.ajax({
            url:"../api/access_point.php?action=train&uuid=" + img_uuid + "&method=up",
            type:"GET",
            success:function(){window.location.reload();},
            error:function(){window.location.reload();console.log("failed to train");}
        });
    }
}


$(function(){
    $(".vote-button").click(function(){
        alert("Thanks for your feedback!");
        window.location.reload();
    });
})
