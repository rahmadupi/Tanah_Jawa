<?php
$host = "localhost";
$username = "root"; 
$password = "";     
$database = "kuissejarah"; 

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT `text`, `Option1`, `Option2`, `Option3`, `Option4`, `KunciJawaban` 
        FROM banksoal 
        ORDER BY RAND()
        LIMIT 10";

$result = $conn->query($sql);

$questions = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = [
            "text" => $row["text"],
            "options" => [
                $row["Option1"],
                $row["Option2"],
                $row["Option3"],
                $row["Option4"]
            ],
            "correctIndex" => (int)$row["KunciJawaban"]
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($questions);

$conn->close();
?>
