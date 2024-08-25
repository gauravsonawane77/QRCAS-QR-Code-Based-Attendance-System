<?php
// print_r($_POST);
require "conn.php";
session_start();
if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {

    if (isset($_GET['type']) && $_GET['type'] == "add") {
        $academic_year = $_POST['academicyear'];
        $semester = $_POST['semester'];
        $batch = $_POST['batch'];

        $monday1 = $_POST['Monday_1'];
        $monday2 = $_POST['Monday_2'];
        $monday3 = $_POST['Monday_3'];

        $tuesday1 = $_POST['Tuesday_1'];
        $tuesday2 = $_POST['Tuesday_2'];
        $tuesday3 = $_POST['Tuesday_3'];

        $Wednesday1 = $_POST['Wednesday_1'];
        $Wednesday2 = $_POST['Wednesday_2'];
        $Wednesday3 = $_POST['Wednesday_3'];

        $Thursday1 = $_POST['Thursday_1'];
        $Thursday2 = $_POST['Thursday_2'];
        $Thursday3 = $_POST['Thursday_3'];

        $Friday1 = $_POST['Friday_1'];
        $Friday2 = $_POST['Friday_2'];
        $Friday3 = $_POST['Friday_3'];

        $Saturday1 = $_POST['Saturday_1'];
        $Saturday2 = $_POST['Saturday_2'];
        $Saturday3 = $_POST['Saturday_3'];


        $sqlmonday1 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Monday','1','$monday1','$academic_year')";
        $result = mysqli_query($conn, $sqlmonday1);

        $sqlmonday2 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Monday','2','$monday2','$academic_year')";
        $result = mysqli_query($conn, $sqlmonday2);

        $sqlmonday3 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Monday','3','$monday3','$academic_year')";
        $result = mysqli_query($conn, $sqlmonday3);
        //ddddddddddddddddddddddddddddddd
        $sqltuesday1 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Tuesday','1','$tuesday1','$academic_year')";
        $result = mysqli_query($conn, $sqltuesday1);

        $sqltuesday2 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Tuesday','2','$tuesday2','$academic_year')";
        $result = mysqli_query($conn, $sqltuesday2);

        $sqltuesday3 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Tuesday','3','$tuesday3','$academic_year')";
        $result = mysqli_query($conn, $sqltuesday3);
        //ddddddddddddddddddddddddddd
        $sqlWednesday1 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Wednesday','1','$Wednesday1','$academic_year')";
        $result = mysqli_query($conn, $sqlWednesday1);

        $sqlWednesday2 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Wednesday','2','$Wednesday2','$academic_year')";
        $result = mysqli_query($conn, $sqlWednesday2);

        $sqlWednesday3 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Wednesday','3','$Wednesday3','$academic_year')";
        $result = mysqli_query($conn, $sqlWednesday3);
        //ddddddddddddddddddddddddddd
        $sqlThursday1 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Thursday','1','$Thursday1','$academic_year')";
        $result = mysqli_query($conn, $sqlThursday1);

        $sqlThursday2 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Thursday','2','$Thursday2','$academic_year')";
        $result = mysqli_query($conn, $sqlThursday2);

        $sqlThursday3 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Thursday','3','$Thursday3','$academic_year')";
        $result = mysqli_query($conn, $sqlThursday3);
        //ddddddddddddddddddddddddddd
        $sqlFriday1 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Friday','1','$Friday1','$academic_year')";
        $result = mysqli_query($conn, $sqlFriday1);

        $sqlFriday2 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Friday','2','$Friday2','$academic_year')";
        $result = mysqli_query($conn, $sqlFriday2);

        $sqlFriday3 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Friday','3','$Friday3','$academic_year')";
        $result = mysqli_query($conn, $sqlFriday3);
        //ddddddddddddddddddddddddddd
        $sqlSaturday1 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Saturday','1','$Saturday1','$academic_year')";
        $result = mysqli_query($conn, $sqlSaturday1);

        $sqlSaturday2 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Saturday','2','$Saturday2','$academic_year')";
        $result = mysqli_query($conn, $sqlSaturday2);

        $sqlSaturday3 = "INSERT INTO `timetable`(`semester`, `batch`, `day`, `slot`, `subject_code`, `academic_year`) VALUES ('$semester','$batch','Saturday','3','$Saturday3','$academic_year')";
        $result = mysqli_query($conn, $sqlSaturday3);

        $_SESSION['msg'] = '<div class="alert alert-success mb-2" role="alert">
        Time Table Added.
        </div>';
        header("location: timetable.php");
        exit();
    }

    if (isset($_GET['type']) && $_GET['type'] == "delete") {
        $academicyear = $_POST['academicyear'];
        $semester = $_POST['semester'];
        $batch = $_POST['batch'];

        $esql = "SELECT * FROM `timetable` WHERE `academic_year`='$academicyear' AND `semester`='$semester' AND `batch`='$batch'";
        $eresult = mysqli_query($conn, $esql);
        print_r($eresult);

        if ($eresult->num_rows == 18) {
            while ($row = mysqli_fetch_assoc($eresult)) {
                $sql = "DELETE FROM `timetable` WHERE id=".$row['id'];
                $result = mysqli_query($conn, $sql);
            }


            $_SESSION['msg'] = '<div class="alert alert-success mb-2" role="alert">
            Time Table Deleted.
            </div>';
            header("location: timetable.php");
            exit();
        } else {
            $_SESSION['msg'] = '<div class="alert alert-warning mb-2" role="alert">
             Time Table Not Found!.
             </div>';
            header("location: timetable.php");
            exit();
        }
    }
} else {
    header("location: login.php");
    exit();
}
