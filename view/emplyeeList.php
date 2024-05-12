<?php
// session_start();
// require "../model/db_connect.php";

// if (!isset($_SESSION['user_id'])) {
//     header('Location: ../view/login.php');
//     exit;    
// }

// $sql = "SELECT id, fullName, address, phone, email, gender FROM employee";
// $result = $conn->query($sql);


?>

<!DOCTYPE html>

<head>

    <style>
        div {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <title>Profile Information</title>
</head>

<body>


    <h2>Employee List</h2>
    <table id="employeeTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Salary</th>
                <th>Approval Status</th>
                <th>Action</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            <!-- Table body will be filled dynamically using JavaScript -->
        </tbody>
    </table>
    </div>
    </div>



    <script>
        function fetchEmployeeList() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../controller/EmployeeController.php/get-allemp", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var employeeList = JSON.parse(xhr.responseText);
                    renderEmployeeList(employeeList);
                }
            };
            xhr.send();
        }


        function renderEmployeeList(employeeList) {
            var tableBody = document.querySelector('#employeeTable tbody');
            employeeList.forEach(function(employee) {
                var row = tableBody.insertRow();
                row.insertCell().textContent = employee.id;
                row.insertCell().textContent = employee.fullName;
                row.insertCell().textContent = employee.email;
                row.insertCell().textContent = employee.phone;
                row.insertCell().textContent = employee.address;
                row.insertCell().textContent = employee.gender;
                row.insertCell().textContent = employee.salary;
                row.insertCell().textContent = employee.approval_status === "1" ? "Approved" : "Not Approved";
                var statusCell = row.insertCell();

                var deleteUserBtn = document.createElement("button");
                deleteUserBtn.textContent = "Delete";
                deleteUserBtn.addEventListener("click", function() {
                    deleteUser(employee.id);
                });

                var updateUserBtn = document.createElement("button");
                updateUserBtn.textContent = "Update";
                updateUserBtn.addEventListener("click", function() {
                    navigateToUpdatePage(employee.id);
                });

                statusCell.appendChild(updateUserBtn);
                statusCell.appendChild(deleteUserBtn);
            });
        }


        function navigateToUpdatePage(empId) {
            window.location.href = 'updateEmployee.php?emp_id=' + empId;
        }


        //delete user
        function deleteUser(employeeId) {
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Configure the request
            xhr.open('POST', '../controller/EmployeeController.php/delete', true);
            xhr.setRequestHeader('Content-Type', 'application/json');

            // Define the callback function to handle the response
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {

                    window.location.reload();
                    alert("Deleted Successfully ");
                } else {
                    // If the request failed
                    alert("Failed to Delete");
                }
            };

            // Define the error handling function
            xhr.onerror = function() {
                console.error("Error:", xhr.statusText);
            };

            // Send the request with the JSON payload
            xhr.send(JSON.stringify({
                employeeId: employeeId
            }));
        }


        window.onload = function() {

            fetchEmployeeList();
        };
    </script>

</body>

</html>