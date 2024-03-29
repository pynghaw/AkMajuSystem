<?php 

include('mysession.php');
if (!session_id()) {
    session_start();
}

include('dbconnect.php');

// Check for the status parameter in the URL
$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'all';

// SQL query based on the status filter
$sqlr = "SELECT tb_user.*, tb_status.s_desc, tb_user.u_type
         FROM tb_user
         LEFT JOIN tb_status ON tb_user.u_status = tb_status.s_status
         WHERE 1 ";

if ($statusFilter === 'activate') {
    $sqlr .= " AND tb_status.s_desc = 'Active'";
} elseif ($statusFilter === 'deactivate') {
    $sqlr .= " AND tb_status.s_desc = 'Inactive'";
}

$resultr = mysqli_query($con, $sqlr);

include('headermainadmin.php');
?>

<div class="content-body">
  <?php if (isset($_SESSION['register_message'])):?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['register_message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    // Unset the session variable to avoid displaying the message again on refresh
    unset($_SESSION['register_message']);?>
<?php endif;?>
    <?php if (isset($_SESSION['update_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['update_message']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['update_message']); ?>
    <?php endif; ?>


    <!-- row -->
    <style>
      /* style.css */
      .custom-table {
          border-collapse: collapse;
          width: 100%;
          box-shadow: 0px 0px 5px 0px #888888;
      }

      .custom-table th, .custom-table td {
          border: 1px solid #dddddd;
          padding: 8px;
          text-align: left;
      }

      .custom-table th {
          background-color: #f2f2f2;
      }

      .custom-table tbody tr:nth-child(even) {
          background-color: #f9f9f9;
      }

      .custom-table tbody tr:hover {
          background-color: #f0f0f0;
      }

      .custom-table td.action-btns {
          white-space: nowrap;
      }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="container mt-4">
                        <div class="container">
                            <h2 style="text-align:center;">Manage User Account</h2><br>

                       
<div class="mb-3 d-flex justify-content-between">
   <div>
                                    <a href="registeradmin.php" class="btn btn-success"><i class="fa fa-user-plus"></i>Register User</a>
                                </div>
    <div class="ml-auto">
        
        <select id="status" class="form-control form-control-sm" name="status" onchange="filterAccounts(this.value)">
            <option value="all" <?php echo ($statusFilter === 'all') ? 'selected' : ''; ?>>Show All Status</option>
            <option value="activate" <?php echo ($statusFilter === 'activate') ? 'selected' : ''; ?>>Active Category</option>
            <option value="deactivate" <?php echo ($statusFilter === 'deactivate') ? 'selected' : ''; ?>>Inactivate Category</option>
        </select>
    </div>
</div>




                            <table class="table table-hover table-bordered custom-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">User ID</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Account Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($rowr = mysqli_fetch_array($resultr)) {
                                        $statusClass = ($rowr['s_desc'] == 'Active') ? 'text-success' : 'text-danger';
                                        echo "<tr>";
                                        echo "<td>".$rowr['u_id']."</td>";
                                        echo "<td>".$rowr['u_name']."</td>";
                                        echo "<td>".$rowr['u_email']."</td>";
                                        echo "<td>".$rowr['u_sex']."</td>";
                                        echo "<td>".$rowr['u_contNo']."</td>";
                                        echo "<td class='$statusClass'>".$rowr['s_desc']."</td>";
                                        echo "<td>";
                                        echo "<a href='manage.php?id=".$rowr['u_id']."' class='btn btn-warning btn-sm padd'>Manage</a> &nbsp";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function filterAccounts(status) {
        // Redirect to the current page with the selected status as a query parameter
        window.location.href = '?status=' + status;
    }
</script>

<?php include 'footer.php';?>
