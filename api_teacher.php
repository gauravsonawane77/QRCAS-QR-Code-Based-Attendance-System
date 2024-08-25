<?php
// print_r($_POST);
require "conn.php";
session_start();
if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {

    if (isset($_GET['type']) && $_GET['type'] == "add") {
        $id = $_POST['id'];
        $teachername = $_POST['teachername'];
        $education = $_POST['education'];
        $branch = $_POST['branch'];
        $designation = $_POST['designation'];
        $password = $_POST['password'];

        $sql = "INSERT INTO `teachers`(`name`, `education`, `designation`, `branch`, `password`) VALUES ('$teachername','$education','$designation','$branch','$password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['msg'] = '<div class="alert alert-success mb-2" role="alert">
        Teacher Added.
        </div>';
            header("location: teacher_details.php");
            exit();
        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger mb-2" role="alert">
        Something went wrong!.
        </div>';
            header("location: teacher_details.php");
            exit();
        }
    }

    if (isset($_GET['type']) && $_GET['type'] == "delete") {
        $enroll = $_GET['enroll'];

        $sql = "DELETE FROM `teachers` WHERE id='$enroll'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['msg'] = '<div class="alert alert-success mb-2" role="alert">
        Teacher Deleted.
        </div>';
            header("location: teacher_details.php");
            exit();
        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger mb-2" role="alert">
        Something went wrong!.
        </div>';
            header("location: teacher_details.php");
            exit();
        }
    }

    if (isset($_GET['type']) && $_GET['type'] == "update") {
        $id = $_POST['id'];
        $teachername = $_POST['teachername'];
        $education = $_POST['education'];
        $branch = $_POST['branch'];
        $designation = $_POST['designation'];
        $password = $_POST['password'];

        $sql = "UPDATE `teachers` SET `name`='$teachername',`education`='$education',`designation`='$designation',`branch`='$branch',`password`='$password' WHERE `id`='$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['msg'] = '<div class="alert alert-success mb-2" role="alert">
        Teacher Details Updated.
        </div>';
            header("location: teacher_details.php");
            exit();
        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger mb-2" role="alert">
        Something went wrong!.
        </div>';
            header("location: teacher_details.php");
            exit();
        }
    }
} else {
    header("location: login.php");
    exit();
}
