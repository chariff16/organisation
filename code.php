<?php
if (isset($_POST['login'])) {
    require('dbcon.php');
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    if ($username == NULL || $password == NULL) {
        if ($username == NULL && $password == NULL) {
            $res = [
                'code' => 1,
                'message' => 'أدخل إسم المستخدم و كلمة المرور'
            ];
            echo json_encode($res);
            return ;
        }
        if ($username == NULL && $password !== NULL) {
            $res = [
                'code' => 2,
                'message' => 'أدخل إسم المستخدم'
            ];
            echo json_encode($res);
            return ;
        }
        if ($username !== NULL && $password == NULL) {
            $res = [
                'code' => 3,
                'message' => 'أدخل كلمة المرور'
            ];
            echo json_encode($res);
            return ;
        }
    }else {
        $sql = "SELECT * FROM `user` WHERE username = '$username'";
        $run = mysqli_query($con, $sql);
        if (mysqli_num_rows($run) > 0 ) {
            $row = mysqli_fetch_assoc($run);
            if ($row['password'] == $password) {
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $res = [
                    'code' => 200,
                    'message' => 'كل شيء صحيح'
                ];
                echo json_encode($res);
                return ;
            }else {
                $res = [
                    'code' => 4,
                    'message' => 'كلمة المرور خاطئة'
                ];
                echo json_encode($res);
                return ;
            }
        }else {
            $res = [
                'code' => 404,
                'message' => 'هذا المستخدم غير موجود'
            ];
            echo json_encode($res);
            return ;
        }
    }
}