<!-- Here the backend process happens CRUD operations -->
<?php
    include('lib/config.php');
    
    //For User Adding into the DB
    if(!empty($_POST['emp_add'])){
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if(!$conn){
            die('Connection Failed: '.mysqli_connect_error());
        }else{
            $emp_id = $_POST['emp_id'];
            $user_id = $_POST['user_id'];
            $user_pass = $_POST['user_pass'];

            $sql = 'INSERT INTO `users` (`emp_id`, `user_login_id`, `user_login_pass`) VALUES ("'.$emp_id.'", "'.$user_id.'", "'.$user_pass.'");';
            $result = $conn->query($sql);
        }

        $conn->close();
    }

    //For Loading User Edit Modal
    if(!empty($_GET['edit_emp'])){
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $emp_id = $_GET['emp_id'];
        if(!$conn){
            die('Connection Failed: '.mysqli_connect_error());
        }else{
            
            $sql = 'SELECT * FROM users WHERE emp_id="'.$emp_id.'";';
            $result = $conn->query($sql);

            while($row = mysqli_fetch_assoc($result)){
                $user_db_id = $row['user_id'];
                $empId = $row['emp_id'];
                $userId = $row['user_login_id'];
                $userPass = $row['user_login_pass'];   
            }
            echo "<div class='form-group'>";
                echo "<input type='text' class='form-control' id='editEmpId' value='".$empId."' style='font-size: 18px'> <br>";
                echo "<input type='text' class='form-control' id='editUserId' value='".$userId."' style='font-size: 18px'> <br>";
                echo "<input type='text' class='form-control' id='editUserPass' value='".$userPass."' style='font-size: 18px'>";
            echo "</div>";
            echo "<div class='modal-footer pb-0'>";
                echo "<button onclick='editVal(".$user_db_id.")' type='button' class='btn btn-primary mt-0 mb-0' style='background-color: #823287; border-color: #823287; font-size: 15px'>Edit Data</button>";
            echo "</div>";
        }

        $conn->close();
    }

    //For Editing the user in DB
    if(!empty($_POST['emp_edit'])){
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $user_db_id = $_POST['userDBId'];
        $empID = $_POST['empId'];
        $userID = $_POST['userId'];
        $userPass = $_POST['userPass'];

        if(!$conn){
            die('Connection Failed: '.mysqli_connect_error());
        }else{
            $sql = 'UPDATE `users` SET `emp_id`="'.$empID.'", `user_login_id`="'.$userID.'", `user_login_pass`="'.$userPass.'" WHERE `user_id`="'.$user_db_id.'";';
            $result = $conn->query($sql);
        }

        $conn->close();
    }

    //For Deleting the user from the DB
    if(!empty($_POST['emp_del'])){
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $emp_del_id = $_POST['empDelId'];

        if(!$conn){
            die('Connection Failure: '.mysqli_connect_error());
        }else{

            $sql = 'DELETE FROM users WHERE emp_id="'.$emp_del_id.'"';
            $result = $conn->query($sql);
        }

        $conn->close();
    }
?>