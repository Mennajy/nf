<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/ExilePHPAdminTools/includes/queries.php";
include_once ($path);
$Accounts=FindDupersWaste();
?>
<!DOCTYPE html>
<?php include('header.php'); ?>
<head>
  <script>
  $(document).ready(function(){
  $(function(){
  $("#tabla").tablesorter();
  });
  });
  </script>
</head>
<html>
  <body>
    <!-- Navigation Bar Start -->
    <?php $search = "False"; ?> <!-- True or False -->
    <?php include('navbar.php'); ?>
    <!-- Navigation Bar End -->
    <!-- Jumbotron - Start -->
    <div class="jumbotron" style="padding-top:10px; margin-top:-21px; ">
      <h1><center>WASTE TRADER CHECK</center></h1>
      <h2><center><?php echo $_SESSION['dbase'];?></center></h2>
    </div>
    <div style="height: 10px;">&nbsp;</div>
    <!-- Jumbotron - End -->
    <center>
    <div class="form-group">
      <div class="input-group input-group-default">
        <input class="form-control input-sm" type="text" id="search" placeholder="Quick Search...">
      </div>
    </div>
    </center>
    <!-- Datatable Start -->
    <div class=" table-responsive" style="max-width:1500px;  margin:auto;">
      <table class=" table-bordered table table-hover" id="tabla" style="margin: auto;">
        <thead style='background-color: #375A7F;'>
          <tr>
            <th><center>Date</center></th>
            <th><center>PlayerName</center></th>
            <th><center>Player ID</center></th>
            <th><center>Vehicle Used/Sold</center></th>
            <th><center>Item Sold</center></th>
            <th><center>Quantity</center></th>
            <th><center>Poptabs Earned</center></th>
            <th><center>Transaction ID</center></th>
          </tr>
        </thead>
        <tbody>
          <?php
          
          $counter=0;
          foreach ($Accounts as $Account) {
          $counter=$counter+1;
          $pid = "";
          echo "<tr>";
            echo "<td><center>".$Account['time_sold']."<center></td>";
            echo "<td><center>".$Account['playername']."<center></td>";
            echo "<td><center><a href='searchlogs.php?pid=".$Account['playerid']."'>".$Account['playerid']."</a></center></td>";
            echo "<td><center>".$Account['vehicleclass']."<center></td>";
            echo "<td><center>".$Account['item_sold']."<center></td>";
            echo "<td><center>".$Account['quantity']."<center></td>";
            echo "<td><center>".number_format($Account['poptabs'])."<center></td>";
            echo "<td><center><a href='dupers_waste_transaction.php?pid=".$Account['transactionid']."'>".$Account['transactionid']."</a></center></td>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <!-- Datatable End -->
      <!-- Footer Start -->
      <div style="height: 100px;">&nbsp;</div>
      <footer id="footer" class="container footer">
        <div class="copyright">
          <center>Copyright © 2017 <a href="http://www.atdgaming.com">ATD Gaming</a></center>
          <div style="height: 10px;">&nbsp;</div>
        </div>
      </footer>
      <!-- Footer End -->
    </body>
  </html>
  <script type="text/javascript">
  $( '#tabla' ).searchable();
  </script>