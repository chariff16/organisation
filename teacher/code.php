<?php
if (isset($_POST['addExam'])) {
    require('../dbcon.php');
    $class = mysqli_real_escape_string($con, $_POST['classAdded']);
    $grade = mysqli_real_escape_string($con, $_POST['gradeAdded']);
    $studentId = mysqli_real_escape_string($con, $_POST['studentId']);
    $errors = array();
    if ($class == NULL || $grade == NULL) {
        if ($class == NULL) {
            $errors['class'] = 'Field 1 is required';
        }
        if ($grade == NULL) {
            $errors['grade'] = 'Field 2 is required';
        }
        $res = [
            'code' => 1,
            'message' => 'يرجى إدخال جميع المعلومات',
            'errors' => $errors 
        ];
        echo json_encode($res);
        return ;
    }else {
        $sql = "INSERT INTO `exam`(`id`, `studentid`, `class`, `grades`, `date`) VALUES (NULL,'$studentId','$class','$grade', NULL)";
        $run = mysqli_query($con, $sql);
        if ($run) {
            $res = [
                'code' => 200,
                'message' => 'تمت إضافة الإختبار'
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
if (isset($_GET['edit_exam_id'])) {
    require('../dbcon.php');
    $id = mysqli_real_escape_string($con, $_GET['edit_exam_id']);
    $sql = "SELECT * FROM `exam` WHERE id = '$id'";
    $run = mysqli_query($con, $sql);
    if ($row = mysqli_fetch_assoc($run)) {
        $res = [
            'code' => 200,
            'message' => 'تمت إضافة الاختبار',
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
if (isset($_POST['editExam'])) {
    require('../dbcon.php');
    $id = mysqli_real_escape_string($con, $_POST['editExamId']);
    $class = mysqli_real_escape_string($con, $_POST['editClass']);
    $grade = mysqli_real_escape_string($con, $_POST['editGrade']);
    $errors = array();
    if ($class == NULL || $grade == NULL) {
        if ($class == NULL) {
            $errors['class'] = 'Field 1 is required';
        }
        if ($grade == NULL) {
            $errors['grade'] = 'Field 2 is required';
        }
        $res = [
            'code' => 1,
            'message' => 'يرجى إدخال جميع المعلومات',
            'errors' => $errors 
        ];
        echo json_encode($res);
        return ;
    }else {
        $sql = "UPDATE `exam` SET `class`='$class',`grades`='$grade' WHERE id = '$id'";
        $run = mysqli_query($con, $sql);
        if ($run) {
            $res = [
                'code' => 200,
                'message' => 'تم تحديث الاختبار'
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
if (isset($_GET['deleteExam'])) {
    require('../dbcon.php');
    $id = mysqli_real_escape_string($con, $_GET['deleteExam']);
    $sql = "DELETE FROM `exam` WHERE id = '$id'";
    $run = mysqli_query($con, $sql);
    if ($run) {
        $res = [
            'code' => 200,
            'message' => 'تمت حذف الاختبار'
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