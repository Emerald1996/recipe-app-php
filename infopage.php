<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>info</title>
</head>
<?php 

        include('config/connect_db.php');

    	// getting id parameter
        
        if(isset($_GET['id'])){
            
            // escape sql chars
            $id = mysqli_real_escape_string($conn, $_GET['id']);

            // make sql
            $sql = "SELECT * FROM Recipes WHERE id = $id";

            // get the query result
            $result = mysqli_query($conn, $sql);

            // fetch single result in array format
            $recipee = mysqli_fetch_assoc($result);

            mysqli_free_result($result);
            mysqli_close($conn);

        }


        if(isset($_POST['delete'])){

            $recipe_id = mysqli_real_escape_string($conn, $_POST['recipe_id']);
    
            $sql = "DELETE FROM Recipes WHERE id = $recipe_id";
    
            if(mysqli_query($conn, $sql)){
                header('Location: index.php');
            } else {
                echo 'query error: '. mysqli_error($conn);
            }
    
        }
        ?>
<body>
    <?php include('header.php'); ?>
    <?php if($recipee == true): ?>
        <div class="flex flex-col items-center justify-center">
           <div class="p-8 mt-4 bg-slate-100 shadow-lg shadow-[#040c16]">
                <h4 class="font-bold text-lg text-center"><?php echo $recipee['recipe_name']; ?></h4>
                <p>Created by <?php echo $recipee['email']; ?></p>
                <p><?php echo date($recipee['created_at']); ?></p>
                <h5>Ingredients:</h5>
                <p><?php echo $recipee['ingredients']; ?></p>
                <!-- DELETE FORM -->
                 <form action="infopage.php" method="POST" class="flex flex-col items-center justify-center">
                     <input type="hidden" name="recipe_id" value="<?php echo $recipee['id']; ?>">
                     <input type="submit" name="delete" value="Delete" class="bg-green-600 cursor-pointer mt-4 text-slate-200 p-4 hover:bg-green-400 rounded-lg">
                 </form>
           </div>
        </div>
        <?php else: ?>
            <h5>No such recipees exists.</h5>
        <?php endif ?>
    
    <?php include('footer.php'); ?>
</body>
</html>