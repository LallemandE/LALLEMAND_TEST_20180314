<?php
// Check that it is a GET and that a film id has been given

if ($_SERVER['REQUEST_METHOD'] == "GET"){
    $id = $_GET['id'] ?? null;
}

// everything is OK, get film in DB and display info
if ($id){
    // I open the PDO to access DB
    try {
        $connection = new PDO('mysql:host=localhost;dbname=exercice_3','root');
    } catch (PDOException $e) {
    echo 'Database error : '. $e->getMessage(). '<br/>';
    }

    
    // I select just the right film => given ID
    $sql = "SELECT * FROM  movies WHERE id = :id";
    
    $statement = $connection->prepare($sql);
    $statement->bindValue('id', $id, PDO::PARAM_INT);
    
    
    if ($statement->execute()){
        $resultArray = $statement->fetchAll();
        if (count($resultArray)>0){
            // as the movie ID is unique (database definition) we are sure that there is only one record.
            $result = $resultArray[0];
            foreach ($result as $key => $value){
                echo "<p>$key : $value</p>";
            }
          
        } else {
    
            echo "<h2>Movie not found !</h2>";
        }
    } else {
        echo "<h2>DB Statement Error</h2>";
    }
} else {
    echo "<h2>Movie ID is required</h2>";
}