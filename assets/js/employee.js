function addEmployee(e) {
  e.preventDefault();
  var name = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var address = document.getElementById("address").value;
  var phone = document.getElementById("phone").value;
  var gender = document.querySelector('input[name="gender"]:checked');
  var salary = document.getElementById("salary").value;
  // Reset previous error messages
  document.getElementById("name-error").textContent = "";
  document.getElementById("email-error").textContent = "";
  document.getElementById("password-error").textContent = "";
  document.getElementById("address-error").textContent = "";
  document.getElementById("phone-error").textContent = "";
  document.getElementById("gender-error").textContent = "";
  document.getElementById("salary-error").textContent = "";

  // Flag to track form validity
  var isValid = true;

  // Validate name
  if (name.trim() === "") {
    document.getElementById("name-error").textContent =
      "Name must be filled out";
    isValid = false;
  }

  if (salary.trim() === "") {
    document.getElementById("salary-error").textContent = "Salary is required!";
    isValid = false;
  }

  // Validate email
  if (email.trim() === "") {
    document.getElementById("email-error").textContent =
      "Email must be filled out";
    isValid = false;
  }

  // Validate password
  if (password.trim() === "") {
    document.getElementById("password-error").textContent =
      "Password must be filled out";
    isValid = false;
  }

  // Validate address
  if (address.trim() === "") {
    document.getElementById("address-error").textContent =
      "Address must be filled out";
    isValid = false;
  }

  // Validate phone
  if (phone.trim() === "") {
    document.getElementById("phone-error").textContent =
      "Phone must be filled out";
    isValid = false;
  }

  // Validate gender
  if (!gender) {
    document.getElementById("gender-error").textContent =
      "Gender must be selected";
    isValid = false;
  }

  if (isValid) {
    var xhr = new XMLHttpRequest();

    // Configure the request
    xhr.open("POST", "../controller/EmployeeController.php/add-emp", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    // Define the callback function to handle the response
    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        document.getElementById("reg-form").reset();
        alert("Employee added successfully");
      } else {
        alert("Failed to add employee");
      }
    };

    // Define the error handling function
    xhr.onerror = function () {
      console.error("Error:", xhr.statusText);
    };

    console.log(name, email, password, address, phone, gender);

    // Send the request with the JSON payload
    xhr.send(
      JSON.stringify({
        name,
        email,
        password,
        address,
        phone,
        gender: gender.value,
        salary,
      })
    );
  } else {
    return isValid;
  }
}

function updateEmployee(e) {
  e.preventDefault();

  var name = document.getElementById("name").value;
  var address = document.getElementById("address").value;
  var phone = document.getElementById("phone").value;
  var salary = document.getElementById("salary").value;
  var empId = document.getElementById("empId").value;

  // Reset previous error messages
  document.getElementById("name-error").textContent = "";
  document.getElementById("address-error").textContent = "";
  document.getElementById("phone-error").textContent = "";
  document.getElementById("salary-error").textContent = "";

  // Flag to track form validity
  var isValid = true;

  // Validate name
  if (name.trim() === "") {
    document.getElementById("name-error").textContent =
      "Name must be filled out";
    isValid = false;
  }

  // Validate address
  if (address.trim() === "") {
    document.getElementById("address-error").textContent =
      "Address must be filled out";
    isValid = false;
  }

  // Validate phone
  if (phone.trim() === "") {
    document.getElementById("phone-error").textContent =
      "Phone must be filled out";
    isValid = false;
  }
  if (salary.trim() === "") {
    document.getElementById("salary-error").textContent =
      "Phone must be filled out";
    isValid = false;
  }

  if (isValid) {
    var xhr = new XMLHttpRequest();

    xhr.open(
      "POST",
      `../controller/EmployeeController.php/update?emp_id=${empId}`,
      true
    );
    xhr.setRequestHeader("Content-Type", "application/json");

    // Set up a callback function to handle the response
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          alert("Employee data updated successfully");
          window.location.href = "emplyeeList.php";
        } else {
          // Request failed or returned an error
          console.error("Error:", xhr.status);
          // Optionally, you can handle errors here
        }
      }
    };

    // Send the AJAX request with the JSON data
    xhr.send(
      JSON.stringify({
        name,
        address,
        phone,
        salary,
      })
    );
  } else {
    return isValid;
  }
}

window.onload = function () {
  const urlParams = new URLSearchParams(window.location.search);
  console.log(urlParams);
  const empId = urlParams.get("emp_id");
  if (empId) {
    fetchAEmployee(empId);
  }
};

function fetchAEmployee(empId) {
  var xhr = new XMLHttpRequest();

  var url = "../controller/EmployeeController.php/get-a-emp?emp_id=" + empId;

  xhr.open("GET", url, true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var employeeData = JSON.parse(xhr.responseText);
        document.getElementById("name").value = employeeData.fullName;
        document.getElementById("phone").value = employeeData.phone;
        document.getElementById("salary").value = employeeData.salary;
        document.getElementById("address").value = employeeData.address;
        document.getElementById("empId").value = employeeData.id;

        console.log("Employee data:", employeeData);
      } else {
        alert(JSON.parse(xhr.responseText).error);
        console.error("Error:", xhr.status);
      }
    }
  };

  // Send the AJAX request
  xhr.send();
}
