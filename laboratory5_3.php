<!DOCTYPE html>
<html>
<head>
   <title>Лабораторна 5_2</title>
     <style>
        body {
            font-family: Arial, sans-serif;
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

        table {
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Пацієнти з заданими символами у прізвищі</h1>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="search">Задані символи:</label>
        <input type="text" name="search" required>
        <input type="submit" value="Пошук">
    </form>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "skitoka04";
        $dbname = "database";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Помилка підключення до бази даних: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search = $_POST["search"];

            $sql = "SELECT * FROM patient WHERE surname LIKE '%$search%'";
            $result = $conn->query($sql);

            
            if ($result->num_rows > 0) {
                echo "<h2>Результати пошуку</h2>";
                echo "<table>";
                echo "<tr><th>Ім'я</th><th>Прізвище</th><th>Дата народження</th><th>Адреса</th><th>Зріст</th><th>Вага</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["surname"] . "</td>";
                    echo "<td>" . $row["date_of_birth"] . "</td>";
                    echo "<td>" . $row["adress"] . "</td>";
                    echo "<td>" . $row["height"] . "</td>";
                    echo "<td>" . $row["weight"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='error-message'>Немає пацієнтів з заданими символами у прізвищі.</p>";
            }
        }

        $conn->close();
    ?>
</body>
</html>
