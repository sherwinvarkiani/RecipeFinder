<?php
// 1. database credentials
$host = "localhost";
$db_name = "Recipes";
$username = "root";
$password = "";

// 2. connect to database
$conn = new mysqli($host, $username, $password, $db_name);
$input =  $_GET['user-input'];
$input = str_replace(",", "%", $input);

$sql = "SELECT * FROM recipe_table WHERE ingredients LIKE '%${input}%' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Recipe Finder">
<meta name="keywords" content="Recipe Finder">
<title>Recipe Finder | Home</title>

<link href="assets/css/layout.css" rel="stylesheet">
<link href="assets/css/theme.css" rel="stylesheet">
</head></html>';
	$suggRecipes = array();
    while($row = $result->fetch_assoc()) {
        array_push($suggRecipes, $row);
     }
     if(sizeOf($suggRecipes) == 1){
     	array_push($suggRecipes, $suggRecipes[0]);
     	array_push($suggRecipes, $suggRecipes[0]);
     }else if(sizeOf($suggRecipes) == 2){
     	array_push($suggRecipes, $suggRecipes[0]);
     }

        echo
    '<div class="div-holder">
    	<table><tr>
    	<td>
        <div class="recipe-holder" id="left">
          <img class="recipes" src="'.$suggRecipes[0]['image_url'].'">
          <h2>'. $suggRecipes[0]['food_name'].'</h2>
          <p>Ingredients: '. $suggRecipes[0]['ingredients'].'</p>
          <p>Follow the instructions <a href= "'.$suggRecipes[0]['recipe_url'].'">here.</a></p>
          <p>Prep Time: '.$suggRecipes[0]['prep_time'].' min</p>
        </div>
        <div class="recipe-background">
        </div>
        </td>
        <td>
        <div class="recipe-holder" id="center">
          <img class="recipes" src="'.$suggRecipes[1]['image_url'].'">
          <h2>'. $suggRecipes[1]['food_name'].'</h2>
          <p>Ingredients: '. $suggRecipes[1]['ingredients'].'</p>
          <p>Follow the instructions <a href= "'.$suggRecipes[1]['recipe_url'].'">here.</a></p>
          <p>Prep Time: '.$suggRecipes[0]['prep_time'].' min</p>

        </div>
        <div class="recipe-background">
        </div>
        </td>
        <td>
        <div class="recipe-holder" id="right">
          <img class="recipes" src="'.$suggRecipes[2]['image_url'].'">
          <h2>'. $suggRecipes[2]['food_name'].'</h2>
          <p>Ingredients: '. $suggRecipes[2]['ingredients'].'</p>
          <p>Follow the instructions <a href= "'.$suggRecipes[2]['recipe_url'].'">here.</a></p>
          <p>Prep Time: '.$suggRecipes[0]['prep_time'].' min</p>

        </div>
        <div class="recipe-background">
        </div>
        </td>
        </tr>
        </table>
      </div>
    </div>';

} else {
    echo "0 results";
}

?>
