<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>form</title>
</head>
<body>
  
  <?php include('header.php'); ?>
  <?php 

  include('config/connect_db.php');
  /* htmlspecialchars is used to display an output to 
  the browser and helps to remove any mallecious 
  injected code from scammers */
  
      // SERVER SIDE VALIDATION PRACTICES USING PHP
      $recipe_name = $email = $ingredients = '';
  
      // HANDLE ERRORS
    $errors = array("email" => "", "recipe_name" => "", "ingredients" => "");
  
  if(isset($_POST['submit'])){
      
    
    // check recipe_name
    if(empty($_POST['recipe_name'])){
      $errors["recipe_name"] =  'A recipe name is required <br />';
    } else{
      $recipe_name = $_POST['recipe_name'];
      if(!preg_match('/^[a-zA-Z\s]+$/', $recipe_name)){
        $errors["recipe_name"] = 'Recipe name must be letters and spaces only';
      }
    }
    
    // check ingredients
    if(empty($_POST['ingredients'])){
      $errors["ingredients"] =  'At least one ingredient is required <br />';
    } else{
      $ingredients = $_POST['ingredients'];
      if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
        $errors["ingredients"] = 'Ingredients must be a comma separated list';
      }
    }
    // check email
    if(empty($_POST['email'])){
      $errors["email"] =  'An email is required <br />';
    } else{
      $email = $_POST['email'];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors["email"] = 'Email must be a valid email address';
      }
    }
    
    if(array_filter($errors)){
        //echo 'errors in form';
      } else {
        // escape sql chars
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $recipe_name = mysqli_real_escape_string($conn, $_POST['recipe_name']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
  
        // create sql by inserting into db
        $sql = "INSERT INTO Recipes(recipe_name,ingredients,email) VALUES('$recipe_name','$ingredients','$email')";
  
        // save to db and check
        if(mysqli_query($conn, $sql)){
          // success
          header('Location: index.php');
        } else {
          echo 'query error: '. mysqli_error($conn);
          echo'an error occured';
        }
  
        
      }
    } // end POST check

  ?>
         
  <form action="form.php" method="POST" class="flex justify-center items-center flex-col p-8">
    <h2 class="text-2xl font-normal font-monospace p-8 uppercase text-gray-700">Recipe app Demo</h2>
    <div class="bg-slate-50 px-10 rounded-lg w-full py-4 mx-10">
      <div class="grid grid-cols-1 gap-6">
        
        <label class="block">
          <span class="text-gray-700">Recipe name</span>
          <input
            type="text"
            class="mt-1 block w-full rounded-md bg-green-100 p-4 outline-none border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
            name="recipe_name"
            value="<?php echo $recipe_name; ?>"
          />
          <div class="text-red-700"><?php echo $errors["recipe_name"]; ?></div>
        </label>
        <label class="block">
          <span class="text-gray-700">Ingredients</span>
          <input
            type="text"
            class="mt-1 block w-full rounded-md bg-green-100 p-4 outline-none border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
            name="ingredients"
            value="<?php echo $ingredients; ?>"
          />
          <div class="text-red-700"><?php echo $errors["ingredients"]; ?></div>
        </label>
        <label class="block">
          <span class="text-gray-700">Email address</span>
          <input
            type="email"
            class="mt-1 block w-full rounded-md bg-green-100 p-4 outline-none border-transparent focus:border-gray-500 focus:bg-white focus:ring-0"
            placeholder="john@example.com"
            name="email"
            value="<?php echo $email; ?>"
          />
          <div class="text-red-700"><?php echo $errors["email"]; ?></div>
        </label>
      </div>
      <div class="items-center mt-8">
          <input type="submit" name="submit" value="submit" class="cursor-pointer	 bg-green-600 text-slate-200 p-4 hover:bg-green-400 rounded-lg  w-full">
      </div>
    </div>
  </form>
  <?php include('footer.php'); ?>
</body>
</html>

     