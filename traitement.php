<?php
try {
    // Establish database connection
    $connexion = new PDO('mysql:host=localhost;dbname=utilisateur', 'root', '');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception

    // Retrieve data using $_POST
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $num = $_POST['num'];
    // Assuming $_POST['photo'] contains the image data, you may need to handle it differently
    // For example, you can use file handling functions in PHP to move the uploaded file to a server directory and store its path in the database.
    $photo = $_POST['photo'];

    // Prepare the SQL statement using a prepared statement
    $stmt = $connexion->prepare("INSERT INTO inscription (nom_user, email, number_user, face_user) VALUES (:nom, :email, :num, :photo)");

    // Bind parameters to the prepared statement
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':num', $num);
    $stmt->bindParam(':photo', $photo); // Assuming $photo is the path to the image file

    // Execute the prepared statement
    $stmt->execute();

    // Redirect after successful insertion
    header('location: accueil.php');
    exit(); // Ensure script execution stops after redirect

} catch (PDOException $e) {
    // Provide appropriate feedback to the user in case of an error
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
