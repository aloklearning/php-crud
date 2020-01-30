// This is used as a bridge between the front end and the backend
// The front end data handling and backend request to db_functions will be done by this file

//Add User Modal Handler
function submitVal(){
    var BASE = $('#clicktocallModal').attr('url');
    var empId = $('body').find('.empId').val();
    var userId = $('body').find('.userId').val();
    var userPass = $('body').find('.userPass').val();

    $.post(BASE + "db_function.php", {
        emp_add: 'emp_add',
        emp_id: empId,
        user_id: userId,
        user_pass: userPass
    }, function(data, textStatus){
        window.location.reload();
    });
}

//Edit User Function
function loadEditModal(emp_id){
    console.log('Editing Id: '+ emp_id);
    var BASE = $('#exist__emp').attr('url');
    //passing the data to db_function to load the content
    $("#exist__emp .modal-body.exist_emp").load(BASE + 'db_function.php?edit_emp=edit_emp&emp_id=' + encodeURIComponent(emp_id), function(response, status) {
        if (status == "success") {
            //Showing up the modal class via db_function.php
            $("#exist__emp").modal('show');		
        }
    });
}

function editVal(user_db_id){
    var BASE = $('#exist__emp').attr('url');
    $empID = document.getElementById("editEmpId").value;
    $userLoginID = document.getElementById("editUserId").value;
    $userPass = document.getElementById("editUserPass").value;
    
    $.post(BASE + 'db_function.php', {
        emp_edit: 'emp_edit',
        userDBId: user_db_id,
        empId: $empID,
        userId: $userLoginID,
        userPass: $userPass
    }, function(data, textStatus){
        window.location.reload();
    });
}

//Delete User
function deleteUser(emp_del_id){
    console.log('Deleting Id:'+ emp_del_id);
    var BASE = $('#exist__emp').attr('url');
    var deleteUser = confirm('Are you sure you want to delete this user from the entry?');
    
    if(deleteUser == true){
        $.post(BASE + 'db_function.php', {
            emp_del: 'emp_del',
            empDelId: emp_del_id
        }, function(data, textStatus){
            window.location.reload();
        });
    }
    
}