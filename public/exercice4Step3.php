<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>EXERCICE 1</title>
	</head>
	<body>
<h1>Our Films</h1>
<?php

try {
    $connection = new PDO('mysql:host=localhost;dbname=exercice_3','root');
} catch (PDOException $e) {
echo 'Database error : '. $e->getMessage(). '<br/>';
}

$sql = "SELECT * FROM  movies";

$statement = $connection->prepare($sql);

if ($statement->execute()){
    $resultArray = $statement->fetchAll();
    
    // I check that there is at least 1 film in my database else, I will not create my table
    if (count($resultArray) > 0){
        echo "<TABLE>";
        foreach ($resultArray as $result){
            echo '<tr>';
            echo '<td>' . $result['title'] . '</td>';
            echo '<td>' . $result['director'] . '</td>';
            echo '<td>' . $result['year_of_prod'] . '</td>';
            echo '<td><a href="exercice4Step4.php?id='. $result['id']. '">See more info</a></td>';
            echo '</tr>' . "\n"; 
        }
        echo "</TABLE>";
    }
}
?>

</body>
</html>