<?php
// As I will check that many data have at least 5 characters, I write a function
// to test it and display the error.
// It receives the value to check and its "description" as parameters.

function displayError ($value, $name){
    if (strlen($value)<5){
        echo '<div class="redError">'. $name . ' must have at least 5 characters</div>';
        return true;
    }
    return false;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Movie DB</title>
    <style>
      input{
        display : block;
      }
      .redError{
        color :red ;
      }
    </style>
  </head>
  <body>
  
<?php

// if we come back from a "POST" submit

$isThereAnError = false;
$postMethod = false;


if ($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $postMethod = true;

    $title = $_POST['title'] ?? null;
    $actors = $_POST['actors'] ?? null;
    $director = $_POST['director'] ?? null;
    $producer = $_POST['producer'] ?? null;
    $yearOfProd = $_POST['yearOfProd'] ?? null;
    $language = $_POST['language'] ?? null;
    $category = $_POST['category'] ?? null;
    $storyline = $_POST['storyline'] ?? null;
    $video = $_POST['video'] ?? null;

}

?>  

  
    <h1>Please fill formular to register a new movie</h1>
    <form method="POST">


<?php 
if ($postMethod) {
    $isThereAnError |= displayError($title, "Title");
}

?>
      <input type="text" name="title" value="<?php echo $_POST['title'] ?? ''?>" placeholder="film title ?" />
      
<?php 
if ($postMethod) {
    $isThereAnError |= displayError($actors, "Actors");
}?>      
      
      <input type="text" name="actors" value="<?php echo $_POST['actors'] ?? ''?>" placeholder="actors ?" />
      
<?php
if ($postMethod) {
    $isThereAnError |= displayError($director, "Director");
}?>
      
      <input type="text" name="director" value="<?php echo $_POST['director'] ?? ''?>" placeholder="director ?" />
<?php
if ($postMethod) {
    $isThereAnError |= displayError($producer, "Producer");
}?>      
      <input type="text" name="producer" value="<?php echo $_POST['producer'] ?? ''?>" placeholder="producer ?" />
  
      <select name="yearOfProd">
 <?php 
 for ($i = 1950; $i <= 2018 ; $i++){
     echo "<option value=\"$i\">$i</option>";
 }
 ?>     
      </select>
      <select name="language">
        <option value="French">French</option>
        <option value="English">English</option>
        <option value="German">German</option>
      </select>
      <select name="category">
        <option value="Comedy">Comedy</option>
        <option value="Drama">Drama</option>
      </select>
<?php
if ($postMethod) {
    $isThereAnError |= displayError($storyline, "Storyline");
}?>       
      <input type="text" name="storyline" value="<?php echo $_POST['storyline'] ?? ''?>" placeholder="storyline ?" />

<?php
// test of the URL
if ($postMethod){

    // This code has been copied from https://stackoverflow.com/questions/2280394/how-can-i-check-if-a-url-exists-via-php
    // and adapted for our needs
    $file_headers = @get_headers($video);
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        echo '<div class="redError">Invalid video URL</div>';
    }
    
}?>      
      
      <input type="text" name="video" value="<?php echo $_POST['video'] ?? ''?>" placeholder="url to video ?" />
      
<?php      
// if there is an error or I have not been called with POST Method, I will show the save button else, I will update the database and
// display that film has been registered.      


if ($isThereAnError || ! $postMethod) {
?>    
      <button type="submit">SAVE</button>
    </form>
<?php     
} else {
    // I close the form
    echo "</form>";
    
    // open connection with DB to insert the movie in the database.
    if ($postMethod){
        try {
            $connection = new PDO('mysql:host=localhost;dbname=exercice_3','root');
        } catch (PDOException $e) {
            echo 'Database error : '. $e->getMessage(). '<br/>';
        }
        
        $sql = "INSERT INTO movies(title, actors, director, producer, year_of_prod, `language`, category, storyline, video)
                    VALUES(:title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video)";
        
        $statement = $connection->prepare($sql);
        $statement->bindValue('title', $title, PDO::PARAM_STR);
        $statement->bindValue('actors', $actors, PDO::PARAM_STR);
        $statement->bindValue('director', $director, PDO::PARAM_STR);
        $statement->bindValue('producer', $producer, PDO::PARAM_STR);
        $statement->bindValue('year_of_prod', $yearOfProd, PDO::PARAM_INT);
        $statement->bindValue('language', $language, PDO::PARAM_STR);
        $statement->bindValue('category', $category, PDO::PARAM_STR);
        $statement->bindValue('storyline', $storyline, PDO::PARAM_STR);
        $statement->bindValue('video', $video, PDO::PARAM_STR);
        
        if(!$statement->execute()){
            echo 'INSERT FAILED';
        } else {
            echo '<h2>Film correctly registered in database !</h2>';
        }
    }
}

?>



    
  </body>
</html>
