<?php
/*
Template Name: Event Page Template
*/
?>

<?php
 get_header(); 
$label = get_option("arc_blurb_label");
if(isset($_GET["y"]))
$year =$_GET["y"];
else
$year = date('Y');

$day = date('j');

if(isset($_GET["nav"]))
{
	if($_GET["nav"]=="next")
	{
		$m = $_GET["month"];
		if($m==12)
		{
			$m =0;
		   $year = $year +1;
		}
		$month = $m+1;
	}
	else
	{
		$m = $_GET["month"];
		if($m==0)
		$m =12;
		if($m==1)
		 $year = $year -1;
		
		$month = $m-1;
	}
}
else
$month = date('n');
$link = get_permalink();

$check =  substr($link, -1);
//if($check=="/")
$link = $link."?";


?>
<div class="blurb-wrapper">

            <div class="blurb clearfix">
          <p class="custom-font"><?php echo get_option("arc_blurb_text"); ?></p>
          <?php if($label) : ?> <a href="<?php echo get_option("arc_blurb_link"); ?>"> <?php echo $label; ?></a> <?php endif; ?>
          </div>

</div>
 <div class="page-body-wrapper"></div>    
 
<div class="container clearfix page">

       
   	<div class="<?php if($sidebar=="true") echo 'two-third-width'; else echo 'full-width';  ?>">
        <div class="clearfix content-wrapper">
         	
            
            <div class="title">
             <h4 class="custom-font heading"><?php the_title(); ?></h4>
            </div>
            	
            
            <div class="page-content">
			  
              <div class="breadcrumb clearfix"><?php $helper->the_breadcrumb();?></div>
			  <div class="">
			  
              
              
               <!-- ========================================== Calendar Mode ========================================== -->
  
  <div id="calendar-view">
   <?php if(!isset($_GET["choice"])||$_GET["choice"]=="calendar") : ?>
   
   <div class="topbar clearfix">
   
      <div id="switch">
          <a href="<?php echo $link."&choice=calendar"; ?>" class="lactive lr">Calendar</a>
          <a href="<?php echo $link; ?>&choice=list" class="rr">List</a> 
      </div>

      <div id="title" class="custom-font">
         
		<span> The events calendar   -   </span><h6><?php echo date("F",mktime(0,0,0,$month,1,$year))." $year";  ?></h6> 
         
      </div>
      
      
       <a <?php echo "href=\"{$link}&amp;nav=next&amp;month=$month&amp;y=$year\""; ?> class='event-next'> Next </a> 
        <a <?php echo "href=\"{$link}&amp;nav=prev&amp;month=$month&amp;y=$year\""; ?> class='event-prev' > Previous </a>  
 
   </div>
 
   <div id="calendar">
<table>
<thead>
<tr><th>Sun</th><th>Mon</th><th>Tues</th><th>Wed</th><th>Thurs</th><th>Fri</th><th>Sat</th></tr>
</thead>
<tbody>
<?php 
 
	
		

$first_Day = date("w", mktime(0,0,0,$month,1,$year));
$totaldays = date("t",mktime(0,0,0,$month,1,$year));
$temp = $first_Day + $totaldays;
$weeksInMonth = ceil($temp/7);
$counter = 1;
$flag = true;
if($month!=date("n"))
$flag=false;

$week_counter = 0;
$week_date = array();

$rs = array();
 query_posts("post_type=event&nopaging=true");

 while(have_posts()) : the_post();  
    
	$custom = get_post_custom($post->ID);
	 $data = $custom["event_data"][0];
   $row = unserialize($data);
   $row["title"] = $helper->getShortenContent(18,get_the_title());
    $row["description"] =  $helper->getShortenContent(100,get_the_content());
	$row["permalink"] = get_permalink(); 
		$rs[] = $row;
		
	$week_date[$row["starting_date"]] = 0;
	
endwhile;


for($i=0;$i<$weeksInMonth;$i++)
{
	
	echo "<tr>";
	for($j=0;$j<7;$j++)
	{
		$event_div =  '';
		$show_a = '';
		if(( $counter<=$temp) && ( ($counter + $totaldays) - $temp >0) )
	    {
			
			echo "<td>";
			if(( $counter - $first_Day ) == date("j") &&$t[1]==$month )
			   echo "<div  class='current-bg'><span> ".( $counter - $first_Day )."</span> \n ";
			else
			   echo"<div  class='hasdate'><span> ".( $counter - $first_Day )."</span> \n ";
		 	
			$count_flag = 0;
			foreach($rs as $row)
			{
				$t = explode("-",$row["starting_date"]);
				
				if($t[0]==( $counter - $first_Day )&&$t[1]==$month&&$t[2]==$year)
				{
				
					$count_flag++;
					
					
				echo "<a href='{$row[permalink]}'> $row[title] </a> ";	
				 	
					
					
					
				}
				
			}
		
		 
		 
			
		 echo "</div>";
			
			
			
			
		}
	   else
		 echo "<td class='no-date'><div><span></span></div>";
		
 echo "</td> \n ";
 // echo $event_div;
		 $counter++;
	}
	echo "</tr> \n ";
	
	
}



?>


</tbody>
</table>
</div>
  <div class="topbar tlast clearfix">
   
      <div id="switch">
          <a href="<?php echo $link."&choice=calendar"; ?>" class="lactive lr">Calendar</a>
          <a href="<?php echo $link; ?>&choice=list" class="rr">List</a> 
      </div>

      <div id="title" class="custom-font">
         
		  <h6><?php echo date("F",mktime(0,0,0,$month,1,$year))." $year";  ?></h6> 
         
      </div>
      
      
         <a <?php echo "href=\"{$link}&amp;nav=next&amp;month=$month&amp;y=$year\""; ?> class='event-next'> Next </a> 
        <a <?php echo "href=\"{$link}&amp;nav=prev&amp;month=$month&amp;y=$year\""; ?> class='event-prev' > Previous </a>
 
   </div> 
   </div>
   
    <!-- ========================================== End of Calendar Mode ========================================== -->
    <?php else : ?>
	
    <div class="topbar clearfix">
      <div id="switch">
          <a href="<?php echo $link."&amp;choice=calendar"; ?>" class="lr">Calendar</a>
          <a href="<?php echo $link; ?>&choice=list" class="ractive rr">List</a> 
      </div>
    </div>  

	
	
    <div class="events-list">
	<?php $helper->showEventPosts(array( 'post_type' => 'event' , "custom_font" => true , "extras" => false ));  ?>
	</div>
      <div class="topbar tlast clearfix">
   
      <div id="switch">
          <a href="<?php echo $link."&choice=calendar"; ?>" class=" lr">Calendar</a>
          <a href="<?php echo $link; ?>&choice=list" class="ractive rr">List</a> 
      </div>

      <div id="title" class="custom-font">
         
		  <h6><?php echo date("F",mktime(0,0,0,$month,1,$year))." $year";  ?></h6> 
         
      </div>
      
      
   </div>  
   
    <!-- Pagination -->
   <p class='pagination'>
     <?php previous_posts_link("&laquo;"); ?>
   </p>
   <?php kriesi_pagination(); ?>
   <p class='pagination'>
     <?php next_posts_link("&raquo;"); ?> </p> 
     
   </div>
	<?php endif; ?>
  
     
              
			  
            
              </div>
            
            </div>
            
		
                  
                
                  
          </div>
    </div><!-- End of two third column -->
    
	<?php  
	 wp_reset_query();
	if($sidebar=="true") 
	        get_sidebar();  ?>
</div>
<?php get_footer(); ?>
      