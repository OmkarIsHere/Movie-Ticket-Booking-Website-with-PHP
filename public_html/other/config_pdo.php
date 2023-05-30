<?Php
$host_name = "localhost";
$database = "id20121598_movietime"; // Change your database nae
$username = "id20121598_root";          // Your database user id 
$password = "Movietime@123";          // Your password

//////// Don't Edit below /////////
try {
$dbo = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
echo "<br><br><font color=red>Check MySQL login details inside <b>config.php</b> file</font>";
die();
}
?>