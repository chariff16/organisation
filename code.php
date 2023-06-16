<?php
if (isset($_POST['login'])) {
    require('dbcon.php');
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    if ($username == NULL || $password == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return ;
    } else if ($password == NULL) {
        $res = [
            'status' => 420,
            'message' => 'Password is mandatory'
        ];
        echo json_encode($res);
        return ;
    } else {
        $sql ="";
    }
}