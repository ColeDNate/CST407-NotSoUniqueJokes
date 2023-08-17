<html>
<head>

</head>
 <?php
 session_start();
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 
include "db_connect.php";

$username = $_POST['username'];
$password = $_POST['password'];

echo "<h2>You attempted to login with " . $username . " and " . $password . "</h2>";

$sql = "SELECT user_id, user_name, password FROM users WHERE user_name = ?";

$stmt = mysqli_prepare ($conn, $sql);
$stmt->bind_param("s", $username);

mysqli_stmt_execute($stmt);
$result = $stmt->get_result();

if ($result->num_rows > 0 ) {
    echo "Found 1 person with that username<br>";

    // Fetch the result row before binding results
    $row = $result->fetch_assoc();
    $userid = $row['user_id'];
    $fetched_name = $row['user_name'];
    $fetched_pass = $row['password'];
 
    if (password_verify($password, $fetched_pass)) {
        echo "The password matches<br>";
        echo "Login success<br>"; 
        echo "Attempted session username: " . $_SESSION['username'] . "<br>";
        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $userid;
        exit;
    }
    else {
        echo "Password does not match<br>";
        $_SESSION = [];
    }
    

} else {
    echo "0 results. Not logged in<br>";
    $_SESSION =  [];
}

echo "Session variable = <br>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<br><a href='index.php'>Return to main page</a>";
?>

</html>
