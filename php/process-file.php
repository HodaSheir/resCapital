<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];

    // Validate and handle the uploaded image
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 2 * 1024 * 1024; // 2MB

        $uploadedFile = $_FILES['user_image'];

        if (in_array($uploadedFile['type'], $allowedTypes) && $uploadedFile['size'] <= $maxFileSize) {
            $imagePath = 'uploads/' . uniqid() . '_' . $uploadedFile['name'];
            move_uploaded_file($uploadedFile['tmp_name'], $imagePath);

            // Save user data and image path to the database
            $db = new PDO('mysql:host=localhost;dbname=user_management', 'root', '');
            $stmt = $db->prepare("INSERT INTO users (first_name, last_name, image_path) VALUES (?, ?, ?)");
            $stmt->execute([$firstName, $lastName, $imagePath]);

            echo "User data saved successfully!";
            
        } else {
            echo "Invalid image format or size. Please upload a valid image (JPEG, PNG, GIF) not exceeding 2MB.";
        }
    } else {
        echo "Error uploading image.";
    }
}
?>