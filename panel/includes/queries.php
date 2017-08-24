<?php

   include_once 'condb.php';

    function TopTotalPoptabs(){
        $connect=connectdb();
        try {
            $sql="
            SELECT
                name,
                c.account_uid,
                sum(c.money)as total_container_tabs,
                locker,
                total_connections,
                (locker + sum(c.money)) as totalpoptabs,
            DATE_FORMAT(last_connect_at,'%b %d, %Y - %h:%i %p') as last_connect_at
            FROM container c 
            inner join account a on c.account_uid = a.uid 
            where c.money != 0
            group by account_uid
            ORDER BY totalpoptabs DESC limit 50
            ";
            $stmt=$connect->prepare($sql);
            $stmt->execute();
            $accounts = $stmt->fetchAll();
            return $accounts;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function TotalAccounts(){
        $connect=connectdb();
        try {
            $sql="
            SELECT COUNT(*) as totalaccounts FROM account WHERE account.last_connect_at >= DATE_ADD(CURDATE(), INTERVAL '-14' DAY)
            ";
            $stmt=$connect->prepare($sql);
            $stmt->execute();
            $accounts = $stmt->fetchAll();
            return $accounts;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    function TotalPoptabs(){
        $connect=connectdb();
        try {
            $sql="SELECT
                SUM(locker) AS totaltabs
                FROM
                account
                WHERE account.last_connect_at >= DATE_ADD(CURDATE(), INTERVAL '-14' DAY);";
            $stmt=$connect->prepare($sql);
            $stmt->execute();
            $accounts = $stmt->fetchAll();
            return $accounts;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function ServerInfo(){
        $connect=connectdb();
        try {
            $sql="SELECT
              (SELECT COUNT(class) FROM container) as count_container, 
              (SELECT COUNT(class) FROM construction) as count_construction";
            $stmt=$connect->prepare($sql);
            $stmt->execute();
            $accounts = $stmt->fetchAll();
            return $accounts;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function TerritoryInfobyID($id){
        $connect=connectdb();
        try {
            $sql="
            SELECT count(class) as container_count,sum(money) as container_money,
            (SELECT count(class)  FROM construction where account_uid = :id) as construction_count
            FROM container where account_uid = :id
            ";
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $play = $stmt->fetchAll();
            return $play;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function GetClanMembersByID($id){
        $connect=connectdb();
        try {
            $sql="
            SELECT name,uid from account where clan_id = :id
            ";
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $play = $stmt->fetchAll();
            return $play;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function GetClanNameByID($id){
        $connect=connectdb();
        try {
            $sql="
            select id,name from clan where id = :id
            ";
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $play = $stmt->fetchAll();
            return $play;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    function GetClanLeaderByID($id){
    $connect=connectdb();
    try {
        $sql="
        select leader_uid from clan where id = :id
        ";
        $stmt=$connect->prepare($sql);
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        $play = $stmt->fetchAll();
        return $play;
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    }
    function PlayerInfo($id){
        $connect=connectdb();
        try {
            $sql="
            SELECT uid,name,clan_id,score,locker,DATE_FORMAT(first_connect_at,'%b %d, %Y - %h:%i %p') as first_connect_at, DATE_FORMAT(last_connect_at,'%b %d, %Y - %h:%i %p') as last_connect_at, DATE_FORMAT(last_disconnect_at,'%b %d, %Y - %h:%i %p') as last_disconnect_at,total_connections from account where uid = :id
            ";
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $play = $stmt->fetchAll();
            return $play;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function TerritoryPlayerInfo($id){
        $connect=connectdb();
        try {
            $sql="
            SELECT id, owner_uid, name, radius, level,  DATE_FORMAT(DATE_ADD(last_paid_at,INTERVAL 8 DAY),'%b %d, %Y - %h:%i %p') as ProtectionDue from territory where owner_uid = :id
            ";
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $play = $stmt->fetchAll();
            return $play;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function FindTransactionByID($id){
        $connect=connectdb();
        try {
            $sql="
            SELECT  
            DATE_FORMAT(time_sold,'%b %d, %Y - %h:%i %p') as time_sold, name as playername, playerid, total_connections, score,locker, item_sold, vehicleclass, playerid , transactionid, poptabs, count(item_sold) as quantity,soldvehicle, DATEDIFF(last_connect_at,first_connect_at) as days_on_server
            FROM 
            trader_recycle_log
            inner join
            account a ON trader_recycle_log.playerid = a.uid
            WHERE trader_recycle_log.transactionid =:id
            GROUP BY
            item_sold, transactionid
            ORDER BY quantity DESC
            ";
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $play = $stmt->fetchAll();
            return $play;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

      function GetPlayerInfo($id){
        $connect=connectdb();
        try {
            $sql="
            SELECT  
            time_sold, name as playername, playerid, total_connections, score,locker, item_sold, vehicleclass, playerid , transactionid, poptabs, count(item_sold) as quantity,soldvehicle, DATEDIFF(last_connect_at,first_connect_at) as days_on_server
            FROM 
            trader_recycle_log
            inner join
            account a ON trader_recycle_log.playerid = a.uid
            WHERE trader_recycle_log.transactionid =:id
            GROUP BY
            item_sold, transactionid
            ORDER BY quantity DESC
            ";
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $play = $stmt->fetchAll();
            return $play;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function GetAllClans(){
        $connect=connectdb();
        try {
            $sql="
            SELECT id,clan.name,a.name as leader_name,leader_uid from clan
            inner join account a on leader_uid = a.uid
            ";
            $stmt=$connect->prepare($sql);
            $stmt->execute();
            $accounts = $stmt->fetchAll();
            return $accounts;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function FindDupersWaste(){
        $connect=connectdb();
        try {
            $sql="
            SELECT  
            DATE_FORMAT(time_sold,'%b %d, %Y - %h:%i %p') as time_sold, name as playername, playerid, item_sold, vehicleclass, playerid , transactionid, poptabs, count(item_sold) as quantity
            FROM 
            trader_recycle_log
            inner join
            account a ON trader_recycle_log.playerid = a.uid
            WHERE item_sold NOT LIKE 'Exile_Item_JunkMetal'
            GROUP BY
            item_sold, transactionid
            HAVING count(item_sold) > 10
            ORDER BY quantity DESC
            ";
            $stmt=$connect->prepare($sql);
            $stmt->execute();
            $accounts = $stmt->fetchAll();
            return $accounts;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function FindDupersTrader(){
        $connect=connectdb();
        try {
            $sql="
             SELECT name as playername, playerid, item_sold, COUNT(*) as amount, poptabs, DATE_FORMAT(time_sold,'%b %d, %Y - %h:%i %p') as time_sold
            FROM trader_log
            JOIN account a ON trader_log.playerid = a.uid
            WHERE time_sold > NOW() - INTERVAL 7 DAY
            AND playerid <> ''
            AND (
            item_sold =    'Exile_Item_Codelock' 
            OR item_sold = 'Exile_Item_Defibrillator' 
            OR item_sold = 'Exile_Item_SafeKit' 
            OR item_sold = 'Exile_Item_Grinder'
            OR item_sold = 'Exile_Item_MetalPole'
            OR item_sold = 'Exile_Item_SleepingMat'
            OR item_sold = 'Exile_Item_OilCanister'
            OR item_sold = 'Exile_Item_Foolbox'
            OR item_sold = 'Exile_Item_Screwdriver'
            OR item_sold like '%_Remote_Mag'
            OR item_sold like '%_Wire_Mag'
            OR item_sold like '%_Range_Mag'
            )
            GROUP BY playerid,item_sold
            ORDER BY COUNT(*) DESC
            ";
            $stmt=$connect->prepare($sql);
            $stmt->execute();
            $accounts = $stmt->fetchAll();
            return $accounts;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    function AllAccounts(){
        $connect=connectdb();
        try {
            $sql="
            SELECT name,uid,score,locker,
            DATE_FORMAT(first_connect_at,'%b %d, %Y - %h:%i %p') as first_connect_at,
            DATE_FORMAT(last_connect_at,'%b %d, %Y - %h:%i %p') as last_connect_at,
            DATE_FORMAT(last_disconnect_at,'%b %d, %Y - %h:%i %p') as last_disconnect_at,
            total_connections FROM account where last_connect_at >= (CURDATE() - INTERVAL 10 DAY ) ORDER BY name 
            ";
            $stmt=$connect->prepare($sql);
            $stmt->execute();
            $accounts = $stmt->fetchAll();
            return $accounts;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function LogEntriesByLogname($date1,$lo){
        $connect=connectdb();
        try {
            if ($date1=="All") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logname=:logn
                ORDER BY time";
            }elseif ($date1=="1") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 1 DAY
                ORDER BY time";
            }elseif ($date1=="2") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 2 DAY
                ORDER BY time";
            }elseif ($date1=="3") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 3 DAY
                ORDER BY time";
            }elseif ($date1=="4") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 4 DAY
                ORDER BY time";
            }elseif ($date1=="5") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 5 DAY
                ORDER BY time";
            }elseif ($date1=="6") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 6 DAY
                ORDER BY time";
            }elseif ($date1=="7") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 7 DAY
                ORDER BY time";
            }
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":logn",$lo);
            $stmt->execute();
            $logent = $stmt->fetchAll();
            return $logent;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    

    function TerritoryCount(){
     $connect=connectdb();
        try {
            $sql="
            SELECT count(name) as count from territory 
            ";
            $stmt=$connect->prepare($sql);
            $stmt->execute();
            $tnr = $stmt->fetchAll();
            return $tnr;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    function Territories(){
     $connect=connectdb();
        try {
            $sql="
            SELECT a.name as playername,t.owner_uid,t.id, t.name,t.level,t.radius,
            DATE_FORMAT(t.created_at,'%b %d, %Y - %h:%i %p') as created_at,
            DATE_FORMAT(t.last_paid_at,'%b %d, %Y - %h:%i %p') as last_paid_at,
            DATE_FORMAT(t.deleted_at,'%b %d, %Y - %h:%i %p') as deleted_at,
            DATE_FORMAT(DATE_ADD(last_paid_at,INTERVAL 8 DAY),'%b %d, %Y - %h:%i %p') AS ProtectionDue
            from territory t inner join account a ON t.owner_uid = a.uid
            where deleted_at is null and flag_stolen !=1 order by name ASC
            ";
            $stmt=$connect->prepare($sql);
            $stmt->execute();
            $tnr = $stmt->fetchAll();
            return $tnr;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

     function FindPlayerByName($name){
        $name0="%".$name."%";
        $connect=connectdb();
        try {
            $sql="
            SELECT uid,name,
            DATE_FORMAT(first_connect_at,'%b %d, %Y - %h:%i %p') as first_connect_at,
            DATE_FORMAT(last_connect_at,'%b %d, %Y - %h:%i %p') as last_connect_at,
            total_connections
            FROM account WHERE name LIKE :pname";
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":pname",$name0);
            $stmt->execute();
            $play = $stmt->fetchAll();
            return $play;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function UniqueLognames(){
        $connect=connectdb();
        try {
            $sql="select logname from infistar_logs group by logname order by logname;";
            $stmt=$connect->prepare($sql);
            $stmt->execute();
            $logn = $stmt->fetchAll();
            return $logn;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function FindPlayerByID($id){
        $connect=connectdb();
        try {
            $sql="SELECT * FROM account WHERE uid=:id";
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":id",$id);
            $stmt->execute();
            $play = $stmt->fetchAll();
            return $play;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function FindLogNames($pid,$date0){
        $pid0="%".$pid."%";
        $connect=connectdb();
        try {
            if ($date0=="All") {
                $sql="SELECT logname FROM infistar_logs
                WHERE logentry LIKE :pid
                GROUP BY logname";
            }elseif ($date0=="1") {
                $sql="SELECT logname FROM infistar_logs
                WHERE logentry LIKE :pid AND
                time >= DATE(NOW()) - INTERVAL 1 DAY
                GROUP BY logname";
            }elseif ($date0=="2") {
                $sql="SELECT logname FROM infistar_logs
                WHERE logentry LIKE :pid AND
                time >= DATE(NOW()) - INTERVAL 2 DAY
                GROUP BY logname";
            }elseif ($date0=="3") {
                $sql="SELECT logname FROM infistar_logs
                WHERE logentry LIKE :pid AND
                time >= DATE(NOW()) - INTERVAL 3 DAY
                GROUP BY logname";
            }elseif ($date0=="4") {
                $sql="SELECT logname FROM infistar_logs
                WHERE logentry LIKE :pid AND
                time >= DATE(NOW()) - INTERVAL 4 DAY
                GROUP BY logname";
            }elseif ($date0=="5") {
                $sql="SELECT logname FROM infistar_logs
                WHERE logentry LIKE :pid AND
                time >= DATE(NOW()) - INTERVAL 5 DAY
                GROUP BY logname";
            }elseif ($date0=="6") {
                $sql="SELECT logname FROM infistar_logs
                WHERE logentry LIKE :pid AND
                time >= DATE(NOW()) - INTERVAL 6 DAY
                GROUP BY logname";
            }elseif ($date0=="7") {
                $sql="SELECT logname FROM infistar_logs
                WHERE logentry LIKE :pid AND
                time >= DATE(NOW()) - INTERVAL 7 DAY
                GROUP BY logname";
            }
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":pid",$pid0);
            $stmt->execute();
            $lognames = $stmt->fetchAll();
            return $lognames;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function FindLogEntries($id,$date0,$lo){
        $pid0="%".$id."%";
        $connect=connectdb();
        try {
            if ($date0=="All") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logentry LIKE :pid AND
                logname=:logn
                ORDER BY time";
            }elseif ($date0=="1") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logentry LIKE :pid AND
                logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 1 DAY
                ORDER BY time";
            }elseif ($date0=="2") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logentry LIKE :pid AND
                logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 2 DAY
                ORDER BY time";
            }elseif ($date0=="3") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logentry LIKE :pid AND
                logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 3 DAY
                ORDER BY time";
            }elseif ($date0=="4") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logentry LIKE :pid AND
                logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 4 DAY
                ORDER BY time";
            }elseif ($date0=="5") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logentry LIKE :pid AND
                logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 5 DAY
                ORDER BY time";
            }elseif ($date0=="6") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logentry LIKE :pid AND
                logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 6 DAY
                ORDER BY time";
            }elseif ($date0=="7") {
                $sql="SELECT DATE_FORMAT(time,'%b %d, %Y - %h:%i %p') as time,logentry FROM infistar_logs
                WHERE logentry LIKE :pid AND
                logname=:logn AND
                time >= DATE(NOW()) - INTERVAL 7 DAY
                ORDER BY (time,'%m/%d/%Y %h:%i:%s') DESC";
            }
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":pid",$pid0);
            $stmt->bindValue(":logn",$lo);
            $stmt->execute();
            $logent = $stmt->fetchAll();
            return $logent;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

        function UpdateScoreLocker($uid,$sco,$loc){
        $connect=connectdb();
        try {
            $sql="UPDATE account set score=:sco, locker=:loc where uid=:uid";
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":sco",$sco);
            $stmt->bindValue(":loc",$loc);
            $stmt->bindValue(":uid",$uid);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

function TerritoriesNotRestored(){
        $connect=connectdb();
        try {
            $sql="
            SELECT 
            a.name as playername,
            t.owner_uid,t.id,
            t.name,
            DATE_FORMAT(t.created_at,'%b %d, %Y - %h:%i %p') as created_at,
            DATE_FORMAT(t.last_paid_at,'%b %d, %Y - %h:%i %p') as last_paid_at,
            DATE_FORMAT(t.deleted_at,'%b %d, %Y - %h:%i %p') as deleted_at
            from territory t inner join account a ON t.owner_uid = a.uid
            where deleted_at is not null and flag_stolen !=1 order by deleted_at DESC
            ";
            $stmt=$connect->prepare($sql);
            $stmt->execute();
            $tnr = $stmt->fetchAll();
            return $tnr;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function TerritoriesStolen(){
        $connect=connectdb();
        try {
            $sql="
            SELECT a.name as owner,b.uid as stealer_id, b.name as stealer, t.owner_uid,t.id, t.name, t.flag_stolen,t.flag_stolen_by_uid,
            DATE_FORMAT(t.flag_stolen_at, '%b %d, %Y - %h:%i %p') as flag_stolen_at,
            DATE_FORMAT(t.deleted_at,'%b %d, %Y - %h:%i %p') as deleted_at
            from territory t 
            inner join account a ON t.owner_uid = a.uid
            inner join account b on t.flag_stolen_by_uid = b.uid
            where flag_stolen = 1 order by name ASC
            ";
            $stmt=$connect->prepare($sql);
            $stmt->execute();
            $tnr = $stmt->fetchAll();
            return $tnr;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function RestoreTerritory($tid){
        $connect=connectdb();
        try {
            $sql="UPDATE territory SET deleted_at = NULL, last_paid_at = NOW(), flag_stolen = 0, flag_stolen_by_uid = NULL, flag_stolen_at = NULL  WHERE id=:tid";
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":tid",$tid);
            $stmt->execute();
            $Update01 = $stmt->rowCount();
            $sql="UPDATE container SET deleted_at = NULL, last_updated_at = NOW() WHERE territory_id=:tid";
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":tid",$tid);
            $stmt->execute();
            $Update02 = $stmt->rowCount();
            $sql="UPDATE construction SET deleted_at = NULL, last_updated_at = NOW(),damage = 0  WHERE territory_id=:tid";
            $stmt=$connect->prepare($sql);
            $stmt->bindValue(":tid",$tid);
            $stmt->execute();
            $Update03 = $stmt->rowCount();
            $RowsResult=[];
            $RowsResult['U1']=$Update01;
            $RowsResult['U2']=$Update02;
            $RowsResult['U3']=$Update03;
        return $RowsResult;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

?>
