<?php 
  include('dbconnect.php');

//CRUD: Retrieve booking
$sql="SELECT * FROM tb_matlist";

//Execute
$result=mysqli_query($con,$sql);

//Display result
include 'headermain.php';
?>
<body>
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Constrcution</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Material List</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th>Unit Price(RM)</th>
                                                <th>Quantity</th>
                                                <th>Add/Minus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($row=mysqli_fetch_array($result))
                                                {
                                                    echo "<tr>";
                                                    echo"<td>".$row['m_id']. "</td>";
                                                    echo"<td>".$row['m_name']. "</td>";
                                                    echo"<td>".$row['m_type']. "</td>";
                                                    echo"<td>".$row['m_desc']. "</td>";
                                                    echo"<td>".$row['m_price']. "</td>";
                                                    echo"<td>".$row['m_qty']. "</td>";
                                                    echo "<td>";
                                                        echo "<a href='const-modifyprocess.php?id=".$row['m_id']."&action=add' class='btn btn-warning'>+</a>&nbsp";
                                                        echo "<a href='const-modifyprocess.php?id=".$row['m_id']."&action=minus' class='btn btn-danger'>-</a>";
                                                    echo"</td>";
                                                    echo "</tr>";
                                                } 
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th>Unit Price</th>
                                                <th>Quantity</th>
                                                <th>Add/Minus</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        <?php include 'footer.php'; ?>
</body>

