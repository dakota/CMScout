<?php
 class dateHelper extends AppHelper 
 {
 	function prettyDate($string, $seperator = ', ', $showtime = true)
 	{
	   if( $string != '' && $string != '0000-00-00' )
	    $date = strtotime( $string );
	  elseif( isset($default_date) && $default_date != '' )
	    $date = strtotime( $default_date );
	  else
	    return;
	
	  if ($showtime)
	  {
	      if( $date > strtotime('today 00:00:00') )
	        $d = "Today$seperator" . strftime( '%H:%M', $date );
	      elseif( $date > strtotime('yesterday 00:00:00') )
	        $d = "Yesterday$seperator".strftime( '%H:%M', $date );
	      elseif( $date > strtotime('-2 days 00:00:00'))   // only for de_* locales
	        $d = "2 Days Ago$seperator".strftime( '%H:%M', $date );
	      elseif( $date > strtotime('-1 week 00:00:00') )
	        $d = strftime( '%A'.$seperator.'%H:%M', $date );
	      elseif( $date > strtotime('-1 year 00:00:00') )
	        $d = strftime( '%d %B.'.$seperator.'%H:%M', $date );
	      else
	        $d = strftime( '%d %B %Y'.$seperator.'%H:%M', $date );
	  }
	  else
	  {
	        if( $date > strtotime('today 00:00:00') )
	        $d = "Today";
	      elseif( $date > strtotime('yesterday 00:00:00') )
	        $d = "Yesterday";
	      elseif( $date > strtotime('-2 days 00:00:00'))   // only for de_* locales
	        $d = "2 Days Ago, ".strftime( '%H:%M', $date );
	      elseif( $date > strtotime('-1 week 00:00:00') )
	        $d = strftime( '%A', $date );
	      elseif( $date > strtotime('-1 year 00:00:00') )
	        $d = strftime( '%d %B', $date );
	      else
	        $d = strftime( '%d %B %Y', $date );
	  }
	  
	  if( isset($lang) )
	    setlocale( LC_TIME, $save_lang );
	
	  return $d;		
 	}
 }
?>