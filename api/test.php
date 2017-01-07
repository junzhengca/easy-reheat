<input id="inputFileToLoad" type="file" onchange="encodeImageFileAsURL();" />
<div id="imgTest"></div>
<button onclick="upload();">Upload</button>
<script src="https://ssl.jackzh.com/file/js/jquery/jquery-2.2.2.min.js"></script>
<script type='text/javascript'>
  function encodeImageFileAsURL() {
    var filesSelected = document.getElementById("inputFileToLoad").files;
    if (filesSelected.length > 0) {
      var fileToLoad = filesSelected[0];
      var fileReader = new FileReader();
      fileReader.onload = function(fileLoadedEvent) {
        var srcData = fileLoadedEvent.target.result; // <--- data: base64
        var newImage = document.createElement('img');
        newImage.src = srcData;
        document.getElementById("imgTest").innerHTML = newImage.outerHTML;
        alert("Converted Base64 version is " + document.getElementById("imgTest").innerHTML);
        console.log("Converted Base64 version is " + document.getElementById("imgTest").innerHTML);
      }
      fileReader.readAsDataURL(fileToLoad);
    }
  }
  function upload(){
    file_data = $("img").attr("src");
    $.ajax({
      url:"access_point.php?action=upload_image",
      data:{
        file:file_data
      },
      type:"POST",
      success:function(data){
        console.log(data);
      },
      error:function(data){
        console.log(data);
      }
    });
  }
</script>
