<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Accordion - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion();
  } );
  </script>
</head><?php

include "db_connect.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
$keywordfromform = $_GET['keyword'];
echo "this is our keyword: " . $keywordfromform . "<br>";

echo "<h2>Show all jokes with the word " . $keywordfromform . "</h2>";
$keywordfromform = "%" . $keywordfromform . "%";

$stmt = mysqli_prepare($conn, "SELECT JokeID, Joke_question, Joke_answer, jokes_table.user_id, user_name 
                          FROM jokes.jokes_table JOIN jokes.users 
                          ON jokes_table.user_id = users.user_id 
                          WHERE Joke_question LIKE ?");

$stmt->bind_param("s", $keywordfromform);

mysqli_stmt_execute($stmt);
$result = $stmt->get_result();

mysqli_stmt_close($stmt);

if ($result->num_rows > 0) {
    // output data of each row

    echo "<div id='accordion'>";
    while($row = $result->fetch_assoc()) {
        $safe_joke_question = $row['Joke_question'];
        $safe_joke_answer = $row['Joke_answer'];

        echo "<h3>" . $safe_joke_question . "</h3>";
        
        echo "<div><p>" . $safe_joke_answer  . " -- Submitted by user " . $username ."</p></div>";
    }

    echo "</div>";
} else {
    echo "0 results";
}
?>
