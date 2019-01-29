<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "containers";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ContainerID, SensorID, Grootte, Vol, LaatsteVol, Locatie FROM container";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>ContainerID</th><th>SensorID</th><th>Grootte</th><th>Vol</th><th>LaatsteVol</th><th>Locatie</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc())
    echo "<tr><td>".$row["ContainerID"]."</td><td>".$row["SensorID"]."</td><td>".$row["Grootte"]."</td><td>".$row["Vol"]."</td><td>".$row["LaatsteVol"]."</td><td>".$row["Locatie"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
