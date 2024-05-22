<?php
// Get all users
$url_get_all_users = 'http://localhost:3000/users';
$response_get_all_users = file_get_contents($url_get_all_users);

if ($response_get_all_users === false) {
    echo "Error fetching data from API";
} else {
    $data_get_all_users = json_decode($response_get_all_users, true);
    if (!empty($data_get_all_users)) {
        echo "<h2>All Users</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Username</th></tr>";
        foreach ($data_get_all_users as $user) {
            echo "<tr>";
            echo "<td>" . $user['Id'] . "</td>";
            echo "<td>" . $user['Username'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No users found";
    }
}

// Retrieve a single user by ID
$id = 1; // Change this to the desired user ID
$url_get_single_user = "http://localhost:3000/users/$id";
$response_get_single_user = file_get_contents($url_get_single_user);

if ($response_get_single_user === false) {
    echo "Error fetching data from API";
} else {
    $data_get_single_user = json_decode($response_get_single_user, true);
    if (!empty($data_get_single_user)) {
        echo "<h2>Single User</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Username</th></tr>";
        echo "<tr>";
        echo "<td>" . $data_get_single_user['Id'] . "</td>";
        echo "<td>" . $data_get_single_user['Username'] . "</td>";
        echo "</tr>";
        echo "</table>";
    } else {
        echo "User not found";
    }
}

// Insert a new user
$url_insert_user = 'http://localhost:3000/users';
$data_insert_user = array(
    'Username' => 'new_user',
    'Password' => 'new_password'
);

$options_insert_user = array(
    'http' => array(
        'method' => 'POST',
        'header' => 'Content-type: application/json',
        'content' => json_encode($data_insert_user)
    )
);

$context_insert_user = stream_context_create($options_insert_user);
$response_insert_user = file_get_contents($url_insert_user, false, $context_insert_user);

if ($response_insert_user === false) {
    echo "Error inserting user via API";
} else {
    $result_insert_user = json_decode($response_insert_user, true);
    echo "<h2>Insert Result</h2>";
    echo "<pre>";
    print_r($result_insert_user);
    echo "</pre>";
}
?>
