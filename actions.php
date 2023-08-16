<?php
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

class Action{
   
    public $connect;

    public function __construct(){
        // $this->connect = new mysqli('localhost', 'root', '','kdclovee_messages') or die("error in connection: ".$this->connect->connect_error);
        $this->connect = new mysqli('localhost','kdclovee_msg','kdce-library.portal','kdclovee_messages') or die("error in connection: ".$this->connect->connect_error);
        
    }

    public function validate($textInput){
        $textInput = trim($textInput);
        $textInput = stripslashes($textInput);
        $textInput = strip_tags($textInput);
        $textInput = htmlspecialchars($textInput);
        $textInput = $this->connect->real_escape_string($textInput); 

    
        return $textInput;
    }
    
   

    public function uploadAudio()
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    public function exist($value, $table, $column){
        $sql = "select * from $table where $column = '$value'";
        $result = $this->connect->query($sql);
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }


    public function addMessage($title, $series, $preacher, $datePreached, $path)
    {
        $status = "";
        if(!$this->exist($title, 'messages','title')){

            $sql = "insert into messages (title, series, preacher, path, date_preached) values ('$title', $series,$preacher, '$path', '$datePreached') "; 
            if($this->connect->query($sql)){
                $status = "success";
                $msg =  " - message successfully Added!!!";
            }else{
                $status = "failed";
                $msg= " - SOMETHING WENT WRONG!!!";

            }
        }else {
                $status = "failed";
            $msg= " - Message already exist";
        }
        
        return ['status'=>$status, 'msg'=>$msg];
    }
    
    public function updateMessage($title, $series, $preacher, $datePreached, $id){
        $sql = "update messages set title = '$title', series = $series , preacher = $preacher, date_preached = '$datePreached' where id = $id ";
        if($this->connect->query($sql)){
            $status = "success";
            echo "<script>alert('message successfully Updated!!!'); </script>";
        }else{
            $status = "failed";
            echo "<script>alert('MESSAGE COULD NOT BE UPDATED \n\n SOMETHING WENT WRONG!!!'); </script>";
        }
        echo "<script>location.replace('add_message.php#messages_tab') </script>";
    }


    public function messageCard($title, $series, $path, $preacher, $date_preached){

        return '<div class="sermoffn my-2 aos-init" data-aos="zoom-in-right" data-aos-duration="1000">

                <div class="card shadow-lg border-none" id="message-card">
                    <div class="card-header ">
                        <div class="row">
                            <p class="col-lg-9 col-md-8 col-sm-12"> Series: <a href="view_series.php?id='.$series.'">'. $this->getSeriesTitle($series) .'</a></p>
                            <p class="col-lg-3 col-md-4 col-sm-12"><a href="'.$path.'"> <i class="fas fa-play">  </i> Play </a> <a download href="'.$path.'"> <i class="fas fa-download"></i> Download </a></p> 
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">'.$title.'</h5>
                        
                    </div>
                    <div class="card-footer text-muted ">
                        <div class="row">
                            <p class="col-lg-8 col-md-8 col-sm-7">Preacher: '.$this->getPreacherName($preacher).'</p>
                            <p class="col-lg-4 col-md-4 col-sm-5">Date Preached: '.$date_preached.'</p>
                        </div>
                    </div>
                </div>
            </div>';

    }

    public function paginate($pages, $currentPage){
        $links = "";
        if($currentPage > 1){
             $links .= '<li class="page-item"><a href="?page='.($currentPage - 1) .'" class="page-link"> Previous</a></li>';
        }
        for($i=1; $i <= $pages; $i++){
            if ($i == $currentPage) {   
                $links .=  '<li class="page-item active"><a href="?page='.$i.'" class="page-link"> '.$i.' </a></li>';
            }               
            else  {   
                $links .=  '<li class="page-item"><a href="?page='.$i.'" class="page-link"> '.$i.' </a></li>';
            }   
        }
        if($currentPage < $pages){
            $links .= '<li class="page-item"><a href="?page='.($currentPage + 1) .'" class="page-link"> Next</a></li>';
        }

        return '<div class="d-flex justify-content-center loadmore">
         <ul class="pagination">'.
            $links
         .'</ul>
        
        ';
        // return '
        // <div class="d-flex justify-content-center loadmore">

        // <ul class="pagination">
        //     <li class="page-item"><a href="?page=2" class="page-link"> Previous</a></li>
        //     <li class="page-item active"><a href="?page=1" class="page-link"> 1 </a></li>
        //     <li class="page-item"><a href="#" class="page-link"> Next</a></li>
        // </ul>
        // </div>';
    }

