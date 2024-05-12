<?php

// include 'db_connect.php';
// $user_id = $_SESSION['user_id'];
// $query = "SELECT * FROM user WHERE id = ?";
// $stmt=$conn->prepare($query);
// $stmt->bind_param("i",$user_id );
// $stmt->execute();
// $result = $stmt->get_result();
// $user = $result->fetch_assoc();
?>

<!DOCTYPE html>

<head>

    <link rel="stylesheet" type="text/css" href="footer2.css">
</head>

<body>

    <br><br><br>
    <footer align="center">
        <p>Contact: 017******** | Email: support@eshop.com </p>
        <ul style="list-style: none;
    display: flex;
    justify-content: center;
    gap: 20px">
            <li><a href="https://www.facebook.com/">Facebook</a></li>
            <li><a href="https://www.instagram.com/">Instagram</a></li>
            <li><a href="https://www.twitter.com/">Twitter</a></li>
        </ul>
        <p> <?php echo date("Y"); ?> . All rights reserved.</p>
    </footer>


    <p align="center"><a href="logout.php"><b>Logout</b></a></p>

</body>

</html>