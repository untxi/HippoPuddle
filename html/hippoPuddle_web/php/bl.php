<!
DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<?php
function saveDB($pWord,$pInText,$pUrl,$pTitle){
  $servername = "localhost";
  $username = "root";
  $password = "myxu";
  $dbname = "hippopuddle";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
 
  $sql = "INSERT INTO `hippopuddle`.`Words` (`Word_ID`, `Word`, `WordsInText`, `Link`, `Title`) VALUES (NULL, 'a', '1', 'a', 'a');"; 
  if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

$conn->close();
}

saveDB("hola", "2", "hola.com", "Saludos");
?>
  
</body>
</html>