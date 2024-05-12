<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="../assets/css/style.css">

    <title>Add Employee</title>

    <style>
        div {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php //include('../header.php') 
    ?>


    <div>
        <h3>Add Employee</h3>
    </div>
    <form class="" method="post" id="reg-form" onsubmit="return addEmployee(event)">
        <div class="">
            <input type="text" class="" id="name" placeholder="Full Name" name="name" />

            <span id="name-error" style="color: red;"></span>
        </div>
        <div class="">
            <input type="email" class="" id="email" placeholder="Email" name="email" />
            <span id="email-error" style="color: red;"></span>
        </div>
        <div class="">
            <input type="tel" id="phone" name="phone" class="" placeholder="Phone">
            <span id="phone-error" style="color: red;"></span>
        </div>
        <div class="">
            <input type="password" class="" id="password" name="password" placeholder="Password" />
            <span id="password-error" style="color: red;"></span>
        </div>
        <div class="">
            <input type="text" class="" id="address" placeholder="Address" name="address" />
            <span id="address-error" style="color: red;"></span>
        </div>

        <div class="">
            <input type="text" class="" id="salary" placeholder="Salary" name="salary" />
            <span id="salary-error" style="color: red;"></span>
        </div>


        <div class="">
            <span>Gender:</span>
            <input type="radio" name="gender" value="female"><span class="me-4">Female</span>
            <input type="radio" name="gender" value="male"><span class="me-4">Male</span>
            <input type="radio" name="gender" value="other"><span class="me-4">Other</span>
            <span id="gender-error" style="color: red;"></span>
        </div>
        <input type="hidden" name="add-employee" value="add-employee">
        <div class="">
            <button type="submit">Submit</button>
            <br><br><br>
            <?php echo "<a href='../welcome.php'><b>Back</b></a>" ?><br><br>

        </div>
    </form>

    <?php //include('../footer.php') 
    ?>
    <script src="../assets/js/employee.js"></script>

</body>

</html>