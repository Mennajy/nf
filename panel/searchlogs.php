<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/ExilePHPAdminTools/includes/queries.php";
include_once($path);
if (count($_GET)) {
$pid=$_GET['pid'];
$range="All";
}else {
$pid=trim($_POST['pid']);
$range=trim($_POST['days']);
}
$Logns=FindLogNames($pid,$range);
$Player=FindPlayerByID($pid);
?>
<!DOCTYPE html>
<?php include('header.php'); ?>
<head>
  <style>
  table { table-layout: fixed; }
  table td { word-wrap: break-word; }
  </style>
</head>
<html>
  <body>
    <!-- Navigation Bar Start -->
    <?php include('navbar.php'); ?>
    <!-- Navigation Bar End -->
    <!-- Jumbotron - Start -->
    <div class="jumbotron" style="padding-top:10px; margin-top:-21px; ">
      <h1><center>SEARCH LOGS</center></h1>
       <h3 style='margin-top:5px; margin-bottom: 10px;'><b><center><?php echo $range; ?> Day(s)<br></center></b></h3><br>
      <h3 style='margin-top:5px; margin-bottom: 10px;'><b><center><?php echo $Player[0]['name']; ?><br><?php echo "<td><center><a href='playerinfo.php?pid=".$Player[0]['uid']."'>".$Player[0]['uid']."</a></center</td>"; ?><br></center></b></h3>
            <h2><center><?php echo $_SESSION['dbase'];?></center></h2>   
      
    </div>
    <div style="height: 10px;">&nbsp;</div>
    <!-- Jumbotron - End -->
    <center>
  <div>
    <a href="logs.php"><button type="button" class="btn btn-default">RETURN</button></a>
  </div>
    </center>
    <!-- Datatable Start -->
  </div><br>
  
  <div class="row" style="margin-left: 100px; margin-right: 100px;">
    <div class=" table-responsive" margin:auto;">
      <?php
      foreach ($Logns as $Logn) {
      echo "<h3 style='margin-bottom:0px;'><b>".$Logn['logname']."</b></h3>";
      echo "<table class=' table-bordered table table-hover' id='tabla' style='margin: auto;'>";
        echo "<thead style='background-color: #375A7F;'>";
          echo "<tr>";
            echo "<th style='width:175px;'><center>DATE</center></th>";
            echo "<th><center>LOGENTRY</center></th>";
          echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
          $entries=FindLogEntries($pid,$range,$Logn['logname']);
          foreach ($entries as $entry) {
          echo "<tr>";
            echo "<td><h6><center>".$entry['time']."</center></h6></td>";
            echo "<td><h6>".$entry['logentry']."</h6></td>";
          echo "</tr>";
          }
        echo "</tbody>";
      echo "</table>";
      echo "<br>";
      echo "<br>";
      }
      ?>
    </div>
  </div>
</div>
<div class="col-md-12">
  <center>
  <div>
    &nbsp;
    &nbsp;
    <a href="logs.php"><button type="button" class="btn btn-default">RETURN</button></a>
  </div>
  </center>
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
$( '#table' ).searchable();
</script>