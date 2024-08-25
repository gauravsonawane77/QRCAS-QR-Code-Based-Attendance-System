<?php
require('header.php');
require('conn.php');

if (isset($_GET['subject_code']) && isset($_GET['slot']) && isset($_GET['batch']) && isset($_GET['day'])) {
    $subject_code = $_GET['subject_code'];
    $slot = $_GET['slot'];
    $batch = $_GET['batch'];
    $day = $_GET['day'];

    $currentDate = date('d-m-Y');
    $currentDay = date('l');

    $fssql = "SELECT * FROM `subjects` WHERE `subject_code`=" . $subject_code;
    $fsresult = mysqli_query($conn, $fssql);
    $fsrow = mysqli_fetch_assoc($fsresult);

    $sql = "SELECT * FROM `timetable` WHERE `subject_code`='$subject_code' AND `day`='$day' AND `slot`='$slot' AND `batch`='$batch'";
    $result = mysqli_query($conn, $sql);


    if ($result->num_rows == 1) {
        $qrdata = array("subject_code" => $subject_code, "day" => $day, "slot" => $slot, "batch" => $batch, "currentDate" => $currentDate, "currentDay" => $currentDay);
        $encryptQR = base64_encode(json_encode($qrdata));
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">
        Practical Not Availbale!.
    </div>';
        header("location: take_attendance.php");
        exit();
    }
}
?>
<div class="container pt-3 px-4 m-0">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-1 rounded-4" style="background: #eee;">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Attendance</li>
            <li class="breadcrumb-item">Take Attendance</li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $fsrow['name']; ?></li>
        </ol>
    </nav>
</div>


<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="text-center w-100">
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
    </div>

    <div class="row bg-light rounded mx-0">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Take Attendance</h6>


                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Subject</td>
                            <td><?php echo $fsrow['name']; ?></td>
                        </tr>
                        <tr>
                            <td>Batch</td>
                            <td><?php echo $batch; ?></td>
                        </tr>
                        <tr>
                            <td>Today Date</td>
                            <td><?php echo $currentDate; ?></td>
                        </tr>
                        <tr>
                            <td>Today Day</td>
                            <td><?php echo $currentDay; ?></td>
                        </tr>
                        <tr>
                            <td>Slot</td>
                            <td><?php echo $slot; ?></td>
                        </tr>
                        <tr>
                            <td>QR Code <br><p>(Students are Scan QR Code and Mark Attendance)</p></td>
                            <td> <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo $encryptQR; ?>&choe=UTF-8" title="Link to Google.com" /></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Blank End -->



<?php
require('footer.php');
?>