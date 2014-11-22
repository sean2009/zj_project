<?php

function dateadd ($interval, $number, $date) 
{ 
   $date_time_array = getdate($date); 
   $hours = $date_time_array["hours"]; 
   $minutes = $date_time_array["minutes"]; 
   $seconds = $date_time_array["seconds"]; 
   $month = $date_time_array["mon"]; 
   $day = $date_time_array["mday"]; 
   $year = $date_time_array["year"]; 
   switch ($interval) { 
   case "yyyy": $year +=$number; break; 
   case "q": $month +=($number*3); break; 
   case "m": $month +=$number; break; 
   case "y": 
   case "d": 
   case "w": $day+=$number; break; 
   case "ww": $day+=($number*7); break; 
   case "h": $hours+=$number; break; 
   case "n": $minutes+=$number; break; 
   case "s": $seconds+=$number; break; 
   } 
   $timestamp = mktime($hours, $minutes, $seconds, $month, $day, $year); 
   return $timestamp;
}
?>