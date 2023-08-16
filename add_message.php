<?php
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$page_title ='Add Message';

include 'header.php';
    // echo "<script>alert('rr')</script>";


// if(isset($_POST['submitbtn_audio'])){
// 	if(isset($_POST['submitbtn_audio']) and !empty($_FILES['message']['name'])){

//     $error_messages = array(
//         UPLOAD_ERR_OK         => 'There is no error, the file uploaded with success',
//         UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
//         UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
//         UPLOAD_ERR_PARTIAL    => 'The uploaded file was only partially uploaded',
//         UPLOAD_ERR_NO_FILE    => 'No file was uploaded',
//         UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
//         UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
//         UPLOAD_ERR_EXTENSION  => 'A PHP extension stopped the file upload',
//     );
//     if ($_FILES['message']["error"] > 0)  {
//         echo "Return Code: " . $_FILES['message']["error"] . "<br>";
//         echo "Error message: ".$error_messages[$_FILES['error']];
//         // echo '<script> alert("error in uploading file") </script>';

//         $result = "failed - error in uploading file";
//         $path = '';

//     }else{
//         // echo "Upload: " . $_FILES['message']["name"] . "<br />";
//         // echo "Type: " . $_FILES['message']["type"] . "<br />";
//         // echo "Size: " . ($_FILES['message']["size"] / 1024) . " Kb<br />";
//         // echo "Temp file: " . $_FILES['message']["tmp_name"] . "<br />";

//         if (file_exists("uploads/audio/" . $_FILES['message']["name"])){
//             echo '<script> alert("'. $_FILES['message']["name"] . ' already exists.") </script>';
//             $result = "failed -". $_FILES['message']["name"] . " already exists.";
//             $path = '';
//         } else {
//             $resultw = move_uploaded_file($_FILES['message']["tmp_name"], "uploads/audio/" . $_FILES['message']["name"]);
//             $path = "uploads/audio/" . $_FILES['message']["name"];
//                 // echo "Stored in: " . "upload/" . $_FILES['message']["name"];
                
//             $title = $action->validate($_POST['title']);
//             $series = $action->validate($_POST['series']);
//             $preacher = $action->validate($_POST['preacher']);
//             $date_preached = $action->validate($_POST['date_preached']);
//              $result = $action->addMessage($title, $series, $preacher,$date_preached, $path);
             
//         }
//     }
//         echo "<script>alert('gghghhg')</script>";

//     $alert = json_encode($result); echo $result;
//         echo "<script>alert('$result')</script>";

//     // echo "<script>alert('$alert')</script>";

//     // $title = $action->validate($_POST['title']);
//     // $series = $action->validate($_POST['series']);
//     // $preacher = $action->validate($_POST['preacher']);
//     // $date_preached = $action->validate($_POST['date_preached']);
//     // // $series = $action->validate($_POST['series']);

//     // // $action->createWard($name,$lga);
//     // // if($action->addAudio() !=""){
//     //     // $path = $action->addAudio();
//     // if($path != ''){
//     //     $result = $action->addMessage($title, $series, $preacher,$date_preached, $path);
//     // }else{
//     //     echo "<h1>error Empty path</h1>";
//     // }
//     
// }

// }

if(isset($_POST['submitbtn_series'])){
    if($_POST['title'] != '' || $_POST['title'] != ' ' || isset($_POST['title'])){
        $title = $action->validate($_POST['title']);
        $result = $action->addSeries($title);
        echo '<script>location.href = "add_message.php" </script>';

    }else{
        echo "<script>alert('Empty Title Entered!!!')</script>";
    }
   
}

if(isset($_POST['submitbtn_preacher'])){
    if(isset($_POST['preacher_name']) || $_POST['preacher_name'] != null || $_POST['preacher_name'] != ' '){
        $name = $action->validate($_POST['preacher_name']);
        $result = $action->addPastor($name);
        
        echo '<script>location.href = "add_message.php" </script>';
    }else{
        echo "<script>alert('Empty Name Entered!!!')</script>";
    }
}


