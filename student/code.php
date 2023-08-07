<?php
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