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
    if (isset($_GET['edit_post_id'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_GET['edit_post_id']);
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
    if (isset($_POST['editPost'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_POST['editPostId']);
        $title = mysqli_real_escape_string($con, $_POST['postTitel']);
        $post = mysqli_real_escape_string($con, $_POST['postInput']);
        $errors = array();
        if ($post == NULL || $title == NULL ) {
            if ($title == NULL) {
                $errors['title'] = 'Field 1 is required';
            }
            if ($lname == NULL) {
                $errors['post'] = 'Field 2 is required';
            }
            $res = [
                'code' => 1,
                'message' => 'يرجى إدخال جميع المعلومات',
                'errors' => $errors 
            ];
            echo json_encode($res);
            return ;
        }else {
            $sql = "UPDATE `postes` SET `titel`='$title',`post`='$post',`date`= NULL WHERE id = '$id'";
            $run = mysqli_query($con, $sql);
            if ($run) {
                $res = [
                    'code' => 200,
                    'message' => 'تم تحديث المنشور'
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
    };
    if (isset($_POST['addDonner'])) {
        require('../dbcon.php');
        $fname = mysqli_real_escape_string($con, $_POST['donnerFname']);
        $lname = mysqli_real_escape_string($con, $_POST['donnerLname']);
        $phone = mysqli_real_escape_string($con, $_POST['donnerPhone']);
        $funds = mysqli_real_escape_string($con, $_POST['donnerFunds']);
        $errors = array();
        if ($fname == NULL || $lname == NULL || $phone == NULL || $funds == NULL ) {
            if ($fname == NULL) {
                $errors['fname'] = 'Field 1 is required';
            }
            if ($lname == NULL) {
                $errors['lname'] = 'Field 2 is required';
            }
            if ($phone == NULL) {
                $errors['phone'] = 'Field 1 is required';
            }
            if ($funds == NULL) {
                $errors['funds'] = 'Field 2 is required';
            }
            $res = [
                'code' => 1,
                'message' => 'يرجى إدخال جميع المعلومات',
                'errors' => $errors 
            ];
            echo json_encode($res);
            return ;
        }else {
            $sql = "INSERT INTO `donner`(`id`, `fname`, `lname`, `phone`) VALUES (NULL,'$fname','$lname','$phone')";
            $run = mysqli_query($con, $sql);
            if ($run) {
                $sql2 = "SELECT * FROM `donner` ORDER BY id DESC";
                $run2 = mysqli_query($con, $sql2);
                $row = mysqli_fetch_assoc($run2);
                $donnerid = $row['id'];
                $sql3 = "INSERT INTO `funds`(`id`, `donner_id`, `fund`, `date`) VALUES (NULL,'$donnerid','$funds',NULL)";
                $run3 = mysqli_query($con, $sql3);
                if ($run3) {
                    $res = [
                        'code' => 200,
                        'message' => 'تمت إضافة المحسن'
                    ];
                    echo json_encode($res);
                    return ;
                }else {
                    $res = [
                        'code' => 500,
                        'message' => 'يجرى الاتصال بمطور الموقع'
                    ];
                    echo json_encode($res);
                    return ;
                }
            }
            
        }
    };
    if (isset($_GET['deleteDonner'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_GET['deleteDonner']);
        $sql = "DELETE FROM `donner` WHERE id = '$id'";
        $run = mysqli_query($con, $sql);
        if ($run) {
            $res = [
                'code' => 200,
                'message' => 'تمت حذف المحسن',
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
    if (isset($_GET['edit_donner_id'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_GET['edit_donner_id']);
        $sql = "SELECT * FROM `donner` WHERE id = '$id'";
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
    if (isset($_POST['editDonner'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_POST['editDonnerId']);
        $fname = mysqli_real_escape_string($con, $_POST['editDonnerFname']);
        $lname = mysqli_real_escape_string($con, $_POST['editDonnerLname']);
        $phone = mysqli_real_escape_string($con, $_POST['editDonnerPhone']);
        $errors = array();
        if ($lname == NULL || $fname == NULL || $phone == NULL) {
            if ($lname == NULL) {
                $errors['lname'] = 'Field 1 is required';
            }
            if ($fname == NULL) {
                $errors['fname'] = 'Field 2 is required';
            }
            if ($phone == NULL) {
                $errors['phone'] = 'Field 2 is required';
            }
            $res = [
                'code' => 1,
                'message' => 'يرجى إدخال جميع المعلومات',
                'errors' => $errors 
            ];
            echo json_encode($res);
            return ;
        }else {
            $sql = "UPDATE `donner` SET `fname`='$fname',`lname`='$lname',`phone`='$phone' WHERE id = '$id'";
            $run = mysqli_query($con, $sql);
            if ($run) {
                $res = [
                    'code' => 200,
                    'message' => 'تم تحديث المنشور'
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
    };
    if (isset($_POST['addFunds'])) {
        require('../dbcon.php');
        $fund = mysqli_real_escape_string($con, $_POST['fundAdded']);
        $donnerId = mysqli_real_escape_string($con, $_POST['donnerId']);
        if ($fund == NULL) {
            $res = [
                'code' => 1,
                'message' => 'يرجى إدخال جميع المعلومات'
            ];
            echo json_encode($res);
            return ;
        }else {
            $sql = "INSERT INTO `funds`(`id`, `donner_id`, `fund`, `date`) VALUES (NULL,'$donnerId','$fund',NULL)";
            $run = mysqli_query($con, $sql);
            if ($run) {
                $res = [
                    'code' => 200,
                    'message' => 'تمت إضافة التبرع'
                ];
                echo json_encode($res);
                return ;
            }else {
                $res = [
                    'code' => 500,
                    'message' => 'يجرى الاتصال بمطور الموقع'
                ];
                echo json_encode($res);
                return ;
            }
            
        }
    };
    if (isset($_GET['edit_fund_id'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_GET['edit_fund_id']);
        $sql = "SELECT * FROM `funds` WHERE id = '$id'";
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
    if (isset($_POST['editFunds'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_POST['editFundId']);
        $fund = mysqli_real_escape_string($con, $_POST['editFundsInput']);
        if ($fund == NULL) {
            $res = [
                'code' => 1,
                'message' => 'يرجى إدخال جميع المعلومات'
            ];
            echo json_encode($res);
            return ;
        }else {
            $sql = "UPDATE `funds` SET `fund`='$fund' WHERE id = '$id'";
            $run = mysqli_query($con, $sql);
            if ($run) {
                $res = [
                    'code' => 200,
                    'message' => 'تم تحديث المنشور'
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
    };
    if (isset($_GET['deleteFund'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_GET['deleteFund']);
        $sql = "DELETE FROM `funds` WHERE id = '$id'";
        $run = mysqli_query($con, $sql);
        if ($run) {
            $res = [
                'code' => 200,
                'message' => 'تمت حذف التبرع',
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
    if (isset($_POST['addStudent'])) {
        require('../dbcon.php');
        $fname = mysqli_real_escape_string($con, $_POST['studentFname']);
        $lname = mysqli_real_escape_string($con, $_POST['studentLname']);
        $username = mysqli_real_escape_string($con, $_POST['studentUsername']);
        $password = mysqli_real_escape_string($con, $_POST['studentPassword']);
        $phone = mysqli_real_escape_string($con, $_POST['studentPhone']);
        $class = mysqli_real_escape_string($con, $_POST['studentClass']);
        $errors = array();
        if ($fname == NULL || $lname == NULL || $username == NULL || $password == NULL ||$phone == NULL || $class == NULL ) {
            if ($fname == NULL) {
                $errors['fname'] = 'Field 1 is required';
            }
            if ($lname == NULL) {
                $errors['lname'] = 'Field 2 is required';
            }
            if ($username == NULL) {
                $errors['username'] = 'Field 3 is required';
            }
            if ($password == NULL) {
                $errors['password'] = 'Field 4 is required';
            }
            if ($phone == NULL) {
                $errors['phone'] = 'Field 5 is required';
            }
            if ($class == NULL) {
                $errors['class'] = 'Field 6 is required';
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
                $sql = "INSERT INTO `user`(`id`, `username`, `fname`, `lname`, `phone`, `password`, `role`, `group`) VALUES (NULL ,'$username','$fname','$lname','$phone','$hpassword','student','$class')";
                $run = mysqli_query($con, $sql);
                $res = [
                    'code' => 200,
                    'message' => 'تمت إضافة طالب'
                ];
                echo json_encode($res);
                return ;
            }
        }
    };
    if (isset($_GET['edit_student_id'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_GET['edit_student_id']);
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
    if (isset($_POST['editStudent'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_POST['editStudentId']);
        $fname = mysqli_real_escape_string($con, $_POST['editStudentFname']);
        $lname = mysqli_real_escape_string($con, $_POST['editStudentLname']);
        $username = mysqli_real_escape_string($con, $_POST['editStudentUsername']);
        $password = mysqli_real_escape_string($con, $_POST['editStudentPassword']);
        $phone = mysqli_real_escape_string($con, $_POST['editStudentPhone']);
        $class = mysqli_real_escape_string($con, $_POST['editStudentClass']);
        $errors = array();
        if ($fname == NULL || $lname == NULL || $username == NULL || $phone == NULL || $class == NULL) {
            if ($fname == NULL) {
                $errors['fname'] = 'Field 1 is required';
            }
            if ($lname == NULL) {
                $errors['lname'] = 'Field 2 is required';
            }
            if ($username == NULL) {
                $errors['username'] = 'Field 3 is required';
            }
            if ($phone == NULL) {
                $errors['phone'] = 'Field 4 is required';
            }
            if ($class == NULL) {
                $errors['class'] = 'Field 5 is required';
            }
            $res = [
                'code' => 1,
                'message' => 'يرجى إدخال جميع المعلومات',
                'errors' => $errors 
            ];
            echo json_encode($res);
            return ;
        }else if ($password == NULL) {
            $sql = "UPDATE `user` SET `username`='$username',`fname`='$fname',`lname`='$lname',`phone`='$phone',`role`='student',`group`='$class' WHERE id = '$id'";
            $run = mysqli_query($con, $sql);
            if ($run) {
                $res = [
                    'code' => 200,
                    'message' => 'تم تحديث المعلومات'
                ];
                echo json_encode($res);
            }
        }else {
            $hpassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE `user` SET `username`='$username',`fname`='$fname',`lname`='$lname',`phone`='$phone',`password`='$hpassword',`role`='student',`group`='$class' WHERE id = '$id'";
            $run = mysqli_query($con, $sql);
            if ($run) {
                $res = [
                    'code' => 200,
                    'message' => 'تم تحديث المعلومات'
                ];
                echo json_encode($res);
            }
        }
    };
    if (isset($_GET['deleteStudent'])) {
        require('../dbcon.php');
        $id = mysqli_real_escape_string($con, $_GET['deleteStudent']);
        $sql = "DELETE FROM `user` WHERE id = '$id'";
        $run = mysqli_query($con, $sql);
        if ($run) {
            $res = [
                'code' => 200,
                'message' => 'تمت حذف الطالب',
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