/*** get messages data for table below ***/
$messages_data = $action->t_fetchMessages();
$message_body = " "; $m_num = 1;
foreach($messages_data as $md){
    $m_id = $md['id'];
    $message_body .= "
        <tr>
            <td>$m_num</td>
            <td>". $md['title'] ."</td>
            <td>". $action->getPreacherName($md['preacher']) ."</td>
            <td>". $action->getSeriesTitle($md['series']) ."</td>
            <td>". $md['date_preached'] ."</td>
            <td> <a class='btn btn-success m-2' href='edit.php?type=messages&id=$m_id'> Edit </a> <button class='btn btn-danger m-2 delete-btn' data-id=$m_id data-title='".$md['title']."' data-type='messages'> Delete</button></td>
        </tr>
    ";
    $m_num++;
}


/*** get Series data for table below ***/
$series_data = $action->t_fetchSeries();
$series_body = " "; $s_num = 1;
foreach($series_data as $sd){
    $s_id = $sd['id'];
    $series_body .= "
        <tr>
            <td>$s_num</td>
            <td>". $sd['title'] ."</td>
            <td> <a class='btn btn-success m-2' href='edit.php?type=series&id=$s_id'> Edit </a> <button class='btn btn-danger m-2 delete-btn' data-id=$s_id data-title='".$sd['title']."' data-type='series'> Delete</button></td>
        </tr>
    ";
    $s_num++;
}


/*** get Preachers data for table below ***/
$preachers_data = $action->t_fetchPreachers(); 
$preachers_body = " "; $p_num = 1;
foreach($preachers_data as $pd){
    $p_id = $pd['id'];
    $preachers_body .= "
        <tr> 
            <td>$p_num</td>
            <td>". $pd['name'] ."</td>
           
            <td> <a class='btn btn-success m-2' href='edit.php?type=preachers&id=$p_id'> Edit </a> <button class='btn btn-danger m-2 delete-btn' data-id=$p_id data-title='".$pd['name']."' data-type='preacher'> Delete</button></td>
        </tr>
    ";
    $p_num++;
}



?>
<style>
     #file_error{ color: red; }
            #bar{ width:0%; margin:15px; height:40px;  background-color:#0d6efd; border-radius: 10px; }
            #percent{ text-align: center; color: #fffff;}
            #status{ color:#ffffff; }
            /*.form-field{ padding: 5px;}*/
            #loader{ display: none; position: absolute; z-index: 9999; padding-top: 80px; padding-left: 25%;}
    
    .tabs-wrapper .table-wrapper a.btn{
        /*display: inline-block;*/
        
    }
    
</style>

