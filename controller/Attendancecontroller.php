<?php
include "../model/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['attendance'])) {
    // Retrieve the attendance data from the form
    $attendanceData = $_POST['attendance'];

    // Get today's date
    $attendanceDate = date('Y-m-d');

    // Loop through the attendance data and insert or update records in the database
    foreach ($attendanceData as $employeeId => $attendance) {
        // Sanitize the input
        $employeeId = mysqli_real_escape_string($conn, $employeeId);
        $attendance = mysqli_real_escape_string($conn, $attendance);

        // If attendance status is not provided (i.e., checkbox is unchecked), mark as absent (0)
        if ($attendance === "") {
            $attendance = 0; // Mark as absent
        }

        // Check if attendance record already exists for the employee and date
        $sql = "SELECT id FROM attendance WHERE employee_id = '$employeeId' AND attendance_date = '$attendanceDate'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // If attendance record exists, update the existing record
            $sql = "UPDATE attendance SET status = '$attendance' WHERE employee_id = '$employeeId' AND attendance_date = '$attendanceDate'";
        } else {
            // If attendance record does not exist, insert a new record
            $sql = "INSERT INTO attendance (employee_id, attendance_date, status) VALUES ('$employeeId', '$attendanceDate', '$attendance')";
        }

        // Execute the SQL query
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            exit(); // Exit the script if there's an error
        }
    }

    echo "Attendance submitted successfully";
} else {
    echo "No attendance data received";
}
