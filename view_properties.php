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
                   data-url="getViewProperties.php"

            </table>


        </div>

        <?php include "footer.php"; ?>








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
                            align: 'center'
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
                            field: 'id',
                            title: 'Action',
                            sortable: false,
                            align: 'center',
                            formatter: rowsLog
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

                rt = '<a  href="viewproperty.php?id='+value+'"  class="btn btn-xs btn-primary bb'+index+'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></a>';

                return  rt;
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

                rt += '<a data-toggle="modal" href="#addnew" data-type="update" data-index="'+index+'" class="btn btn-xs btn-primary bb'+index+'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></a>';

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

                    modal.find("#address").val(r.address);

                    modal.find("#type").val(r.type);

                    modal.find("#rooms").val(r.rooms);

                    modal.find("#rent").val(r.rent);

                    modal.find("#owner_id").val(r.owner_id);

                    modal.find("#pictures").val(r.pictures);

                    modal.find("#floorplan").val(r.floorplan);
                }

            });
        </script>