<section class="gapdd">

    <div class="container">
        <div class="my-3 px-auto row">
            
            <div class="col-lg-4 col-md-4 col-sm-12 my-3">
                <a href="#add_message" data-bs-toggle="modal" class="btn btn-secondary mx-5 py-3 px-5 "> Add Message </a>

            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 my-3">
                <a href="#add_series" data-bs-toggle="modal" class="btn btn-secondary mx-5 py-3 px-5 "> Add Series </a>

            </div>

             <div class="col-lg-4 col-md-4 col-sm-12 my-3">
                <a href="#add_preacher" data-bs-toggle="modal" class="btn btn-secondary mx-5 py-3 px-5 "> Add Preacher </a>

            </div>

        </div>

    </div>
    
    <div class="tabs-wrapper my-5 py-3">
         <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-bs-toggle="tab" href="#messages_tab">Messages</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#series_tab">Series</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#preachers_tab">Preachers</a>
            </li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
            <div id="messages_tab" class="container tab-pane active"><br>
               <h3>Messages</h3>
               <div class="table-wrapper table-responsive">
                    <table id="message-table" class="cell-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Message Title</th>
                                <th> Preacher</th>
                                <th>Series</th>
                                <th>Date Preached</th>
                                <th>Actions</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?= $message_body  ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Message Title</th>
                                <th> Preacher</th>
                                <th>Series</th>
                                <th>Date Preached</th>
                                <th>Actions</th>
                            </tr>
                            
                        </tfoot>
                    </table>
                </div>
            </div>
            <div id="series_tab" class="container tab-pane fade"><br>
                <h3>Series</h3>
               <div class="table-wrapper table-responsive">
                    <table id="series-table" class="cell-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Series Title</th>
                                <th>Actions</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?= $series_body  ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Series Title</th>
                                <th>Actions</th>
                            </tr>
                            
                        </tfoot>
                    </table>
                </div>
            </div>
            <div id="preachers_tab" class="container tab-pane fade"><br>
               <h3>Preachers</h3>
               <div class="table-wrapper table-responsive">
                    <table id="preachers-table" class="cell-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th> Preachers Name</th>
                                <th>Actions</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?= $preachers_body  ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th> Preachers Name</th>
                                <th>Actions</th>
                            </tr>
                            
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Modal for audio message upload -->
<div class="modal fade" id="add_message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Audio Message</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="container" id="add_messagedbb">
                <form id="message-form" enctype="multipart/form-data">
                    <div class="mx-auto">
                        <div class="mb-3 mt-3">
                            <label for="text">Title:</label>
                            <input type="text" required class="form-control" id="name" placeholder="Enter Message title" name="title">
                        </div>
                        <div class="mb-3 mt-3 ">
                            <label for="text">Series:</label>
                            <select required class="form-control" name="series">
                                <option value=""> Select Series </option>
                                <?php echo $action->fetchSeries() ; ?>
                            </select>
                        </div>

                        <div class="mb-3 mt-3 ">
                            <label for="text">Preacher:</label>
                            <select required class="form-control" name="preacher"> 
                                <option value=""> Select Preacher </option>
                                <?php echo $action->fetchPreachers() ; ?>
                            </select>
                        </div>
                        <div class="mb-3 mt-3 ">
                            <label for="text">Date Preached:</label>
                            <input type="date" class="form-control" name="date_preached" placeholder="Enter name of ward" >
                        </div>
                        <div class="mb-3 mt-3 ">
                            <label for="text">Upload Audio:</label>
                            <input id="audio-msg" type="file" accept="audio/*" required class="form-control uploadmsg" name="message" placeholder="" >
                        </div>
                        <button type="submit" name="submitbtn_audio" class="btn btn-primary submit-audio" > Submit </button>
                        
                       	<div class="progress" style="display:block; height:30px; background:none !important;">
				            <div class="progress-bar bg bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%; height:30px; border-radius:15px; font-size:24px !important; "> 0% </div>
        				</div>
        				<div id="uploadStatus" class="mx-3 my-3"></div>


                    </div>
                </form>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <!-- Modal -->
<div class="modal fade" id="add_series" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Series</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="container" id="add_messagedbb">
                <form action="" class="" method="post" enctype="multipart/form-data">
                    <div class="mx-auto">
                        <div class="mb-3 mt-3">
                            <label for="text">Title:</label>
                            <input type="text" required class="form-control" id="name" placeholder="Enter series title" name="title">
                        </div>

                        <button type="submit" name="submitbtn_series" class="btn btn-primary" > Submit </button>
                    </div>
                </form>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add_preacher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Preacher</h5>
        <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="container" id="add_messagedbb">
                <form action="" class="" method="post" enctype="multipart/form-data">
                    <div class="mx-auto">
                        <div class="mb-3 mt-3">
                            <label for="text">Name:</label>
                            <input type="text" required class="form-control" id="name" placeholder="Enter Preacher's Name" name="preacher_name">
                        </div>

                        <button type="submit" name="submitbtn_preacher" class="btn btn-primary" > Submit </button>
                    </div>
                </form>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


</section>


<?php
 include 'footer.php';
?>

<script>

