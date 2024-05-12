<?php
function getAllTask()
{
    include 'db_connect.php';
    $sql = "SELECT * FROM task;";
    $result = $conn->query($sql);


    if (!$result) {

        return 0;
    } else {
        $taskList = array();
        while ($row = $result->fetch_assoc()) {
            $taskList[] = $row;
        }
        $result->close();

        return $taskList;
    }
};
