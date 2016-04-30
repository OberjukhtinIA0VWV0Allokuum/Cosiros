<?
session_start();
  $hours=$_REQUEST['h'];;
  $minutes=$_REQUEST['m'];
  $date_time_array = getdate( time() );
  $server_hours=date("H");
  $server_minutes=date("i");
  $deltaH=$hours-$server_hours;
  if($deltaH>0){$deltaH="+".$deltaH;}
  if($deltaM>0){$deltaM="+".$deltaM;}
  $deltaM=$minutes-$server_minutes;
  $_SESSION['Delta_Time_h'] = $deltaH;
  $_SESSION['Delta_Time_m'] = $deltaM;
  $_SESSION['is_delta_time'] = '1';
  echo "<script> location.reload(); </script>";
?>