<?php
session_start();

echo "Session username: " . $_SESSION['username'] . "<br>";

if (! $_SESSION['username']) {
    echo "Only logged in users may access this page.  Click <a href='login_form.php'here </a> to login<br>";
    exit;
}


include "db_connect.php";

$new_joke_question =  addslashes($_GET['newjoke']);
$new_joke_answer =  addslashes($_GET['jokeanswer']);
$userid = $_SESSION['userid'];

echo "<h2>Trying to add a new joke " . $new_joke_question . " and " . $new_joke_answer . "</h2>";
echo "<h2>For user " . $userid . "</h2>";

$sql ="INSERT INTO jokes_table (JokeID, Joke_question, Joke_answer, user_id) VALUES (0, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "ssi", $new_joke_question, $new_joke_answer, $userid);

if (mysqli_stmt_execute($stmt)) {
    echo "Joke creation Success!<br>";
} else {
    echo "Something went wrong.  Not registered.";
}


include "search_all_jokes.php";

echo "<a href = 'index.php'>Return to main</a>";
?>
