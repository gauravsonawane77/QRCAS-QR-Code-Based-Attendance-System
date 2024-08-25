<?php
// print_r($_GET);
require "conn.php";
session_start();

if (isset($_GET['data'])) {
    $data = $_GET['data'];
    $decryptQR = base64_decode($data);
    $arrQRData = json_decode($decryptQR);
    $enrollment_no = $_SESSION['enrollment_no'];

    // print_r($arrQRData);
    $subject_code = $arrQRData->subject_code;
    $day = $arrQRData->day;
    $slot = $arrQRData->slot;
    $batch = $arrQRData->batch;
    $currentDate = date('d-m-Y');
    $currentDay = date('l');
    $currentTime = $date = date('h:i:s a', time());

    $sql = "SELECT * FROM `students` WHERE `batch`='$batch' AND `shift`='$slot'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 1) {

        $csql = "SELECT * FROM `attendance` WHERE `date`='$currentDate' AND `enrollment_no`=$enrollment_no AND `subject_code`=$subject_code AND `slot`=$slot AND `batch`='$batch'";
        $cres = mysqli_query($conn, $csql);
        if ($cres->num_rows == 0) {
            $fsql = "INSERT INTO `attendance`(`enrollment_no`, `date`, `day`, `subject_code`, `slot`, `batch`, `time`) VALUES ('$enrollment_no','$currentDate','$currentDay', '$subject_code','$slot','$batch','$currentTime')";
            $fres = mysqli_query($conn, $fsql);
            if ($fres) {
                $_SESSION['msg'] = '<div class="alert alert-success mb-2" role="alert">
                Attendance Marked!.
                </div>';
                header("location: give_attend.php");
                exit();
            } else {
                $_SESSION['msg'] = '<div class="alert alert-danger mb-2" role="alert">
                Something went wrong!.
                </div>';
                header("location: give_attend.php");
                exit();
            }
        } else {
            $_SESSION['msg'] = '<div class="alert alert-warning mb-2" role="alert">
        Attendance Already Marked!.
        </div>';
            header("location: give_attend.php");
            exit();
        }
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger mb-2" role="alert">
        This Batch & Slot Not Allocate to you!.
        </div>';
        header("location: give_attend.php");
        exit();
    }
}
