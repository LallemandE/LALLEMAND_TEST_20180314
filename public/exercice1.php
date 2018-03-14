<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>EXERCICE 1</title>
	</head>
	<body>
		<ul>
<?php
// definition of my array
$myself = [ 'firstname' => 'Eric',
            'lastname' => 'LALLEMAND',
            'address' => '19 rue Mies',
            'postalCode' => '7557',
            'city' => 'Mersch',
            'email' => 'job@lallemand.lu',
            'phone' => '671519665',
            'dateOfBirth' => '1967-06-30'];

foreach ($myself as $key => $value){

    if ($key != 'dateOfBirth'){
        // if not 'dateOfBirth, I have no conversion to do => direct echo of key and value
        echo "<li>$key : $value</li>";
    } else { // in case of "dateOfBirth", I have to convert the date
        echo "<li>$key : ";

        // use of object DateTime class to convert date format for the display
        $dateOfBirth = DateTime::createFromFormat('Y-m-d', $value);
        echo $dateOfBirth->format('d/m/Y');

        echo "</li>";
    }
   
}

?>


    </ul>

</body>
</html>