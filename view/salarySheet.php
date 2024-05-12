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
            width: 700px;
            margin: 0 auto;
        }

        table {
            border-collapse: collapse;
            width: 700px;
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
    <script src="../assets/js/jspdf.umd.min.js"></script>
    <script src="../assets/js/html2canvas.min.js"></script>

    <title>Profile Information</title>
</head>

<body>

    <div>
        <h2>Employee Salary Sheet</h2>
        <button onclick="generatePDF()" style="margin-bottom:20px ;">Generate PDF</button>

        <table id="employeeTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Performance</th>

                </tr>
            </thead>
            <tbody>
                <!-- Table body will be filled dynamically using JavaScript -->
            </tbody>
        </table>
    </div>



    <script>
        function fetchEmployeeList() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../controller/EmployeeController.php/get-emp-salary", true);
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
                row.insertCell().textContent = employee.salary;
                row.insertCell().textContent = employee.performance;


            });
        }


        function generatePDF() {
            // Create new PDF document
            const {
                jsPDF
            } = window.jspdf;
            let doc = new jsPDF('l', 'mm', [1000, 1200]);
            let pdfjs = document.getElementById('employeeTable');
            window.html2canvas = html2canvas;



            doc.html(pdfjs, {
                callback: function(doc) {
                    doc.save("newpdf.pdf");
                },
                x: 12,
                y: 12
            });
        }



        window.onload = function() {

            fetchEmployeeList();
        };
    </script>

</body>

</html>