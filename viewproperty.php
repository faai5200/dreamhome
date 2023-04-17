<?php include "header.php" ;
checkLogin(0);
$list_view = true;

$id = $_GET['id'];
$q = "SELECT properties.*, users.full_name as owner_name FROM properties JOIN users ON properties.owner_id = users.id WHERE properties.id='$id'";
$res = $db->query($q);

$property = $res->fetch_assoc();

$q = "INSERT INTO property_view (property_id, user_id) VALUES ('$id', '".$_SESSION['user']->id."')";
$res = $db->query($q);


?>

<div class="col-md-12">


    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><a href="#" onclick="window.history.back()" class="btn btn-xs btn-default" style="margin-right:  25px;"><span class="glyphicon glyphicon-menu-left"></span>GO BACK</a> Viewing Property: <strong><?php echo $property['title']; ?></strong></h3>
        </div>
        <div class="panel-body">

            <div class="col-md-12">


                <img style="width: 100%; height: 450px; object-fit: cover" src="property_images/<?php echo strlen($property['pictures'])>0?$property['pictures']:'property.jpeg'; ?>">

                <div>
                   <div class="col-md-7">
                    <h2><?php echo $property['title']; ?></h2>
                    <p><?php echo $property['description']; ?></p>
                   </div>

                    <div class="col-md-5">
                        <table class="table table-bordered table-inverse table-responsive" style="margin-top: 25px">
                            <tbody>
                            <tr>
                                <td scope="row" colspan="2" style="text-align: center; background-color: silver"><b>Property Details</b></td>
                            </tr>
                            <tr>
                                <td scope="row" style="font-weight: bold">Date Posted</td>
                                <td scope="row"><?php echo $property['date_created']; ?></td>
                            </tr>
                            <tr>
                                <td scope="row" style="font-weight: bold">Address</td>
                                <td scope="row"><?php echo $property['address']; ?></td>
                            </tr>
                            <tr>
                                <td scope="row" style="font-weight: bold">Type</td>
                                <td scope="row"><?php echo $property['type']; ?></td>
                            </tr>
                            <tr>
                                <td scope="row" style="font-weight: bold">Rooms</td>
                                <td scope="row"><?php echo $property['rooms']; ?></td>
                            </tr>
                            <tr>
                                <td scope="row" style="font-weight: bold">Rent</td>
                                <td scope="row"><?php echo $property['rent']; ?></td>
                            </tr>
                            <tr>
                                <td scope="row" style="font-weight: bold">Owner</td>
                                <td scope="row"><?php echo $property['owner_name']; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if(strlen($property['floorplan']) > 0){
                          ?>
                            <img style="width: 100%; height: 450px; object-fit: cover" src="property_images/<?php echo $property['floorplan']; ?>">
                        <?php
                        }
                        ?>
                    </div>

                </div>
            </div>



        </div>

        <?php include "footer.php"; ?>






