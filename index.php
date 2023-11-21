<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="styles.css" rel="stylesheet">
</head>

<body class="bg-slate-400">

<?php 

include('config/connect_db.php');

$sql = "SELECT id, recipe_name, ingredients FROM Recipes ORDER BY created_at";
$result = mysqli_query($conn, $sql);
$recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);

// if (mysqli_num_rows($result) > 0) {
//   // output data of each row
//   while($row = mysqli_fetch_assoc($result)) {
//       // echo "id: " . $row["id"]. " - Recipe_name: " . $row["recipe_name"]. " ,ingredients: " . $row["ingredients"]. "<br>";

//   }
// } else {
//     echo "0 results";
// };

// mysqli_free_result($result);

mysqli_close($conn);

?>
<?php include('header.php'); ?>


<h2 class="text-center text-green-700 py-4 text-2xl font-bold">Recipes!</h2>
	<div class="max-w-[1000px] mx-auto p-4 flex justify-center w-full h-full">

		<div class="w-full grid grid-cols-2 sm:grid-cols-3 gap-4 py-8">
	
			<?php foreach($recipes as $recipee){ ?>
	
				<div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
					<div class="p-8 bg-slate-100 shadow-lg shadow-[#040c16]">
						<div class="bg-slate-50 p-8">
							<h3 class="font-bold text-xl text-center"><?php echo htmlspecialchars($recipee["recipe_name"]); ?></h3>
							<hr>
							<div class="mt-4">
							<?php foreach(explode(',', $recipee['ingredients']) as $ingr){ ?>
							<p class="mt-4">• <?php echo htmlspecialchars($ingr); ?></p>
							<?php } ?>
						</div>
						<div class="mt-8 text-center">
							<a class="text-center rounded-lg px-4 py-3 m-2 text-red-700 font-bold text-lg" href="infopage.php?id=<?php echo $recipee['id'] ?>">more info</a>
						</div>
						</div>
					</div>
				</div>
	
			<?php } ?>
	
		</div>
	</div>

<?php include('footer.php'); ?>
</body>
</html>