    public function fetchAllMessages($page){
        $sql = "select * from messages";
        $str='';
        $result = $this->connect->query($sql);
        $total = $result->num_rows;
        $records_per_page = 6;
        $num_of_pages = ceil($total / $records_per_page);
        $first_result = ($page - 1) * $records_per_page;
        $sql .= " limit $first_result, $records_per_page ";
        $result = $this->connect->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
               $str .= $this->messageCard($row['title'], $row['series'], $row['path'], $row['preacher'], $row['date_preached'] );
             
            }
        }

        
        return $str . $this->paginate($num_of_pages, $page);
    }

    public function fetchMessagesBySeries($id){
        $sql = "select * from messages where series = ".$id ;
        $str='';
        $result = $this->connect->query($sql);
        // implode(' - ', $result);
        // echo json_encode($result->num_rows);
        $rst = array();
        // echo array_push($rst, $result);

        if($result->num_rows > 0){
            while($row = $result->fetch_array()){
                // array_push($rst, $row['title']);
                array_push($rst, array(
                   'name'=> $row['title'], 
                   'preacher' => $this->getPreacherName( $row['preacher']), 
                   'series' => $this->getSeriesTitle( $row['series']),
                   'file' => $row['path'],
                   'duration' => '08:46'
                ));
            }
        }
        // echo json_encode($rst);

        $listAudio = json_encode($rst);
     //   echo $rst[1]['preacher'];
       // echo $rst[0]['preacher'];
        return $listAudio;

    }

    public function addSeries($title)
    {
        $status = "";
        if(!$this->exist($title, 'series','title')){

            $sql = "insert into series (title) values ('$title')";
            if($this->connect->query($sql)){
                $status = "success";
                echo "<script>alert('Series SUCCESSFULLY addedd!!!'); </script>";
            }else{
                $status = "failed";
                echo "<script>alert(''SOMETHING WENT WRONG!!!') ; </script>";

            }
        }else{
                $status = "failed";
            echo "<script>alert('Series already exist'); </script>";

        }
        
    }
    
    public function updateSeries($title, $id){
        $sql = "update series set title = '$title' where id = $id ";
        if($this->connect->query($sql)){
            $status = "success";
            echo "<script>alert('SERIES SUCCESSFULLY UPDATED!!!'); </script>";
        }else{
            $status = "failed";
            echo "<script>alert('SERIES COULD NOT BE UPDATED!! \n\n SOMETHING WENT WRONG!!!'); </script>";
        }
        echo "<script>location.replace('add_message.php#series_tab') </script>";
    }


    public function fetchAllSeries($page){
        $sql = "select * from series ";
        $str='';
        $result = $this->connect->query($sql);
        $total = $result->num_rows;
        $records_per_page = 12;
        $num_of_pages = ceil($total / $records_per_page);
        $first_result = ($page - 1) * $records_per_page;
        $sql .= " limit $first_result, $records_per_page ";
        $result = $this->connect->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $str .=' <div class="col-lg-3 col-md-6 col-sm-12 " data-aos="fade-down" data-aos-delay="300" data-aos-duration="800">
                            <div class="product light-bg shadow-lg position-relative">
                            
                                <div class="product-description text-center">
                                
                                    <a class="stretched-link" href="view_series.php?id='.$row['id'].'">'.$row['title'].'</a>
                                
                                </div>
                            </div>
                        </div>';
            }
        }else{
           echo ' No series available';
        }
        return $str . $this->paginate($num_of_pages, $page);
    }

    public function addPastor($name)
    {
        if(!$this->exist($name, 'preacher','name')){
            $sql = "insert into preacher (name) values ('$name')";
            if($this->connect->query($sql)){
                echo "<script>alert('PREACHER SUCCESSFULLY CREATED!!!'); </script>";
            }else{
                echo "<script>alert('ERROR IN PREACHER CREATION \n\n SOMETHING WENT WRONG!!!'); </script>";
    
            }
        }else{
                $status = "failed";
            echo "<script>alert('Preacher already exist'); </script>";

        }
    }
    public function updatePreacher($name, $id){
        $sql = "update preacher set name = '$name' where id = $id ";
        if($this->connect->query($sql)){
            echo "<script>alert('PREACHER SUCCESSFULLY UPDATED!!!'); </script>";
        }else{
            echo "<script>alert('PREACHER COULD NOT BE UPDATED!!!'); </script>";
        }
        echo "<script>location.replace('add_message.php#preachers_tab') </script>";
    }


    public function addAudio(){
        
        $allowedExts = array("mp3", "wma");
        $targetPath = "uploads/audio/";
        $extension = pathinfo($_FILES['message']['name'], PATHINFO_EXTENSION);

        if (( ($_FILES['message']["type"] == "audio/mp3") || ( $_FILES['message']["type"] == "audio/wma")) && in_array($extension, $allowedExts)){
            if ($_FILES['message']["error"] > 0)  {
                echo "Return Code: " . $_FILES['message']["error"] . "<br />";
                echo '<script> alert("error 1") </script>';

                $result = false;
                $path = '';

            }else{
                echo "Upload: " . $_FILES['message']["name"] . "<br />";
                echo "Type: " . $_FILES['message']["type"] . "<br />";
                echo "Size: " . ($_FILES['message']["size"] / 1024) . " Kb<br />";
                echo "Temp file: " . $_FILES['message']["tmp_name"] . "<br />";

                if (file_exists("uploads/audio" . $_FILES['message']["name"])){
                    echo '<script> alert("'. $_FILES['message']["name"] . ' already exists.") </script>';
                    $result = false;
                    $path = '';
                } else {
                   $result = move_uploaded_file($_FILES['message']["tmp_name"], $targetPath . $_FILES['message']["name"]);
                   $path = $targetPath . $_FILES['message']["name"];
                    // echo "Stored in: " . "upload/" . $_FILES['message']["name"];
                }
            }
        }else {
            // echo "Invalid file";
            $result = false;
            $path = '';


        }
        return $path;

    }

    public function getSeriesTitle($id){
      $sql = "select title from series where id = ".$id;

      $result = $this->connect->query($sql);
      if($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            $title =$row['title'] ;
          }
      }

      return $title;
    }

    public function getPreacherName($id){
        $sql = "select name from preacher where id = ".$id;

        $result = $this->connect->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $name =$row['name'] ;
            }
        }
  
        return $name;
      
    }
    
    public function getMessage($id){
        $sql = "select * from messages where id = $id";
        $data = [];
        $result = $this->connect->query($sql);
        while($row = $result->fetch_assoc()){
            $data[] = $row; 
        }
        return $data;
    }

    public function fetchSeries(){
        $sql = "select * from series ";
        $str='';
        $result = $this->connect->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $str .= "<option value='". $row['id']."'> ". $row['title']."  </option>";
            }
        }

        return $str;

    }

    public function fetchPreachers(){
        $sql = "select * from preacher ";
        $str='';
        $result = $this->connect->query($sql);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $str .= "<option value='". $row['id']."'> ". $row['name']."  </option>";
            }
        }

        return $str;

    }



    public function searchMessages($searchInput ){
        $sql = "select * from messages where title like '%$searchInput%' "  ;
        // if(isset($startDate) && !empty($startDate)){
        //     $sql .= " and date_preached >= '$startDate'";
        // }
        // if(isset($endDate) && !empty($endDate)){
        //     $sql .= " and date_preached <= '$endDate'";
        // }
        $result = $this->connect->query($sql);
        if($result->num_rows > 0){
            $str =" ";
            while($row = $result->fetch_assoc()){
                $str .= $this->messageCard($row['title'], $row['series'],$row['path'], $row['preacher'],$row['date_preached'] );

            }
        }else{
            $str = "<h2 class='mt-4 pt-2 text-center'>  Your Search '$searchInput' did not return any result </h2>";
        }
        return $str;

    }
 
    public function searchSeries($searchInput){
        $sql = "select * from series where title like '%$searchInput%'";
        $str=' ';
        $result = $this->connect->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
              $str .=' <div class="col-lg-3 col-md-6 col-sm-12 " data-aos="fade-down" data-aos-delay="300" data-aos-duration="800">
                            <div class="product light-bg shadow-lg position-relative">
                            
                                <div class="product-description text-center">
                                  
                                    <a class="stretched-link" href="view_series.php?id='.$row['id'].'">'.$row['title'].'</a>
                                
                                </div>
                            </div>  
                        </div>'; 
            }
        }else{
            $str = "<h2 class='mt-4 pt-2 text-center'>  Your Search '$searchInput' did not return any result </h2>";
        }
        return $str;
    }
    
    public function t_fetchMessages(){
        $sql = "select * from messages";
        $data = [];
        $result = $this->connect->query($sql);
        while($row = $result->fetch_assoc()){
            $data[] = $row; 
        }
        return $data;
    }
        
    public function t_fetchSeries(){
        $sql = "select * from series";
         $data = [];
        $result = $this->connect->query($sql);
        while($row = $result->fetch_assoc()){
            $data[] = $row; 
        }
        return $data;
    }
        
    public function t_fetchPreachers(){
        $sql = "select * from preacher";
         $data = [];
        $result = $this->connect->query($sql);
        while($row = $result->fetch_assoc()){
            $data[] = $row; 
        }
        return $data;
    }
    
    public function delete($table, $id){
        $sql = "delete from $table where id=$id";
        if($this->connect->query($sql)){
            $status = "success";
        }else{
            $status = "fail";
        }
        
        return $status;
    }
    

}
?>