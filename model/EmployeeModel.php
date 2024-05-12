<?php

function getSingleEmployee($empId)
{
    include 'db_connect.php';

    $sql = "SELECT * FROM employee WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $empId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $employeeData = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $employeeData;
    } else {

        mysqli_stmt_close($stmt);
        return 0;
    }
}

function getAllEmployeeList()
{
    include 'db_connect.php';
    $sql = "SELECT * FROM employee;";
    $result = $conn->query($sql);


    if (!$result) {

        return mysqli_error($conn);
    } else {
        $employeeList = array();
        while ($row = $result->fetch_assoc()) {
            $employeeList[] = $row;
        }
        $result->close();

        return $employeeList;
    }
};

function getAllEmployeeWithPerformance()
{
    //attendance a ON employee WHERE e.id = a.employee_id
    include 'db_connect.php';
    $sql = "SELECT e.id, e.fullName, e.email, e.phone, e.address, e.salary, count(a.employee_id) as performance FROM employee e LEFT JOIN attendance a ON e.id = a.employee_id GROUP BY e.id;";
    $result = $conn->query($sql);


    if (!$result) {

        return mysqli_error($conn);
    } else {
        $employeeList = array();
        while ($row = $result->fetch_assoc()) {
            $employeeList[] = $row;
        }
        $result->close();

        return $employeeList;
    }
};

function addEmployee($arrayData)
{
    include 'db_connect.php';
    echo $arrayData["fullName"];

    $stmt = $conn->prepare("INSERT INTO employee(fullName, email, phone, password, gender, address, salary) values(?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $arrayData["fullName"], $arrayData["email"], $arrayData["phone"], $arrayData["password"], $arrayData["gender"], $arrayData["address"], $arrayData['salary']);
    $success = $stmt->execute();
    if (!$success) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        return 1;
    }
}

function deleteEmployee($empId)
{
    include 'db_connect.php';
    $sql = "DELETE FROM employee WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $empId);
    $stmt->execute();
    if (!$success) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        return 1;
    }
}




function updateEmployee($arrayData)
{
    include 'db_connect.php';
    $address = mysqli_real_escape_string($conn, $arrayData['address']);
    $phone = mysqli_real_escape_string($conn, $arrayData['phone']);
    $name = mysqli_real_escape_string($conn, $arrayData['fullName']);
    $salary = mysqli_real_escape_string($conn, $arrayData['salary']);

    $id = mysqli_real_escape_string($conn, $arrayData['id']);

    $stmt = $conn->prepare("UPDATE employee SET address = ?, phone = ?, fullName = ?, salary = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $address, $phone, $name, $salary, $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
