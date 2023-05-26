<!DOCTYPE html>
<html>
<head>
   <title>Лабораорна5_2</title>
     <style>
        body {
            font-family: Arial;
            margin: 20px;
        }

        h1, h2 {
            color: #333;
        }

        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 10px 0;
        }

        label {
            display: inline-block;
            width: 100px;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"] {
            padding: 5px;
            width: 200px;
            margin-bottom: 10px;
        }

        .success-message {
            color: green;
            margin-top: 10px;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Пацієнти впорядковані за зростом</h1>

    <?php
$servername = "localhost";
$username = "root";
$password = "skitoka04";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}


$sql = "SELECT * FROM patient ORDER BY height ";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>Ім'я: " . $row["name"] . "</p>";
        echo "<p>Прізвище: " . $row["surname"] . "</p>";
        echo "<p>Дата народження: " . $row["date_of_birth"] . "</p>";
        echo "<p>Адреса: " . $row["adress"] . "</p>";
        echo "<p>Зріст: " . $row["height"] . "</p>";
        echo "<p>Вага: " . $row["weight"] . "</p>";
        echo "<hr>";
    }
} else {
    echo "Немає записів у таблиці.";
}


$avgWeightSql = "SELECT AVG(weight) AS avg_weight FROM patient";
$avgWeightResult = $conn->query($avgWeightSql);

if ($avgWeightResult->num_rows > 0) {
    $avgWeightRow = $avgWeightResult->fetch_assoc();
    $avgWeight = $avgWeightRow["avg_weight"];
    echo "<h3>Середня вага пацієнтів: " . $avgWeight . "</h3>";
} else {
    echo "Немає даних для обчислення середньої ваги.";
}


$conn->close();
?>
</body>
</html>