<?php
    session_start();
?>

<html>
    <head>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

    <body>
        <header>
            <h1 style='text-align: center; margin-top: 2rem'>Login Portal</h1>
        </header>

        <?php
            include('lib/config.php');
            $errormsg = '';
            $user = '';
            $pass = '';

            if(isset($_POST['submit'])){
                $conn = new mysqli($servername, $username, $password, $database);
                if(!$conn){
                    die('Connection failed: '.mysqli_connect_error());
                }else{
                    //Getting the data from the form itself. METHOD = POST helps it to get it from the input NAME tag
                    $UID = '';
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    //login credentials check
                    $sql = "SELECT emp_id AS UID FROM users WHERE BINARY(user_login_id)=BINARY('".$user."') AND BINARY(user_login_pass)=BINARY('".$pass."');";
                    
                    $result = $conn->query($sql);
                    $conn->close();

                    //fetching the data from a single row
                    while($row = mysqli_fetch_row($result))
                        $UID = $row[0];

                    if($result->num_rows > 0){
                        //Saving the user in the session here
                        $_SESSION['user'] = $UID;
                        echo("<script>console.log('Success!!');</script>");
                        header('location: '.BASEURL.'index.php?log=success');
                        exit;
                    }else{
                        $errormsg = 'Invalid user name and password';
                    }
                }
            }
        ?>

        <form action="" method="post" style='margin-left: 41% !important; margin-top: 12%'>           
            <div class="row">
                <div class="col-md-4">
                    <div class="form-login login_class">
                        <input type="text" id="userName" name="user" class="form-control input-sm chat-input in_class" placeholder="Enter Username" />
                        </br>
                        <input type="password" id="userPassword" name="pass" class="form-control input-sm chat-input in_class" placeholder="Enter Password" />
                        </br>
                        <div class="wrapper text-center">
                            <input  class='submit-btn' type="submit" name="submit" value="LOGIN">						
                        <p style='color: red; margin-top: 1rem'><?php echo $errormsg ?></p>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>