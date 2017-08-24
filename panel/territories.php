<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/ExilePHPAdminTools/includes/queries.php";
include_once ($path);
$Territories=Territories();
$TerritoryCount = TerritoryCount();
?>
<!DOCTYPE html>
<?php include('header.php'); ?>
<html>
  <body>
    <!-- Navigation Bar Start -->
    <?php include('navbar.php'); ?>
    <!-- Navigation Bar End -->
    <!-- Jumbotron - Start -->
    <div class="jumbotron" style="padding-top:10px; margin-top:-21px; ">
      <h1><center>TERRITORIES</center></h1>
      <h2><center><?php echo $_SESSION['dbase'];?></center></h2>
      <h2><center><?php echo "(".$TerritoryCount[0]['count'].")"; ?></center></h2>
    </div>
    <div style="height: 10px;">&nbsp;</div>
    <!-- Jumbotron - End -->
    <!-- Datatable Start -->
    <center>
    <div class="form-group">
      <div class="input-group input-group-default">
        <input class="form-control input-sm" type="text" id="search" placeholder="Quick Search...">
      </div>
    </div>
    </center>
    <div class=" table-responsive" style="max-width:1400px;  margin:auto;">
      <table class=" table-bordered table table-hover" id="table" style="margin: auto;">
        <thead style='background-color: #375A7F;'>
          <tr>
            <th><center>Territory ID</center></th>
            <th><center>Territory Name</center></th>
            <th><center>Owner</center></th>
            <th><center>Owner ID</center></th>
            <th><center>Level</center></th>
            <th><center>Radius</center></th>
            <th><center>Last Paid</center></th>
            <th><center>Protection Due</center></th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($Territories as $Territory) {
          echo "<tr>";
            echo "<td><center>".$Territory['id']."<center></td>";
            echo "<td><center>".$Territory['name']."<center></td>";
            echo "<td><center>".$Territory['playername']."</center></td>";
            echo "<td><center><a href='playerinfo.php?pid=".$Territory['owner_uid']."'>".$Territory['owner_uid']."</a></center</td>";
            echo "<td><center>".$Territory['level']."<center></td>";
            echo "<td><center>".$Territory['radius']."<center></td>";
            echo "<td><center>".$Territory['last_paid_at']."<center></td>";
            echo "<td><center>".$Territory['ProtectionDue']."<center></td>";
          echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
    <!-- Datatable End -->
    <br>
    <br>
    <center><a href='stolenbases.php'><button type='button' class='btn btn-default'>RETURN</button></a></center>
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