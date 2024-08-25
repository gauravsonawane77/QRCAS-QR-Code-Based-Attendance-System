<?php
require('header.php');
require('conn.php');
?>
<div class="container pt-3 px-4 m-0">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-1 rounded-4" style="background: #eee;">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Time Table</li>
            <li class="breadcrumb-item active" aria-current="page">Details</li>
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
        <button type="button" class="btn btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus me-2"></i>Set New Time Table</button>
        <button type="button" class="btn btn-outline-danger m-2" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fas fa-plus me-2"></i>Delete Time Table</button>
    </div>

    <div class="row bg-light rounded mx-0">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Time Table</h6>
                <form class="row gy-2 gx-3 align-items-center border p-2" action="timetable.php" method="get">
                    <div class="col-auto">
                        <p>View Time Table</p>
                    </div>
                    <div class="col-auto">
                        <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                        <select class="form-select" name="semester" id="autoSizingSelect">
                            <option value="">Select Semester</option>
                            <option value="1">First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                            <option value="4">Fourth</option>
                            <option value="5">Fifth</option>
                            <option value="6">Sixth</option>
                            <option value="7">Seven</option>
                            <option value="8">Eight</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                        <select class="form-select" name="batch" id="autoSizingSelect">
                            <option value="">Select Batch</option>
                            <option value="A1">A1</option>
                            <option value="A2">A2</option>
                            <option value="A3">A3</option>
                            <option value="A4">A4</option>
                            <option value="A5">A5</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                        <select class="form-select" name="academic" id="autoSizingSelect">
                            <option value="">Select Academic Year</option>
                            <option value="2022-23">2022-23</option>
                            <option value="2023-24">2023-24</option>
                            <option value="2024-25">2024-25</option>
                        </select>
                    </div>
                    <!-- <div class="col-auto">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                            <label class="form-check-label" for="autoSizingCheck">
                                Remember me
                            </label>
                        </div>
                    </div> -->
                    <div class="col-auto">
                        <button type="submit" class="btn btn-outline-success">Search Time Table</button>
                    </div>
                </form>

                <?php
                if (isset($_GET['batch']) && isset($_GET['semester']) && isset($_GET['academic'])) {
                ?>

                    <h6 class="mb-3 text-center mt-3 text-danger">Time Table Details : Academic Year-[<?php echo $_GET['academic']; ?>], Batch-[<?php echo $_GET['batch']; ?>], Semester-[<?php echo $_GET['semester']; ?>]</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Slot 1</th>
                                    <th scope="col">Slot 2</th>
                                    <th scope="col">Slot 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $semester = $_GET['semester'];
                                $batch = $_GET['batch'];
                                $academic = $_GET['academic'];
                                $sql = "SELECT * FROM `timetable` WHERE `academic_year`='$academic' AND `semester`='$semester' AND `batch`='$batch'";
                                // echo "<pre>";
                                $result = mysqli_query($conn, $sql);
                                $daychanger = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // print_r($result);
                                    // echo $daychanger;
                                    if ($daychanger == 1) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['day']; ?></td>

                                        <?php
                                    }

                                    $fssql = "SELECT * FROM `subjects` WHERE `subject_code`=" . $row['subject_code'];
                                    $fsresult = mysqli_query($conn, $fssql);
                                    $fsrow = mysqli_fetch_assoc($fsresult);
                                    echo ' <td>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p>' . $fsrow['name'] . '</p>
                                        </div>
                                    </div>
                                </td>';

                                    if ($daychanger == 3) {
                                        ?>
                                        </tr>
                                <?php
                                    }
                                    if ($daychanger == 3) {
                                        $daychanger = 1;
                                    } else {
                                        $daychanger += 1;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Blank End -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Set New Time Table</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <form action="api_timetable.php?type=add" method="post">
                            <div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Select Academic Year</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="academicyear" id="floatingSelect" aria-label="Floating label select example" required>
                                            <option value="">Open this select menu</option>
                                            <option value="2022-23">2022-23</option>
                                            <option value="2023-24">2023-24</option>
                                            <option value="2024-25">2024-25</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Select Semeter</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="semester" id="floatingSelect" aria-label="Floating label select example" required>
                                            <option value="">Open this select menu</option>
                                            <option value="1">First</option>
                                            <option value="2">Second</option>
                                            <option value="3">Third</option>
                                            <option value="4">Fourth</option>
                                            <option value="5">Fifth</option>
                                            <option value="6">Sixth</option>
                                            <option value="7">Seven</option>
                                            <option value="8">Eight</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Select Batch</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="batch" id="floatingSelect" aria-label="Floating label select example" required>
                                            <option value="">Open this select menu</option>
                                            <option value="A1">A1</option>
                                            <option value="A2">A2</option>
                                            <option value="A3">A3</option>
                                            <option value="A4">A4</option>
                                            <option value="A5">A5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-borderless text-center">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th scope="col">Slot 1</th>
                                            <th scope="col">Slot 2</th>
                                            <th scope="col">Slot 3</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Monday</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Monday_1" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Monday_2" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Monday_3" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Tuesday</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Tuesday_1" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Tuesday_2" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Tuesday_3" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Wednesday</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Wednesday_1" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Wednesday_2" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Wednesday_3" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Thursday</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Thursday_1" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Thursday_2" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Thursday_3" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Friday</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Friday_1" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Friday_2" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Friday_3" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Saturday</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Saturday_1" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Saturday_2" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <select class="form-select" name="Saturday_3" id="floatingSelect" aria-label="Floating label select example" required>
                                                            <option value="">Select Subject</option>
                                                            <?php
                                                            $tsql = "SELECT * FROM subjects";
                                                            $tresult = mysqli_query($conn, $tsql);
                                                            while ($trow = mysqli_fetch_assoc($tresult)) {
                                                            ?>
                                                                <option value="<?php echo $trow['subject_code']; ?>"><?php echo $trow['name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Time Table</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="bg-light rounded h-100 p-4">
                        <form action="api_timetable.php?type=delete" method="post">
                            <div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Select Academic Year</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="academicyear" id="floatingSelect" aria-label="Floating label select example" required>
                                            <option value="">Open this select menu</option>
                                            <option value="2022-23">2022-23</option>
                                            <option value="2023-24">2023-24</option>
                                            <option value="2024-25">2024-25</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Select Semeter</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="semester" id="floatingSelect" aria-label="Floating label select example" required>
                                            <option value="">Open this select menu</option>
                                            <option value="1">First</option>
                                            <option value="2">Second</option>
                                            <option value="3">Third</option>
                                            <option value="4">Fourth</option>
                                            <option value="5">Fifth</option>
                                            <option value="6">Sixth</option>
                                            <option value="7">Seven</option>
                                            <option value="8">Eight</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword3" class="col-sm-3 col-form-label">Select Batch</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="batch" id="floatingSelect" aria-label="Floating label select example" required>
                                            <option value="">Open this select menu</option>
                                            <option value="A1">A1</option>
                                            <option value="A2">A2</option>
                                            <option value="A3">A3</option>
                                            <option value="A4">A4</option>
                                            <option value="A5">A5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete</button>
            </div>
            </form>
        </div>
    </div>
</div>


<?php
require('footer.php');
?>