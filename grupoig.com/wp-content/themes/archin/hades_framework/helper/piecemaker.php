<?php
$path = __FILE__;
$pathwp = explode( 'wp-content', $path );
$wp_url = $pathwp[0];

require_once( $wp_url.'/wp-load.php' );
$auto = (get_option("arc_auto_feature_slider")=="") ? "true" : get_option("arc_auto_feature_slider");
$slider_duration = (get_option("arc_feature_slider_duration")=="") ? "3000" : get_option("arc_feature_slider_duration");
$theme_path = get_template_directory_uri();
if($auto=="false")
$auto = 0;
else
$auto =  ( (int)$slider_duration )/1000;

$slides = get_option('arc_slides');
		
		if(!is_array($slides))
		$slides = array();
		
		 
$output = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<Piecemaker>

XML;

//Content
	
$output .= '	<Contents>';
	
 foreach($slides as $slide) :
        
        
        
           
             $theImageSrc = $slide["src"];
							global $blog_id;
							if (isset($blog_id) && $blog_id > 0) {
							$imageParts = explode('/files/', $theImageSrc);
							if (isset($imageParts[1])) {
								$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
							}
						}
				  $imgurl = $theme_path."/timthumb.php?src=".urlencode($theImageSrc)."&h=360&w=920";       
				 $output .= '		<Image Source="'.$imgurl.'" Title="'.$slide['title'].'" >';    
                   $output .= '<Text>&lt;h1&gt;'.$slide['title'].'&lt;/h1&gt;&lt;p&gt;'.strip_tags  ( stripslashes($slide['description']) ).'&lt;/p&gt;</Text>';
		
				$output .= '		</Image>'."\n";
		
     endforeach;  
	$output .= '	</Contents>'."\n";
	


//Settings
$output .= '<Settings ImageWidth="920" ImageHeight="360" LoaderColor="0x333333" InnerSideColor="0x222222" SideShadowAlpha="0.8" DropShadowAlpha="0.7" DropShadowDistance="25" DropShadowScale="0.95" DropShadowBlurX="40" DropShadowBlurY="4" MenuDistanceX="20" MenuDistanceY="50" MenuColor1="0x999999" MenuColor2="0x333333" MenuColor3="0xFFFFFF" ControlSize="100" ControlDistance="20" ControlColor1="0x222222" ControlColor2="0xFFFFFF" ControlAlpha="0.8" ControlAlphaOver="0.95" ControlsX="450" ControlsY="280&#xD;&#xA;" ControlsAlign="center" TooltipHeight="30" TooltipColor="0x222222" TooltipTextY="5" TooltipTextStyle="P-Italic" TooltipTextColor="0xFFFFFF" TooltipMarginLeft="5" TooltipMarginRight="7" TooltipTextSharpness="50" TooltipTextThickness="-100" InfoWidth="400" InfoBackground="0xFFFFFF" InfoBackgroundAlpha="0.95" InfoMargin="15" InfoSharpness="0" InfoThickness="0" Autoplay="'.$auto.'" FieldOfView="45"></Settings>';

//End
$output .= <<<XML
	<Transitions>
    <Transition Pieces="9" Time="1.2" Transition="easeInOutBack" Delay="0.1" DepthOffset="300" CubeDistance="30"></Transition>
    <Transition Pieces="15" Time="3" Transition="easeInOutElastic" Delay="0.03" DepthOffset="200" CubeDistance="10"></Transition>
    <Transition Pieces="5" Time="1.3" Transition="easeInOutCubic" Delay="0.1" DepthOffset="500" CubeDistance="50"></Transition>
    <Transition Pieces="9" Time="1.25" Transition="easeInOutBack" Delay="0.1" DepthOffset="900" CubeDistance="5"></Transition>
  </Transitions>
	
</Piecemaker>
XML;

echo $output;

?>