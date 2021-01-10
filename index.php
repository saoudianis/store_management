<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>signIn</title>
     <link rel="stylesheet" href="bts/css/bootstrap.css">
     <style>
            .emailh{
                text-align: center;
                border: 1px solid grey;
                border-radius: 10px;
                margin-top: 20px;
            }
            textarea{
                height: 120px;
            }
            form{
                padding-bottom: 20px;
            }
         .login{
             margin-top: 10px;
         }
        </style>
</head>
<body>
   
   
        <div class="container center_div">
            <div class="row">
                 
                <div class="col-md-12 col-md-offset-3 emailh">
        <h1>Admin Login Page</h1>
                    <!-- php Code -->
        <!-- php Code -->
                    <?php 
                    error_reporting(0);
                    session_start();
                    
                    /* php alert functions */
                    $result='<div class="alert alert-info">Please Enter Your Information</div>';
                    
                    /* if user want logout */
                    if($_GET["logout"]==1 AND ($_SESSION['id']=="admin")){
                        session_destroy();
                        /* If user logout */
                    $result='<div class="alert alert-success">You Have Been Logged Out</div>';
                    }
                    
                    
                    /* if all info was right do */
                     if (($_POST["submit"]) AND (($_POST["password"]) AND ($_POST["email"]) )){
       
                     /* if the info was right */
                         if((($_POST["password"]=="admin") AND ($_POST["email"]=="admin") )){
                             
                        $result='<div class="alert alert-success">You LogIn ✓</div>'; 
                             
                        $_SESSION['id']="admin";     
                        header("location:product.php");     
                         
                     } 
                         /* if the info was wrong */
                         else {
                            
                             $result='<div class="alert alert-Danger">Sorry there is a error please enter a valid info </div>';
                     }
                     }
            /* if One of the enter info are missing */
                     if (($_POST["submit"]) AND (!($_POST["password"]) OR !($_POST["email"]))){
                       $result='<div class="alert alert-Danger">Please Enter All Your Info</div>';  
                         
                     }
        echo $result;
                    ?>
                    <!-- .../php -->
                    <!-- .../php -->
                    
                    
   
   
   
    <form method="post">
        <div class="form-group">
     <label for="email">Your UserName:</label>
         <input type="text" name="email" class="form-control" placeholder="Your Username" />
                        </div>   
                        
                        
          <div class="form-group">
             <label for="name">Your Password:</label>
               <input type="password" name="password" class="form-control" placeholder="Your Password" />
                        </div>
                        
                        
                        
          <input type="submit" class="btn btn-success bnt-lg login" value="Submit" name="submit" />
                    
                    
                    </form>
   
                </div>
            </div>
    </div>
   
   
</body>
</html>