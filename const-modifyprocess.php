<?php 
  include('dbconnect.php');

  if(isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    
    // SQL to get current quantity
    $sql = "SELECT m_qty FROM tb_matlist WHERE m_id = $id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if($row) {
        $currentQty = $row['m_qty'];

        if ($action == 'add') {
            $newQty = $currentQty + 1;
        } elseif ($action == 'minus' && $currentQty > 0) {
            $newQty = $currentQty - 1;
        } else {
            $newQty = $currentQty;
        }

        // SQL to update quantity
        $updateSql = "UPDATE tb_matlist SET m_qty = $newQty WHERE m_id = $id";
        mysqli_query($con, $updateSql);
    }
    
    // Redirect back to the list page
    header('Location: const-matlist.php');
    exit;
}

?>




