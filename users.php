<?php include "header.php" ;
checkLogin(0);
$list_view = true;

?>

<div class="col-md-12">


<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Users List</h3>
  </div>
  <div class="panel-body">

<?php 

if(isset($_REQUEST['addit']) ){

$usernameI =  inp('username');
    if($usernameI AND !empty($usernameI)){

    $newst = "INSERT INTO users (username,password,full_name,email,address,phone,level ) VALUES ('" . strtolower(inp('username')) . "','". inp('user_password') ."','". inp('user_full_name') ."','". inp('user_email') ."','". inp('user_address') ."','". inp('user_phone') ."','". inp('user_level') ."')";
   if($db->query($newst)){

    echo '<div class="alert alert-dismissible alert-success">
  		<button type="button" class="close" data-dismiss="alert">&times;</button>
  		<strong>Success! </strong> User Added.</div>';

    } else {
        echo '<div class="alert alert-dismissible alert-danger">
  		<button type="button" class="close" data-dismiss="alert">&times;</button>
  		<strong>Error! </strong> Error while adding user, Kindly check all the fields and try again.</div>';
    }
}

}

if(isset($_REQUEST['sendpass'])){
    
    $id = inp('sendpass');
    
    $u = $db->query("SELECT * FROM users WHERE id = '$id'");
    
                            if($u->num_rows > 0){
    
                                        $us  = $u->fetch_object();
    
                                        $subject = "Create Your Password - " . $site->title;
                                        $to = $us->email;
                                        $body = "Dear $us->full_name,<br/><br/>Your account has been created and you can create your password to login, Please click the following link to create your password.<br/><br/>";
    
                                        $key = generateRandomString(20);
    
                                        $db->query("UPDATE users SET rkey = '$key' WHERE id= '$id'");
    
                                        $link = $site->url . '?key=' . $key;
    
                                        $body .= "<a href='$link'>$link</a> <br/><br/>Kind Regards<br/><strong>$site->title Team</strong>";
                                        
                                        sendEmail($to,$subject,$body);
    
                                       
    echo '<div class="alert  alert-success">
    <strong>Success! </strong> Password sent to the user Email...</div>';
    
    
                            } else {
                                echo '<div class="alert alert-danger">
                                <strong>Error! </strong> Error occured.</div>';
                            }

}


echo '<div id="toolbar">
        <a  class="btn btn-primary" data-toggle="modal" href="#addnew">
            <i class="glyphicon glyphicon-add"></i> Add New User
        </a>
    </div>';

?>


<table id="table"
           data-toolbar="#toolbar"
           data-search="true"
           data-show-refresh="true"
           
           data-show-columns="true"
           data-show-export="true"
           
           data-minimum-count-columns="2"
           data-show-pagination-switch="true"
           data-pagination="true"
           data-id-field="user_id"
           data-page-list="[10, 25, 50, 100, ALL]"
           data-show-footer="false"
           data-side-pagination="server"
           data-url="getUsers.php"
          
    </table>




</div>

<?php include "footer.php"; ?>





<div class="modal fade form-horizontal" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" role="form" class="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">
                   Add New User
                </h4>
            </div>
            <div class="modal-body">


     <div class="form-group">
        <label class="control-label col-sm-4" for="user_level">
            User Type
        </label>
        <div class="col-sm-8">
         <select name="user_level" id="user_level" class="form-control">   

         <?php foreach($levels as $key => $val){
             echo "<option value='$key'>$val</option>";
         } ?>

         </select>
    
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-sm-4" for="username">
            Username *
        </label>
        <div class="col-sm-8">
            <input class="form-control" id="username" name="username" type="text" required/>
        </div>
    </div>

     <div class="form-group">
        <label class="control-label col-sm-4" for="user_password">
            Password *
        </label>
        <div class="col-sm-8">
            <input class="form-control" id="user_password" name="user_password" type="text" required/>
        </div>
    </div>

     <div class="form-group">
        <label class="control-label col-sm-4" for="user_full_name">
           Full Name
        </label>
        <div class="col-sm-8">
            <input class="form-control" id="user_full_name" name="user_full_name" type="text"/>
        </div>
    </div>

     <div class="form-group">
        <label class="control-label col-sm-4" for="user_phone">
            Phone
        </label>
        <div class="col-sm-8">
            <input class="form-control" id="user_phone" name="user_phone" type="text"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-4" for="user_email">
            Email *
        </label>
        <div class="col-sm-8">
            <input class="form-control" id="user_email" name="user_email" type="email" required/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-4" for="user_address">
            Address
        </label>
        <div class="col-sm-8">
        <textarea class="form-control" id="user_address" name="user_address"></textarea>
           
        </div>
    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default col-md-offset-7 col-sm-2 " data-dismiss="modal">
                    Close
                </button>
                <input type="submit" class="btn btn-primary col-sm-2" value="Add" name="addit" />
                    
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    var $table = $('#table'),
        $remove = $('#remove'),
        selections = [];

    $(function () {
        $table.bootstrapTable({
            height: getHeight(),
            columns: [
                
               
                    {
                        field: 'id',
                        title: 'ID',
                        sortable: true,
                        align: 'center'
                    }, {
                        field: 'username',
                        title: 'UserName',
                        sortable: true,
                        align: 'center'
                    }
                    , {
                        field: 'full_name',
                        title: 'Name',
                        sortable: true,
                        align: 'center'
                    }, {
                        field: 'email',
                        title: 'Email',
                        sortable: true,
                        align: 'center'
                    }
                    , {
                        field: 'phone',
                        title: 'Phone',
                        sortable: true,
                        align: 'center'
                    }, {
                        field: 'level',
                        title: 'Type',
                        sortable: true,
                        align: 'center',
                        formatter: levelFormat
                    }
                    , {
                        field: 'action',
                        title: 'Action',
                        align: 'center',
                        formatter: actionForm
                    }
                    
            ]
        });
        // sometimes footer render error.
        setTimeout(function () {
            $table.bootstrapTable('resetView');
        }, 200);
       
        
       
      
        $(window).resize(function () {
            $table.bootstrapTable('resetView', {
                height: getHeight()
            });
        });
    });


    function actionForm(value, row, index) {
      //  console.log(row);
        var rt = '<a class="btn btn-danger" data-toggle="tooltip" title="Delete User" href="javascript:del('+row.id+');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a><span style="margin-left:5px;"></span><a target="_blank"  data-toggle="tooltip" title="Update User Profile" href="profile.php?editid='+row.id+'" class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></a>';

        rt += '<span style="margin-left:5px;"></span><a  data-toggle="tooltip" title="Send password to user e-mail"  href="users.php?sendpass='+row.id+'" class="btn btn-success"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></a>'
        return  rt;
    }



var levels = <?php echo json_encode($levels); ?>;


function levelFormat(value, row, index) {
      //  console.log(row);
        
        return  levels[row.level];
    }

 

    function getHeight() {
        return $(window).height() - $('h1').outerHeight(true);
    }





function del(delid)
{   


bootbox.confirm({
    size:'small',
    message: "Are you sure, you want to delete this User?",
    buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-danger'
        },
        cancel: {
            label: 'No',
            className: 'btn-success'
        }
    },
    callback: function (result) {
        
        if(result){
                document.location.href = 'del.php?table=users&col=id&id='+delid + '&loc='+ document.location;   
        }

    }
});

    
}

</script>