
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $servername = "localhost"; 
    $username = "username";
    $password = "password";
    $dbname = "contact_form"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Ошибка соединения: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Сообщение отправлено и сохранено.";
    } else {
        echo "Ошибка: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
