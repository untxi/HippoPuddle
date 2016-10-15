<!
DOCTYPE html>
<html>
<body>
 <?php
function saveDB($pWord, $pWordsInText, $pLink, $pTitle){
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

// prepare and bind


// set parameters and execute
$Word = $pWord;
$WordsInText = $pWordsInText;
$Link = $pLink;
$Title = $pTitle;
$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();
}
saveDB("a", 1, "abc.com", "abc");
?> 
</body>
</html>