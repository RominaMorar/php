<!DOCTYPE html>
<html>
<head>
   <title>Лабораорна5_1</title>
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

        input[type="submit"] {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
    <h1>Інформація з бази даних</h1>

    <?php
$servername = "localhost";
$username = "root";
$password = "skitoka04";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}

$sql = "SELECT * FROM patient";
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $date_of_birth = $_POST["date_of_birth"];
    $adress = $_POST["adress"];
    $height = $_POST["height"];
    $weight = $_POST["weight"];

    $insertSql = "INSERT INTO patient (name, surname, date_of_birth, adress, height, weight) VALUES ('$name', '$surname', '$date_of_birth', '$adress', '$height', '$weight')";
    if ($conn->query($insertSql) === TRUE) {
        echo "Запис успішно додано.";
    } else {
        echo "Помилка при додаванні запису: " . $conn->error;
    }
}


$conn->close();
?>

    <h2>Додати новий запис</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Ім'я:</label>
        <input type="text" name="name" required><br>
        <label for="surname">Прізвище:</label>
        <input type="text" name="surname" required><br>
        <label for="date_of_birth">Дата народження:</label>
        <input type="date" name="date_of_birth" required><br>
        <label for="adress">Адреса:</label>
        <input type="text" name="adress" required><br>
        <label for="height">Зріст:</label>
        <input type="number" name="height" required><br>
        <label for="weight">Вага:</label>
        <input type="number" name="weight" required><br>
        <input type="submit" value="Додати">
    </form>
</body>
</html>