// function uploadform(){
//     var bar = $('#bar');
//     var percent = $('#percent');
//     var status = $('#statusbar'); 
//     $('#message-form').ajaxForm({
//         beforeSend: function(xhr) {
//             $("div.container").css({"opacity": "0.5"});
//             // $("div#loader").show();
//             status.empty();
//             var percentVal = '0%';
//             bar.width(percentVal);
//             percent.html(percentVal);
//             $(".container").css({"opacity": "1"});
//             $(".container").css({"background": "none"});
//             // $("div#loader").hide();
//         },
//         uploadProgress: function(event, position, total, percentComplete) {
//             var percentVal = percentComplete + '%';
//             $('#percent').html(percentVal);
//             $('#bar').width(percentVal); 
//         },
//         complete: function(xhr) {
//             window.location = "add_message.php?upload=success"
//         }
//     });
// }


$(document).ready(function() {
        
    $('#message-table').DataTable();
    
     $("#message-form").on('submit', function(e){
        e.preventDefault();
        $(".submit-audio").hide();
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'upload_audio.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
                $('#uploadStatus').html('<p>loading....</p>');
                // $('#uploadStatus').html('<img src="images/loading.gif"/>');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function(resp){
                if(resp == 'ok'){
                    $('#message-form')[0].reset();
                    $('#uploadStatus').html('<p style="color:#28A74B;">File has uploaded successfully!</p>');
                    alert('Message Added Successfully !!!')
                    location.replace('add_message.php')
                }else if(resp == 'err'){
                    $('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
                    alert('failed')
                    location.replace('add_message.php')
                }else{
                    $('#uploadStatus').html('<p style="color:#EA4335;">'+resp+'.</p>');
                    alert(resp);
                    location.replace('add_message.php')
                }
                
            }
        });
    });
    

    //     var progressbar = $('.progress-bar');

    //     $(".submit-audio").click(function(){
    //         $(".submit-audio").hide();
    //         $("#message-form").ajaxForm({
		  //    //  target: '.preview',
		  //      beforeSend: function() {
			 //       $(".progress").css("display","block");
    //     			progressbar.width('0%');
    //     			progressbar.text('0%');
    //             },
		  //      uploadProgress: function (event, position, total, percentComplete) {
		  //          progressbar.width(percentComplete + '%');
		  //          progressbar.text(percentComplete + '%');
		  //      },
		  //  }).submit();
    //     });



    // $('.submit-audio').click(function(){ 
    //     if($('input.uploadmsg').val() != undefined) {
    //         var file = $('input.uploadmsg')[0].files[0].size;
    //         file = file/1024; file = file/1024;
    //         if(file > 100) {
    //             $('#file_error').html('Fize Size is greater than 100 MB');
    //             return false;
    //         } else {
    //             $('#file_error').hide();
    //             $('.submit-audio').hide();
    //             uploadform();
    //         }
    //     }
    // });

	
// 	$('.tab-content').on('click','.delete-btn', function(){
	$('.delete-btn').click(function(){
    	    var title= $(this).attr('data-title');
    	    var table= $(this).attr('data-type');
    	    var id = $(this).attr('data-id');
    	    var confirm_delete = confirm("Are you sure you want to delete this "+table + ": \n "+title)
    	    if(confirm_delete){
    	        $.ajax({
    	            type: 'post',
    	            url: 'delete.php',
    	            data:{'table':table, 'id':id},
    	            dataType: 'json',
    	            success: function(res){
        	             var resp = JSON.stringify(res);
        	             console.log('resp stringigy > '+resp);
        	             console.log('res > '+res);
        	             if(res.status_message == 'success'){
        	                 alert(title + " deleted Successfully!!");
        	                 location.replace('add_message.php');
        	             }else{
        	                 alert("Something Went Wrong \n "+title + " could not be deleted!"); 
        	             }
    	            }
    	         })
    	         return false;
    	    }else{
    	        return false;
    	    }
    	        
    	})
    	
    	
});
    
</script>

