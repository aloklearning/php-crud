<html>
    <head>
        <!-- Bootstrap and JS File -->
        <script src='main_jquery.js'></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>

    <body>
        <header style='text-align: center'>
            <h1 style='margin-top: 2rem'>Welcome to Careerlabs Tech-Team </h1>
            <a href='logout.php' style='margin-top: 2rem'>Logout</a>
        </header>

        <?php
            //starting the session. Data binding will happen here
            session_start();
            include("lib/config.php");

            //Check for logeed in user. Sesssion here helps to store the user data globally. 
            //Using the user data, whether it has been set or not in login.php for logged in user
            if(isset($_SESSION['user'])){
                //Getting the data from the URL itself. It is coming from after the ? in url. www.xyz.com?log=success
                if(!empty($_GET['log']) && $_GET['log']=='success'){
                    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
                    
                    if(!$conn){
                        die('Connection Failed: '. mysqli_connect_error());
                    }else{
                        //give data for everyone
                        $sql = 'SELECT * FROM users';
                        $result = $conn->query($sql);
                        //$row = mysqli_fetch_assoc($result); //fetches the data in associative array
                        
                        echo "<div style='margin-top: 5%; margin-left: 150px; margin-right: 150px'>";
                            echo "<table class='table table-bordered'>";
                                echo "<thead class='thead-dark'>";
                                    echo "<tr>";
                                        echo "<th scope='col'>EMPLY ID</th>";
                                        echo "<th scope='col'>USER NAME</th>";
                                        echo "<th scope='col'>EDIT</th>";
                                        echo "<th scope='col'>DELETE</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                    foreach($result as $item){
                                        echo "<tr>";
                                            echo "<th scope='row'>".$item['emp_id']."</th>";
                                            echo "<td>".$item['user_login_id']."</td>";
                                            echo "<td onclick='loadEditModal(".$item['emp_id'].")' class='edit_user' style='cursor: pointer'>Edit User</td>";
                                            echo "<td onclick='deleteUser(".$item['emp_id'].")' class='delete_user' style='cursor: pointer'>Delete User</td>";
                                        echo "</tr>";
                                    }
                                echo "</tbody>";
                            echo "</table>";
                            
                            echo "<a class='btn btn-secondary' data-toggle='modal' data-target='#clicktocallModal' data-whatever=''>Add User</a>";
                            
                            // Modal Class Starts
                            echo "<div class='modal fade' id='clicktocallModal' url='".BASEURL."' tabindex='-1' role='dialog' aria-labelledby='clicktocallModalLabel' aria-hidden='true' data-backdrop='static' data-keyboard='false'>";
                                echo "<div class='modal-dialog' role='document'>";
                                    echo "<div class='modal-content'>";
                                        echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='clicktocallModalLabel'>Add user data</h5>";
                                            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                                                echo "<span aria-hidden='true'>&times;</span>";
                                            echo "</button>";
                                        echo "</div>";

                                        echo "<div class='modal-body'>";
                                            echo "<div class='form-group'>";
                                                echo "<input type='text' class='form-control empId' placeholder='Employment Id' style='font-size: 18px'> <br>";
                                                echo "<input type='text' class='form-control userId' placeholder='User Login Id' style='font-size: 18px'> <br>";
                                                echo "<input type='text' class='form-control userPass' placeholder='User Password' style='font-size: 18px'>";
                                            echo "</div>";
                                            echo "<div class='modal-footer pb-0'>";
                                                echo "<button onclick='submitVal()' id='clicktocallbutton' type='button' class='btn btn-primary mt-0 mb-0' style='background-color: #823287; border-color: #823287; font-size: 15px'>Add</button>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";


                        //Edit Modal Class Starts
                        echo "<div class='modal fade' id='exist__emp' url='".BASEURL."'>";
                            echo "<div class='modal-dialog modal-lg' role='document'>";
                                echo "<div class='modal-content '>";
                                    echo "<div class='modal-header mod_head'>";
                                        echo "<h4 class='text-center modal_head'><b>Edit Existing Employee<b></h4>";
                                            echo "<span class='pull-right'>";
                                                echo "<a role='button' class='close_m' data-dismiss='modal' aria-label='Close' style='cursor: pointer'>";
                                                    echo "<i aria-hidden='true'>&times;</i>";
                                                echo "</a>";
                                            echo "</span>";
                                        echo "</h3>";
                                    echo "</div>";
                                    echo "<div class='modal-body exist_emp'>";
                                        //Here the data being populated by the passing of emp_id via jQUERY to db_function
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";            
                    }
                }
            }else{
                header('location: '.BASEURL.'login.php'); //Redirecting based upon the URL, no href
            }

            $conn->close();
        ?>    

        <!-- jQuery URL Import-->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity='' crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>