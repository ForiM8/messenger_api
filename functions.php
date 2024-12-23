<?php
function getUserPosts($connect) {
    $posts = mysqli_query($connect, "SELECT * FROM users");
    $postsList = [];

    while ($post = mysqli_fetch_assoc($posts)) {
        $postsList[] = $post;
    }
    http_response_code(200);
    echo json_encode($postsList);
}

function getUserMessengerPosts($connect) {
    $posts = mysqli_query($connect, "SELECT * FROM userMessenger");
    $postsList = [];

    while ($post = mysqli_fetch_assoc($posts)) {
        $postsList[] = $post;
    }
    http_response_code(200);
    echo json_encode($postsList);
}

function getUserPost($connect, $id) {
    $post = mysqli_query($connect, "SELECT * FROM users WHERE id = $id");

    if (mysqli_num_rows($post) === 0) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "post not found"
        ];
        echo json_encode($res);
    } else {
        $post = mysqli_fetch_assoc($post);
        echo json_encode($post);
    }
}

function getUserMessengerPost($connect, $apiId) {
    $post = mysqli_query($connect, "SELECT * FROM userMessenger WHERE id = $apiId");

    if (mysqli_num_rows($post) === 0) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "post not found"
        ];
        echo json_encode($res);
    } else {
        $post = mysqli_fetch_assoc($post);
        echo json_encode($post);
    }
}

function getUserNamePost($connect, $name) {
    $post = mysqli_query($connect, "SELECT * FROM users WHERE name = '$name'");

    if (mysqli_num_rows($post) === 0) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "post not found"
        ];
        echo json_encode($res);
    } else {
        $post = mysqli_fetch_assoc($post);
        echo json_encode($post);
    }
}

function getQuesPosts($connect) {
    $posts = mysqli_query($connect, "SELECT * FROM questions");
    $postsList = [];

    while ($post = mysqli_fetch_assoc($posts)) {
        $postsList[] = $post;
    }
    http_response_code(200);
    echo json_encode($postsList);
}

function getQuesPost($connect, $id) {
    $post = mysqli_query($connect, "SELECT * FROM questions WHERE id = $id");

    if (mysqli_num_rows($post) === 0) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "post not found"
        ];
        echo json_encode($res);
    } else {
        $post = mysqli_fetch_assoc($post);
        echo json_encode($post);
    }
}

function addUser($connect, $data) {
    $name = $data['name'];
    $score = $data['score'];
    $create_at = $data['create_at'];
    $update_at = $data['update_at'];

    $sql = "INSERT INTO users (name, score, create_at, update_at)
            VALUES ('$name', '$score', '$create_at', '$update_at')";

    if (mysqli_query($connect, $sql)) {
        $user_id = mysqli_insert_id($connect);
        http_response_code(201);
        $res = [
            "status" => true,
            "user_id" => $user_id
        ];
        echo json_encode($res);
    }
}

function addUserMessenger($connect, $data) {
    $user = $data['user'];
    $text = $data['text'];
    $ip_address = $data['ip_address'];
    $create_ad = $data['create_at'];
    $update_at = $data['update_at'];

    $sql = "INSERT INTO `userMessenger` (`id`, `user`, `text`, `ip_address`, `create_ad`, `updated_at`) VALUES (NULL, '$user', '$text', '$ip_address', '$create_ad', '$update_at')";

    if (mysqli_query($connect, $sql)) {
        $user_id = mysqli_insert_id($connect);
        http_response_code(201);
        $res = [
            "status" => true,
            "user_id" => $user_id
        ];
        echo json_encode($res);
    }
}

function addQues($connect, $data) {
    $title = $data['title'];
    $image = $data['image'];
    $question_1 = $data['question_1'];
    $question_2 = $data['question_2'];
    $question_3 = $data['question_3'];
    $answer = $data['answer'];
    $is_del = $data['is_del'];
    $create_at = $data['create_at'];
    $update_at = $data['update_at'];

    mysqli_query($connect, "INSERT INTO questions (id, title, image, question_1, question_2, question_3, answer, is_del, create_at, update_up) VALUES (NULL, '$title', '$image', '$question_1', '$question_2', '$question_3', '$answer', '$is_del', '$create_at', '$update_at')");
    http_response_code(201);
    $res = [
        "status" => true,
        "user_id" => mysqli_insert_id($connect)
    ];
    echo json_encode($res);
}

function updateUser($connect, $id ,$data){
    
    $name = $data['name'];
    $score = $data['score'];
    
    mysqli_query($connect, "UPDATE `users` SET `score` = '$score' WHERE `users`.`id` = $id");
    http_response_code(200);
    $res = [
        "status" => true,
        "message" => "Post is updated"
    ];
    echo json_encode($res);
}
?>


