<!-- Create a form with the following inputs (name, email, 
password, address, , linkedin url, profile pic) 
Validate inputs then return message to user. 
* validation rules ... 
name  = [required , string]
email = [required,email]
password = [required,min = 6]
address = [required,length = 10 chars]
linkedin url = [reuired | url]
Profile pic =[required|image]. 
Note upload image to server. 
Then create a profile page to read data that user inserted.
 -->

<?php

    function Clean($input){
         return strip_tags(trim($input));
    }
    
 if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
   
     $name = Clean ($_REQUEST ['name']);
     $email = Clean($_REQUEST['email']);
     $password = Clean($_REQUEST['password']);
     $address = Clean($_REQUEST['address']);
     $linkedinUrl = Clean($_REQUEST['linkedin']);
     $img = $_FILES['image']['name'];
    
     $errors = [];

      //validate name
      if (empty($name)) {
          
          $errors['Name'] = 'fill your name';
      
      } if (!is_string($name)) {
        $errors['Name'] = 'fill your name';

      }
      if (filter_var($email,FILTER_VALIDATE_EMAIL) == FALSE) {
          $errors['Email'] = 'your E-mail is required';

      
      } 
      if (strlen($password) < 6) {
          $errors['password'] = 'password length must be at least 6 chrs';
      } 
      
      if (filter_var($linkedinUrl,FILTER_VALIDATE_URL) == False) {
          
          $errors['LinnkedIn'] = 'pleaser enter your linked In link';
      }



      if (!empty($img)) {
          # code...
          $temPath = $_FILES['image']['tmp_name'];
          $imageType = $_FILES['image']['type'];

          $exArray   = explode('.',$img);
           $extension = end($exArray);

           $FinalName = rand().time().'.'.$extension;

           $allowedExtension = ["png",'jpg'];

            if(in_array($extension,$allowedExtension)){
                // code .... 

               $desPath = './uploads/'.$FinalName;

                if(move_uploaded_file($temPath,$desPath)){
                    echo 'Image Uploaded';
                }else{
                    echo 'Error In Uploading file';
                }


            }else{
                echo 'Not Allowed Extension .... ';
            }

        }else{
            echo 'Image Field Required';
        }

        }


 
    
 ?>

  <!DOCTYPE html>
<html lang="en">
<head>
  <title>Form</title>
</head>
<body>
 <h2> Form </h2>
<div class="container">
 
 
  <form  action="<?php echo $_SERVER['PHP_SELF'];?>"   method="post" enctype='multipart/form-data'  >
  <div class="form-group">
    <label for="exampleInputName">Name : </label>
    <input type="text" class="form-control" id="exampleInputName"  name="name" >
  </div>
  </br>

  <div class="form-group">
    <label for="exampleInputEmail">Email address : </label>
    <input type="email"   class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" >
  </div>
   
  </br>

  <div class="form-group">
    <label for="password">Password : </label>
    <input type="password"   class="form-control" id="password" name="password" >
  </div>


</br>


  <div class="form-group">
    <label for="addressex">Address : </label>
    <input type="text"   class="form-control" id="addressex" name="address" >
  </div>
  </br>

<div class="form-group">
  <label for="linkin">Linked In : </label>
  <input type="url"   class="form-control" id="linkin" name="linkedin" >
</div>
  </br>
  <div class="form-group">
    <label for="profilepic">Choose your Profile Picture : </label>
    <input type="file"   class="form-control" id="profilepic" name="image" >
  </div>

</br>
  
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>