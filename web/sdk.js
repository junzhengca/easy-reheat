// A class representing food
function MicrowaveFood(base64, callback){
    // Get microwave time
    this.how_long = function(){
        return 3;
    }

    // Get cal count
    this.how_much_cal = function(){
        return 1000;
    }

    // Is is food microwaveable
    this.microwaveable = function(){
        return true;
    }

    this.get_tags = function(){
        return [];
    }

    // Upload image
    var self = this;
    $.ajax({
        url:"access_point.php?action=upload_image",
        data:{
            file:base64
        },
        type:"POST",
        success:function(data){
            this.img_url = data;
            callback(self);
        },
        error:function(data){
            callback(false);
        }
    });
}

// Helper function to convert file dom object to base64
function image_to_base64(dom_id, callback) {
    var files_selected = document.getElementById(dom_id).files;
    if (files_selected.length > 0) {
        var file_to_load = files_selected[0];
        var file_reader = new FileReader();
        file_reader.onload = function(file_loaded_event) {
            var src_data = file_loaded_event.target.result;
            callback(src_data);
        }
        file_reader.readAsDataURL(file_to_load);
    }
}
