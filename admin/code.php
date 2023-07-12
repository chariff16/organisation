<?php
    
    if (isset($_POST['addAcc'])) {
        require('../dbcon.php');
        $fname = mysqli_real_escape_string($con, $_POST['fname']);
        $lname = mysqli_real_escape_string($con, $_POST['lname']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $errors = array();
        if ($fname == NULL || $lname == NULL || $username == NULL || $password == NULL ||$phone == NULL ) {
            if ($fname == NULL) {
                $errors['field1'] = 'Field 1 is required';
            }
            if ($lname == NULL) {
                $errors['field2'] = 'Field 2 is required';
            }
            if ($username == NULL) {
                $errors['field3'] = 'Field 3 is required';
            }
            if ($password == NULL) {
                $errors['field4'] = 'Field 4 is required';
            }
            if ($phone == NULL) {
                $errors['field5'] = 'Field 5 is required';
            }
            $res = [
                'code' => 1,
                'message' => 'يرجى إدخال جميع المعلومات',
                'errors' => $errors 
            ];
            echo json_encode($res);
            return ;
        }else {
            $sql = "SELECT * FROM `user` WHERE username = '$username'";
            $run = mysqli_query($con, $sql);
            if (mysqli_num_rows($run) > 0) {
                $res = [
                    'code' => 2,
                    'message' => 'يرجى تغير إسم المستخدم'
                ];
                echo json_encode($res);
                return ;
            }else {
                $hpassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `user`(`id`, `username`, `fname`, `lname`, `phone`, `password`, `role`, `group`) VALUES (NULL ,'$username','$fname','$lname','$phone','$hpassword','admin','0')";
                $run = mysqli_query($con, $sql);
                $res = [
                    'code' => 200,
                    'message' => 'تمت إضافة عضو'
                ];
                echo json_encode($res);
                return ;
            }
        }
    };
    if (isset($_GET['view_account_id'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_GET['view_account_id']);
        $sql = "SELECT * FROM `user` WHERE id = '$id'";
        $run = mysqli_query($con, $sql);
        if ($row = mysqli_fetch_assoc($run)) {
            $res = [
                'code' => 200,
                'message' => 'تمت إضافة عضو',
                'data' => $row
            ];
            echo json_encode($res);
            return ;
        }else {
            $res = [
                'code' => 404,
                'message' => 'يرجى الإتصال بمطور الموقع'
            ];
            echo json_encode($res);
            return ;
        }
    };
    if (isset($_GET['edit_account_id'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_GET['edit_account_id']);
        $sql = "SELECT * FROM `user` WHERE id = '$id'";
        $run = mysqli_query($con, $sql);
        if ($row = mysqli_fetch_assoc($run)) {
            $res = [
                'code' => 200,
                'message' => 'تمت إضافة عضو',
                'data' => $row
            ];
            echo json_encode($res);
            return ;
        }else {
            $res = [
                'code' => 404,
                'message' => 'يرجى الإتصال بمطور الموقع'
            ];
            echo json_encode($res);
            return ;
        }
    };
    if (isset($_POST['editAcc'])) {
        require('../dbcon.php');
        $fname = mysqli_real_escape_string($con, $_POST['fname']);
        $lname = mysqli_real_escape_string($con, $_POST['lname']);
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $errors = array();
        if ($fname == NULL || $lname == NULL || $username == NULL || $phone == NULL) {
            if ($fname == NULL) {
                $errors['field1'] = 'Field 1 is required';
            }
            if ($lname == NULL) {
                $errors['field2'] = 'Field 2 is required';
            }
            if ($username == NULL) {
                $errors['field3'] = 'Field 3 is required';
            }
            if ($phone == NULL) {
                $errors['field4'] = 'Field 4 is required';
            }
            $res = [
                'code' => 1,
                'message' => 'يرجى إدخال جميع المعلومات',
                'errors' => $errors 
            ];
            echo json_encode($res);
            return ;
        }else if (checkUserName($username)) {
                if ($password == NULL) {
                    $sql = "UPDATE `user` SET `username`='$username',`fname`='$fname',`lname`='$lname',`phone`='$phone'";
                    $run = mysqli_query($con, $sql);
                    if ($run) {
                        $res = [
                            'code' => 200,
                            'message' => 'تم تعديل بنجاح'
                        ];
                        echo json_encode($res);
                        return ;
                    }else {
                        $res = [
                            'code' => 404,
                            'message' => 'يرجى الإتصال بمطور الموقع'
                        ];
                        echo json_encode($res);
                        return ;
                    }
                }else {
                    $hpassword = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "UPDATE `user` SET `username`='$username',`fname`='$fname',`lname`='$lname',`phone`='$phone',`password`='$hpassword'";
                    $run = mysqli_query($con, $sql);
                    if ($run) {
                        $res = [
                            'code' => 200,
                            'message' => 'تم تعديل بنجاح'
                        ];
                        echo json_encode($res);
                        return ;
                    }else {
                        $res = [
                            'code' => 404,
                            'message' => 'يرجى الإتصال بمطور الموقع'
                        ];
                        echo json_encode($res);
                        return ;
                    }
                }
            }else {
                $res = [
                    'code' => 2,
                    'message' => 'يرجى تغير إسم المستخدم'
                ];
                echo json_encode($res);
                return ;
            }
    };
    function checkUserName($username) {
        $sql = "SELECT * FROM `user` WHERE username = '$username'";
        $run = mysqli_query($con, $sql);
        if (mysqli_num_rows($run) > 0) {
            return true;
        } else {
            return false;
        }
    };
    if (isset($_GET['deleteAccount'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_GET['deleteAccount']);
        $sql = "DELETE FROM `user` WHERE id = '$id'";
        $run = mysqli_query($con, $sql);
        if ($run) {
            $res = [
                'code' => 200,
                'message' => 'تمت حذف العضو',
                'data' => $row
            ];
            echo json_encode($res);
            return ;
        }else {
            $res = [
                'code' => 404,
                'message' => 'يرجى الإتصال بمطور الموقع'
            ];
            echo json_encode($res);
            return ;
        }
    };
    if (isset($_GET['view_post_id'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_GET['view_post_id']);
        $sql = "SELECT * FROM `postes` WHERE id = '$id'";
        $run = mysqli_query($con, $sql);
        if ($row = mysqli_fetch_assoc($run)) {
            $res = [
                'code' => 200,
                'message' => 'تمت إضافة عضو',
                'data' => $row
            ];
            echo json_encode($res);
            return ;
        }else {
            $res = [
                'code' => 404,
                'message' => 'يرجى الإتصال بمطور الموقع'
            ];
            echo json_encode($res);
            return ;
        }
    };
    if (isset($_GET['deletePost'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_GET['deletePost']);
        $sql = "DELETE FROM `postes` WHERE id = '$id'";
        $run = mysqli_query($con, $sql);
        if ($run) {
            $res = [
                'code' => 200,
                'message' => 'تمت حذف المنشور',
                'data' => $row
            ];
            echo json_encode($res);
            return ;
        }else {
            $res = [
                'code' => 404,
                'message' => 'يرجى الإتصال بمطور الموقع'
            ];
            echo json_encode($res);
            return ;
        }
    };
    if (isset($_POST['addPost'])) {
        require('../dbcon.php');
        $title = mysqli_real_escape_string($con, $_POST['postTitel']);
        $post = mysqli_real_escape_string($con, $_POST['postInput']);
        $errors = array();
        if ($post == NULL || $title == NULL ) {
            if ($post == NULL) {
                $errors['post'] = 'Field 1 is required';
            }
            if ($title == NULL) {
                $errors['title'] = 'Field 2 is required';
            }
            $res = [
                'code' => 1,
                'message' => 'يرجى إدخال جميع المعلومات',
                'errors' => $errors 
            ];
            echo json_encode($res);
            return ;
        }else {
            $sql = "INSERT INTO `postes`(`id`, `titel`, `post`, `date`) VALUES (NULL,'$title','$post',NULL)";
            $run = mysqli_query($con, $sql);
            $res = [
                'code' => 200,
                'message' => 'تمت إضافة المنشور'
            ];
            echo json_encode($res);
            return ;
        }
    };