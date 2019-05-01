<?php

$weather= "";
$error = "";


if(array_key_exists('city',$_POST)){
    $city = $_POST['city'];
    
    //We are replacing space with no space in city variable.
    $city = str_replace(' ', '', $city);
    
    $file_headers = @get_headers("https://www.timeanddate.com/weather/india/$city/");
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
      
        $error = "This city could not be found";

    } else{
    
    $page = file_get_contents("https://www.timeanddate.com/weather/india/$city/");
    
    $str = 'title="Historic weather and climate information">Climate (Averages)</a></div></nav><section class=fixed><div class="row pdflexi-b dashb"><div class="eight columns"><h2>';
     
        
   $pagearray = explode("$str",$page); //explode function breaks into arrays. 
    
    
    if(sizeof($pagearray) > 1){
            
              $secondpagearray = explode("See more hour-by-hour weather", $pagearray[1]);
            
            if(sizeof($secondpagearray) > 1){
                
                $weather = $secondpagearray[0];
                    
            } else{
                
                $error = "This city could not be found";
            }
        }else{
        
        $error = "This city could not be found";
    }

      }
}


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
      
        html { 
          background: url(background.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }
        
        body {
            background: none;
        }
       
        .container{
            
            text-align: center;
            margin-top: 180px;
            width: 430px;
        }
        
        input{
            
            margin-top: 20px;
            align-content: center;
        }
        
        form{
            margin-bottom: 40px;
        }
        
       
        
       
      </style>

    <title>Weather Scrapper</title>
  </head>
  <body>
   
    
    <div class="container">
        <h1>What's the Weather?</h1>
        <form method="post">
          <div class="form-group">
            <label for="city">Enter the name of a city</label>
            <input type="text" name="city" class="form-control" id="city" aria-describedby="emailHelp" placeholder="Eg. Bilaspur, New Delhi">
            
          </div>
          
           <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
        <div><?php if($weather){ echo $weather; }?></div>
        <div id="error"><?php if($error){ echo '<div class="alert alert-danger" role="alert">'.$error.'</div>'; }?></div>                                        
        
    </div>
    

    
 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>