<?php
$name = htmlspecialchars($_POST['name'] ?? '');
$prenom = htmlspecialchars($_POST['prénom'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$password = htmlspecialchars($_POST['password'] ?? '');
$message = htmlspecialchars($_POST['message'] ?? '');
$of_age = isset($_POST['of_age']) ? 'Oui' : 'Non';
$avatar = ' https://robohash.org/' . md5(strtolower(trim($email))); 


$dataFile = 'data.json';
if (file_exists($dataFile)) {
    $data = json_decode(file_get_contents($dataFile), true);
} else {
    $data = [];
}

$emailExists = false;
foreach ($data as $user) {
    if ($user['email'] === $email) {
        $emailExists = true;
        break;
    }
}

if ($emailExists) {

    echo json_encode([
        'success' => false,
        'message' => 'Le compte existe déjà.'
    ]);
} else {
    $newUser = [
        'name' => $name,
        'prénom' => $prenom,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'message' => $message,
        'of_age' => $of_age,
        'avatar' => $avatar 
    ];

    $data[] = $newUser;

    file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

    echo json_encode([
        'success' => true,
        'message' => 'Inscription réussie !',
        'user' => $newUser 
    ]);
}
?>
