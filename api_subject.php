<?php
// print_r($_POST);
require "conn.php";
session_start();
if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {

    if (isset($_GET['type']) && $_GET['type'] == "add") {
        $subjectcode = $_POST['subjectcode'];
        $description = $_POST['description'];
        $abbrevation = $_POST['abbrevation'];
        $semester = $_POST['semester'];
        $branch = $_POST['branch'];
        $teacherid = $_POST['teacherid'];

        $sql = "INSERT INTO `subjects`(`subject_code`, `name`, `abbreviation`, `semester`, `branch`, `teacher_id`) VALUES ('$subjectcode','$description','$abbrevation','$semester','$branch','$teacherid')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['msg'] = '<div class="alert alert-success mb-2" role="alert">
        Subject Added.
        </div>';
            header("location: subject_details.php");
            exit();
        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger mb-2" role="alert">
        Something went wrong!.
        </div>';
            header("location: subject_details.php");
            exit();
        }
    }

    if (isset($_GET['type']) && $_GET['type'] == "delete") {
        $enroll = $_GET['enroll'];

        $sql = "DELETE FROM `subjects` WHERE subject_code='$enroll'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['msg'] = '<div class="alert alert-success mb-2" role="alert">
        Subject Deleted.
        </div>';
            header("location: subject_details.php");
            exit();
        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger mb-2" role="alert">
        Something went wrong!.
        </div>';
            header("location: subject_details.php");
            exit();
        }
    }

    if (isset($_GET['type']) && $_GET['type'] == "update") {
        $subjectcode = $_POST['subjectcode'];
        $description = $_POST['description'];
        $abbrevation = $_POST['abbrevation'];
        $semester = $_POST['semester'];
        $branch = $_POST['branch'];
        $teacherid = $_POST['teacherid'];

        $sql = "UPDATE `subjects` SET `name`='$description',`abbreviation`='$abbrevation',`semester`='$semester',`branch`='$branch',`teacher_id`='$teacherid' WHERE `subject_code`=$subjectcode";
       
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['msg'] = '<div class="alert alert-success mb-2" role="alert">
        Subject Details Updated.
        </div>';
            header("location: subject_details.php");
            exit();
        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger mb-2" role="alert">
        Something went wrong!.
        </div>';
            header("location: subject_details.php");
            exit();
        }
    }
} else {
    header("location: login.php");
    exit();
}
