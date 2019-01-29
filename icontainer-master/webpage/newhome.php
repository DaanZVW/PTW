<?php
require "iContainer/hoofdpagina.php";
?>

<html>
<script type="text/javascript">
  function dbbutton() {
    var database = document.getElementById("db");
    if (database.style.display === "none") {
      database.style.display = "inline";
    } else {
      database.style.display = "none";
    }

  }
</script>
  <link rel="stylesheet" href="main.css">
<head>
  <h1>
    <img src="iContainer.png" alt="logo" width=20% height: auto>
  </h1>
  <h1>
    <a href="javascript:dbbutton();" class="button1">Database</a>
    <div class="divider"/> </div>
    <a href="TBD" class="button1">Route</a>
    <div class="divider"/> </div>
    <a href="TBD" class="button1">Status</a>
  </h1>
</head>
<style>
.db {
  border: none;
  border-collapse: collapse;
  margin: 0px auto;
  display: none;
}
table, th, td {
  border: none;
  font-family:Arial;
  font-size:16.5px;
	color: white;
}

th, td {
  padding: 20px;
}
td{
  border-bottom: 1px solid #0f0f0f;
}
th {
  font-size: 20px;
  border-bottom: 1px solid white;
}

tr:hover td {
  background: #0f0f0f;
}
</style>
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
  echo "<table class='db' id='db'><tr><th>ContainerID</th><th>SensorID</th><th>Grootte(m3)</th><th>Vol?</th><th>Laatste keer vol</th><th>Locatie</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["ContainerID"]."</td><td>".$row["SensorID"]."</td><td>".$row["Grootte"]."</td><td>".$row["Vol"]."</td><td>".$row["LaatsteVol"]."</td><td>".$row["Locatie"]."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";
    
}
$conn->close();
?>
<body>

</body>
</html>
