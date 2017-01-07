function upload(){
  document.getElementById("input").click();
}

function test(){
  // send the image to the server when the user inputs a file
  image_to_base64("input", function(base64){

    // process the server response and display it
    food = new MicrowaveFood(base64, function(food){

      new_html="";

      if(food !== false){
        new_html = "Microwave Time: " + food.how_long().toString() + "\n" +
              "Cal: " + food.how_much_cal().toString());
      } else {
        new_html = "Failed to upload image";
      }

      document.getElementById("block3").innerHTML = new_html;

    });

  });
}
