<?php
header('Content-Type: application/json');
$jsonData = file_get_contents('course_marseille.json');

$courses = json_decode($jsonData, true);

// Vérifier si un ID est passé dans l'URL (par exemple: course.php?id=vieuxPort)
if (isset($_GET['id'])) {
    $requestedId = $_GET['id'];
    $foundCourse = null;

    // Boucle à travers les courses pour trouver celle qui correspond à l'ID
    foreach ($courses as $course) {
        if ($course['id'] == $requestedId) {
            $foundCourse = $course;
            break;
        }
    }

    if ($foundCourse) {
        echo json_encode($foundCourse);
    } else {
        echo json_encode(["error" => "Course not found"]);
    }
} else {
    echo json_encode(["error" => "No course ID provided"]);
}
?>
