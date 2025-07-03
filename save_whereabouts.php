<?php
date_default_timezone_set("Asia/Manila");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacher = trim($_POST["teacher"] ?? "");
    $status = trim($_POST["status"] ?? "");

    if ($teacher === "" || $status === "") {
        exit("❌ Invalid input.");
    }

    $file = "whereabouts.json";

    $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    $data[$teacher] = [
        "status" => $status,
        "time" => date("Y-m-d H:i:s")
    ];

    if (file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT))) {
        echo "✅ Status updated for $teacher.";
    } else {
        echo "❌ Failed to save data.";
    }
}
?>
