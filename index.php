
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BioLite App v1</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/app.css">   
</head>
<?php

include('app.php');

?>
<!-- CODED BY ALAA ADEL  selim.alaa@gmail.com !-->
<body>


    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Biolite App</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>


     <main role="main" class="container">
     
     <?php
      if($error){
     ?>
<div class="alert alert-danger" role="alert">
  <strong>Error!</strong> <?php echo $error; ?>
</div>
     <?php } ?>
     <?php
      if($success){
     ?>
<div class="alert alert-info" role="alert">
  <strong>Success!</strong> <?php echo $success; ?>
</div>
     <?php } ?>

     <div class="starter-template">
     <div class="row">
            <div class="col-sm">
                <form id="comment_form" action="index.php" method="POST">
                   <div class="form-group">
                      <label for="name">Your Name:</label>
                      <input id="form_name" type="text" name="form_name" class="form-control" value="<?php echo $name ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Your E-mail:</label>
                      <input id="form_email" type="email" name="form_email"   value="<?php echo $email ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="message">Your Message:</label>
                      <textarea id="form_message" name="form_message" cols="30" rows="10" class="form-control" required><?php echo $message ?>
                      </textarea>
                    </div>      
                    <div class="form-group">
                      <input type="submit"  class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
     </div>

     <div class="row">
         <div class="col-sm">
             <h1>Users Comments:</h1>
             <?php 
             $comment->show('ACCEPTED');
             ?>
         </div>
     </div>

      
     </main><!-- /.container -->



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="assets/js/form.js"></script>

    
</body>
</html>