<?php
include "../model/employeeModel.php";

$currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Split the URL by "/"
$urlParts = explode('/', $currentUrl);

// Get the last part of the URL
$lastPart = end($urlParts);



if ($_SERVER['REQUEST_METHOD'] === 'GET' && $lastPart === "get-a-emp") {

    if (isset($_GET['emp_id'])) {
        $empId = $_GET['emp_id'];

        $result = getSingleEmployee((int)$empId);
        if ($result) {
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error' => "User is not found"]);
        }
    } else {
        // Handle the case when emp_id parameter is not set
        echo json_encode(array('error' => 'Employee ID not provided'));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $lastPart == "get-allemp") {
    $result = getAllEmployeeList();
    if ($result) {

        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'User not found']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $lastPart == "get-emp-salary") {
    $result = getAllEmployeeWithPerformance();
    if ($result) {

        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'User not found']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $lastPart == "add-emp") {

    $data = json_decode(file_get_contents('php://input'), true);


    $name = $data['name'];
    $email = $data['email'];
    $password = $data['password'];
    $phone = $data['phone'];
    $address = $data['address'];
    $gender = $data['gender'];
    $salary = $data['salary'];



    $errors = [];
    if (empty($name)) {
        $errors['fullName'] = "Please fill up your Full Name";
    } else {
        $input['fullName'] = $name;
    }

    if (empty($gender)) {
        $errors['gender'] = "Please fill up your gender";
    } else {
        $input['gender'] = $gender;
    }



    if (empty($address)) {
        $errors['address'] = "Please fill up your Address";
    } else {
        $input['address'] = $address;
    }
    if (empty($phone)) {
        $errors['phone'] = "Please fill up your phone Number";
    } else {
        $input['phone'] = $phone;
    }
    if (empty($email)) {
        $errors['email'] = "Please fill up your Email";
    } else {
        $input['email'] = $email;
    }
    if (empty($password)) {
        $errors['password'] = "Please fill up your Password";
    } else {
        $input['password'] = $password;
    }

    if (count($errors) == 0) {
        $input['salary'] = $salary;
        $result = addEmployee($input); // here calling emp function to add employee

        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => 'Employee added successfully']);
        } else {
            // If the update failed, send an error response
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => 'Failed to add task']);
        }
    } else {
        http_response_code(400); // Cliend Error
        echo json_encode(['error' => 'Pass all the required data']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $lastPart == "delete") {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['employeeId'])) {
        // Get the employee ID from the JSON data
        $employeeId = $data['employeeId'];
        $success = deleteEmployee($employeeId);


        if ($success) {
            // If the update was successful, send a success response
            http_response_code(200);
            echo json_encode(['message' => 'Approval status changed successfully']);
        } else {
            // If the update failed, send an error response
            http_response_code(500); // Internal Server Error
            echo json_encode(['error' => 'Failed to change approval status']);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $lastPart == "update") {

    $data = json_decode(file_get_contents('php://input'), true);

    $name = $data['name'];
    $phone = $data['phone'];
    $address = $data['address'];
    $salary = $data['salary'];

    $empId = $_GET['emp_id'];

    $input['id'] = $empId;
    $errors = [];
    if (empty($name)) {
        $errors['fullName'] = "Please fill up your Full Name";
    } else {
        $input['fullName'] = $name;
    }



    if (empty($address)) {
        $errors['address'] = "Please fill up your Address";
    } else {
        $input['address'] = $address;
    }
    if (empty($phone)) {
        $errors['phone'] = "Please fill up your phone Number";
    } else {
        $input['phone'] = $phone;
    }

    $input['salary'] = $salary;

    $result = updateEmployee($input);

    if ($result) {

        http_response_code(200);
        echo json_encode(['message' => 'Employee Updated successfully']);
    } else {
        // If the update failed, send an error response
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Failed to update employee']);
    }
} else {
    http_response_code(404);
    header('Content-Type: application/json');
    echo json_encode(['error' => "Not found"]);
}



//update
