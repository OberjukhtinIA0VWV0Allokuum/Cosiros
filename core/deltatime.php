<?
session_start();
  $hours=$_REQUEST['h'];;
  $minutes=$_REQUEST['m'];
  $date_time_array = getdate( time() );
  $server_hours=date("H");
  $server_minutes=date("i");
  $deltaH=$hours-$server_hours;
  $deltaM=$minutes-$server_minutes;
  $_SESSION['Delta_Time_h'] = $deltaH;
  $_SESSION['Delta_Time_m'] = $deltaM;
  $_SESSION['is_delta_time'] = '1';
  echo $minutes." . ".$server_minutes."<br>";
  echo $hours." . ".$server_hours."<br>";
  echo $deltaH.":".$deltaM;
  echo "<script> location.reload(); </script>";
?>