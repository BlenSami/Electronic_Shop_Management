<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file here -->
</head>

<body>

    <h2>Attendance Management System</h2>

    <!-- Show Today's Date -->
    <div id="todayDate">Today's Date: <?php echo date("F j, Y"); ?></div>

    <form id="attendanceForm" method="post">
        <?php
        include "../model/db_connect.php";

        // Get today's date
        $attendanceDate = date('Y-m-d');

        // Retrieve list of employees
        $sql = "SELECT id, fullName FROM employee";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Display employee list in UI
            while ($row = mysqli_fetch_assoc($result)) {
                // Check if employee has attended for today
                $employeeId = $row['id'];
                $sql = "SELECT * FROM attendance WHERE employee_id = '$employeeId' AND attendance_date = '$attendanceDate'";
                $attendanceResult = mysqli_query($conn, $sql);

                // Determine if checkbox should be checked
                $isChecked = (mysqli_num_rows($attendanceResult) > 0) ? 'checked' : '';

                echo '<div class="employee">';
                echo '<label for="attendance-' . $row['id'] . '">' . $row['fullName'] . ':</label>';
                echo '<input type="checkbox" id="attendance-' . $row['id'] . '" name="attendance[' . $row['id'] . ']" value="1" ' . $isChecked . '>';
                echo '</div>';
            }
        } else {
            echo "No employees found";
        }
        ?>
        <button type="submit" name="submit">Submit Attendance</button>
    </form>

    <script>
        // JavaScript code for form submission using AJAX
        document.getElementById("attendanceForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent default form submission
            var formData = new FormData(this); // Create FormData object from form
            var xhr = new XMLHttpRequest(); // Create XMLHttpRequest object
            xhr.open("POST", "../controller/Attendancecontroller.php", true); // Open connection to backend script
            xhr.onload = function() {
                if (xhr.status == 200) {
                    alert("Attendance submitted successfully");
                } else {
                    alert("Failed to submit attendance");
                }
            };
            xhr.send(formData); // Send FormData object
        });
    </script>

</body>

</html>