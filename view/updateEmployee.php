<?php
require "../model/db_connect.php";

if (isset($_GET['id'])) {
    $employeeId = $_GET['id'];



    $sql = "SELECT id, fullName, address, phone FROM employee WHERE id = $employeeId";
    $result = mysqli_query($conn, $sql);
    $emp = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>

<head>

    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        div {
            text-align: center;
        }
    </style>
    <title>Update Employee Employee</title>
</head>

<body>
    <?php //include('../header.php') 
    ?>

    <div>
        <h3>Update Employee Information</h3>


    </div>
    <form class="" method="post" id="reg-form" onsubmit="return updateEmployee(event)">
        <div class="">
            <input type="text" class="" id="name" placeholder="Full Name" name="name" value="" />

            <span id="name-error" style="color: red;"></span>
        </div>

        <div class="">
            <input type="tel" id="phone" name="phone" class="" placeholder="Phone" value="">
            <span id="phone-error" style="color: red;"></span>
        </div>

        <div class="">
            <input type="text" class="" id="address" placeholder="Address" name="address" value="" />
            <span id="address-error" style="color: red;"></span>
        </div>

        <div class="">
            <input type="number" class="" id="salary" placeholder="Salary" name="salay" value="" />
            <span id="salary-error" style="color: red;"></span>
        </div>

        <input type="hidden" name="empId" id="empId" value="">

        <div class="">
            <button type="submit">Submit</button><br>
            <br><br>
            <p align='center'> <?php echo "<a href='../view/emplyeeList.php'><b>Go back</b></a>" ?><br></p>

        </div>
    </form>

    <?php //include('../footer.php') 
    ?>
    <script src="../assets/js/employee.js">

    </script>

</body>

</html>