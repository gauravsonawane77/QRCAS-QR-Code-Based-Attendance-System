<?php
// print_r($_POST);
require "conn.php";
session_start();
if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {

    if (isset($_GET['type']) && $_GET['type'] == "add") {
        $enrollmentno = $_POST['enrollmentno'];
        $studentname = $_POST['studentname'];
        $semester = $_POST['semester'];
        $branch = $_POST['branch'];
        $shift = $_POST['shift'];
        $rollno = $_POST['rollno'];
        $batch = $_POST['batch'];
        $password = $_POST['password'];

        $sql = "INSERT INTO `students`(`enrollment_no`, `name`, `semester`, `branch`, `shift`, `roll_no`, `batch`, `password`) VALUES ('$enrollmentno','$studentname','$semester','$branch','$shift','$rollno','$batch','$password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['msg'] = '<div class="alert alert-success mb-2" role="alert">
        Student Added.
        </div>';
            header("location: stud_details.php");
            exit();
        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger mb-2" role="alert">
        Something went wrong!.
        </div>';
            header("location: stud_details.php");
            exit();
        }
    }

    if (isset($_GET['type']) && $_GET['type'] == "delete") {
        $enroll = $_GET['enroll'];

        $sql = "DELETE FROM `students` WHERE enrollment_no='$enroll'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['msg'] = '<div class="alert alert-success mb-2" role="alert">
        Student Deleted.
        </div>';
            header("location: stud_details.php");
            exit();
        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger mb-2" role="alert">
        Something went wrong!.
        </div>';
            header("location: stud_details.php");
            exit();
        }
    }

    if (isset($_GET['type']) && $_GET['type'] == "update") {
        $enrollmentno = $_POST['enrollmentno'];
        $studentname = $_POST['studentname'];
        $semester = $_POST['semester'];
        $branch = $_POST['branch'];
        $shift = $_POST['shift'];
        $rollno = $_POST['rollno'];
        $batch = $_POST['batch'];
        $password = $_POST['password'];

        $sql = "UPDATE `students` SET `name`='$studentname',`semester`='$semester',`branch`='$branch',`shift`='$shift',`roll_no`='$rollno',`batch`='$batch',`password`='$password' WHERE `enrollment_no`='$enrollmentno'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['msg'] = '<div class="alert alert-success mb-2" role="alert">
        Student Details Updated.
        </div>';
            header("location: stud_details.php");
            exit();
        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger mb-2" role="alert">
        Something went wrong!.
        </div>';
            header("location: stud_details.php");
            exit();
        }
    }
} else {
    header("location: login.php");
    exit();
}
