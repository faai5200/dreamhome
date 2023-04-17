<?php include "header.php" ;
checkLogin(0);
$list_view = true;

?>

<div class="col-md-12">


    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><a href="data.php" class="btn btn-xs btn-default" style="margin-right:  25px;"><span class="glyphicon glyphicon-menu-left"></span>GO BACK</a>Properties</h3>
        </div>
        <div class="panel-body">

            <?php




            if($isStaff){

              $q = "SELECT * FROM users WHERE level < 2";
            }
            elseif($isAdmin){
                $q = "SELECT * FROM users WHERE level < 2";
            }
            $ownsers = $db->query($q);



            if(inp("update")){





                $sq = "UPDATE properties SET
     	
        title = '".inp('title')."',   	
        description = '".inp('description')."',   	
        address = '".inp('address')."',   	
        `type` = '".inp('type')."',   	
        rooms = '".inp('rooms')."',   	
        rent = '".inp('rent')."',   	
        owner_id = '".inp('owner_id')."'";

                if (!empty($_FILES['pictures']['name'])) {
                    $img = saveImage('property_images/', 'pictures');
                    $sq .= ", pictures = '".$img."'";
                }
                if (!empty($_FILES['floorplan']['name'])) {
                    $floorplan = saveImage('property_images/', 'floorplan');
                    $sq .= ", floorplan = '".$floorplan."'  ";
                }





                $sq .= " WHERE id = '".inp('tb_id')."'";

                if($db->query($sq)){


                    echo '<div class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Success! </strong> Property Updated succesfully.</div>';

                } else {
                    echo '<div class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Error! </strong> Error while updating the  Property.</div>';
                }

            }


            if(inp("addit")){


                $img='';
                $floorplan='';
                if (!empty($_FILES['pictures']['name'])) {
                    $img = saveImage('property_images/', 'pictures');
                    $sq = ", pictures = '".$img."'";
                }
                if (!empty($_FILES['floorplan']['name'])) {
                    $floorplan = saveImage('property_images/', 'floorplan');
                    $sq = ", floorplan = '".$floorplan."'  ";
                }

                $sq = "INSERT INTO properties (
            title, description,address,type,rooms,rent,owner_id,pictures,floorplan";

                $sq .= ") VALUES('".inp('title')."','".inp('description')."','".inp('address')."','".inp('type')."','".inp('rooms')."','".inp('rent')."','".inp('owner_id')."','".$img."','".$floorplan."')";

                if($db->query($sq)){


                    echo '<div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Success! </strong> Property Added succesfully.</div>';

                } else {
                    echo '<div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Error! </strong> Error while Adding the  Property.</div>';
                }

            }


            if($isAdmin || $isStaff){

                echo '<div id="toolbar">
    <a  class="btn btn-primary nn" data-type="new" data-toggle="modal" href="#addnew">
        <span class="glyphicon glyphicon-plus"></span> Add New Property
    </a>
</div>';

            }

            $param = "";

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
                   data-id-field="id"
                   data-page-list="[10, 25, 50, 100, ALL]"
                   data-show-footer="false"
                   data-side-pagination="server"
                   data-url="getProperties.php"

            </table>


        </div>

        <?php include "footer.php"; ?>



        <div class="modal fade form-horizontal" id="addnew">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?php echo $_SERVER["PHP_SELF"] . $param;?>" method="POST" enctype="multipart/form-data" role="form" class="">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                &times;
                            </button>
                            <h4 class="modal-title">
                                Add New Property
                            </h4>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" id="tb_id" name="tb_id" />



                            <div class="form-group">
                                <label class="control-label col-sm-4" for="title">
                                    Title        </label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="title" name="title" type="text" />
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-sm-4" for="title">
                                    Description        </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="description" name="description" ></textarea>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="control-label col-sm-4" for="address">
                                    Address        </label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="address" name="address" type="text" />
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="control-label col-sm-4" for="type">
                                    Type        </label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="type" name="type" type="text" />
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="control-label col-sm-4" for="rooms">
                                    Rooms        </label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="rooms" name="rooms" type="text" />
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="control-label col-sm-4" for="rent">
                                    Rent        </label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="rent" name="rent" type="text" />
                                </div>
                            </div>


                            <input type="hidden" id="owner_id"  name="owner_id" value="<?php echo $_SESSION['user']->id; ?>">



                            <div class="form-group">
                                <label class="control-label col-sm-4" for="pictures">
                                    Picture        </label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="pictures" name="pictures" type="file" />
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="control-label col-sm-4" for="floorplan">
                                    Floorplan        </label>
                                <div class="col-sm-8">
                                    <input class="form-control" id="floorplan" name="floorplan" type="file" />
                                </div>
                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-default col-md-offset-7 col-sm-2 " data-dismiss="modal">
                                    Close
                                </button>
                                <input type="submit" class="btn btn-primary col-sm-2" value="Add" id="submit_button" name="addit" />

                            </div>
                    </form>
                </div>
            </div>
        </div>




        <script>
            var rows = [];
            var $table = $('#table'),
                $remove = $('#remove'),
                selections = [];

            $(function () {
                $table.bootstrapTable({
                    height: getHeight(),
                    columns: [



                        {
                            field: 'title',
                            title: 'Title',
                            sortable: true,
                            align: 'center',
                            formatter: rowsLog
                        },
                        {
                            field: 'type',
                            title: 'Type',
                            sortable: true,
                            align: 'center'
                        },
                        {
                            field: 'rooms',
                            title: 'Rooms',
                            sortable: true,
                            align: 'center'
                        },
                        {
                            field: 'rent',
                            title: 'Rent',
                            sortable: true,
                            align: 'center'
                        },
                        {
                            field: 'owner_name',
                            title: 'Owner',
                            sortable: true,
                            align: 'center'
                        },
                        {
                            field: 'p_views',
                            title: 'Views',
                            sortable: true,
                            align: 'center'
                        },
                        {
                            field: 'id',
                            title: 'Action',
                            sortable: false,
                            align: 'center',
                            formatter: actionForm
                        },


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




            function getHeight() {
                return $(window).height() - $('h1').outerHeight(true);
            }


            function rowsLog(value,row,index){
                rows[index] = row;
                return value;
            }

            function tickCross(value,row,idex){

                if(value == "yes")
                    return '<span class="fa fa-check" style="color:green;"></span>';
                else
                    return '<span class="fa fa-times" style="color:red;"></span>'
            }



            function actionForm(value, row, index) {
                //  console.log(row);
                var rt = '<a class="btn btn-danger btn-xs" href="javascript:del('+row.id+');"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a>';

                rt += '<a  data-toggle="modal" href="#addnew" data-type="update" data-index="'+index+'" class="btn btn-xs btn-primary bb'+index+'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></a>';

                rt += '<a  href="viewproperty.php?id='+value+'"  class="btn btn-xs btn-primary bb'+index+'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></a>';


                return  rt;
            }




            function del(delid)
            {


                bootbox.confirm({
                    size:'small',
                    message: "Are you sure, you want to delete this Entry?",
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
                            document.location.href = 'del.php?id='+delid + '&col=id' + '&table=properties&loc='+ document.location;
                        }

                    }
                });

            }




            $('#addnew').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var type = button.data('type')
                var modal = $(this)

                if(type == "new"){
                    modal.find("form")[0].reset();
                    modal.find("#tb_id").val(0)
                    modal.find("#submit_button").val("Add");

                    modal.find(".modal-title").text(" Add New Property")

                    modal.find("#submit_button").prop("name","addit");
                    //  modal.find("#status_input").hide();

                } else {
                    var index = button.data('index')
                    modal.find("#submit_button").val("Update");

                    modal.find(".modal-title").text(" Update Property")


                    modal.find("#submit_button").prop("name","update");
                    var r = rows[index];
                    modal.find("#tb_id").val(r.id)

                    modal.find("#title").val(r.title);
                    modal.find("#description").val(r.description);

                    modal.find("#address").val(r.address);

                    modal.find("#type").val(r.type);

                    modal.find("#rooms").val(r.rooms);

                    modal.find("#rent").val(r.rent);

                    modal.find("#owner_id").val(r.owner_id);


                }

            });
        </script>