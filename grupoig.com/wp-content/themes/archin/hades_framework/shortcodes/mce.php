<?php

$path = __FILE__;
$pathwp = explode( 'wp-content', $path );
$wp_url = $pathwp[0];

require_once( $wp_url.'/wp-load.php' );

?>
<script type="text/javascript">
jQuery(function($){
	var tlightbox = jQuery("#TB_ajaxContent");
	$('#colorSelector').ColorPicker({
	color: '#0000ff',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		
		$('#colorSelector div').css('backgroundColor', '#' + hex);
		tlightbox.find('.preview-panel a').css('color', '#' + hex);
	  }
    });

    $('#bgcolorSelector').ColorPicker({
	color: '#0000ff',
	onShow: function (colpkr) {
		$(colpkr).fadeIn(500);
		return false;
	},
	onHide: function (colpkr) {
		$(colpkr).fadeOut(500);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#bgcolorSelector div').css('backgroundColor', '#' + hex);
		tlightbox.find('.preview-panel a').css({
			'backgroundColor': '#' + hex,
			'border': '#' + hex+" 1px solid" }
			);
	}
    });
	
	   tlightbox.find(".shortcode_border_radius").live('focusout',function(){
	
		  tlightbox.find('.preview-panel a').css({
		 "border-radius": $(this).val()+"px",
		 "-moz-border-radius": $(this).val()+"px",
		 "-webkit-border-radius": $(this).val()+"px"
	  });;
	});
	
	
	 tlightbox.find("#button-styler").live("change",function(){
		
	    tlightbox.find('.preview-panel a').removeClass(); 
    	tlightbox.find('.preview-panel a').addClass($(this).val());
	});


	});

</script>
<div class="shortcode-wrapper">

<?php $type = $_GET["type"];  


if($type=="layout") : ?>

<div class="top-panel clearfix">

<label for="">Select Layout</label><select name="" id="">
  <option value="[full_width] insert your content here.. [/full_width]">Full Width</option>
  <option value="[one_half] insert your content here.. [/one_half] [one_half_last] insert your content here.. [/one_half_last]">2 Columns</option>
  <option value="[one_third] insert your content here.. [/one_third] [one_third] insert your content here.. [/one_third] [one_third_last] insert your content here.. [/one_third_last]">3 Columns</option>
  <option value="[one_fourth] insert your content here.. [/one_fourth] [one_fourth] insert your content here.. [/one_fourth] [one_fourth] insert your content here.. [/one_fourth] [one_fourth_last] insert your content here.. [/one_fourth_last]">4 Columns</option>
  <option value="[one_fifth] insert your content here.. [/one_fifth] [one_fifth] insert your content here.. [/one_fifth] [one_fifth] insert your content here.. [/one_fifth] [one_fifth] insert your content here.. [/one_fifth] [one_fifth_last] insert your content here.. [/one_fifth_last]">5 Columns</option>
  <option value="[one_fourth] insert your content here.. [/one_fourth][three_fourth_last] insert your content here.. [/three_fourth_last]">1/4th Col + 3/4 Col</option>
  <option value="[three_fourth] insert your content here.. [/three_fourth][one_fourth_last] insert your content here.. [/one_fourth_last]">3/4th Col + 1/4 Col</option>
  <option value="[one_third] insert your content here.. [/one_third] [two_third_last] insert your content here.. [/two_third_last] ">1/3th Col + 2/3 Col</option>
  <option value=" [two_third] insert your content here.. [/two_third] [one_third_last] insert your content here.. [/one_third_last]">2/3th Col + 1/3 Col</option>
  <option value="[one_fifth] insert your content here.. [/one_fifth] [four_fifth_last] insert your content here.. [/four_fifth_last]">1/5th Col + 4/5 Col</option>
  <option value="[four_fifth] insert your content here.. [/four_fifth] [one_fifth_last] insert your content here.. [/one_fifth_last] ">4/5th Col + 1/5 Col</option>
  
  </select>
  <a href="#" class="import_shortcode add-button"> Add Shortcode </a>
  <a href="#" class="done_shortcode done-button"> Done </a>
</div>

<?php elseif($type=="button") : ?>
 
 <div class="top-panel clearfix">
 <a href="#" class="done_shortcode done-button"> Done </a>
 
   <p class="preview-panel clearfix"> <span>Preview</span> 
            <a href="#" class="glass" style="text-decoration:none; display:inline-block; padding:6px 12px; margin:5px"> Button </a>
   </p>
            
 </div>
 
 
 
 <div class="hades_input clearfix">
 <label for="">Enter Button Title</label>
 <input type="text" value="" class="button_title" id="button_title" />
 </div>
 
  <div class="hades_input clearfix">
   <label for="text">Set Text color</label> <div id="colorSelector" style="float:left;"><div style="background-color: #e1e6ee"></div></div>   
 </div>
 
 <div class="hades_input clearfix">
 <label for="text">Set Background color</label>  <div id="bgcolorSelector" style="float:left;"><div style="background-color: #282d35"></div></div>  
 </div>
 
 <div class="hades_input clearfix">
 <label for="">Style</label>
       <select name="" id="button-styler" style="display:block">
         <option value="glass">Glass</option>
         <option value="shade">Shade</option>
         <option value="none">None</option>
       </select>
 </div>
    
 <div class="hades_input clearfix" >        
 <label for="shortcode_border_radius">Border Radius(in numbers)</label>
 <input type="text" name="" id="shortcode_border_radius" class="shortcode_border_radius" value="3" />
 </div> 
 
  <div class="hades_input clearfix">        
 <label for="shortcode_link">Add your URL in here</label>
 <input type="text" name="" id="shortcode_link" class="shortcode_link" value="http://" />
 </div>            
 
</div>

<input type="hidden" class="shortcode_value" value="image" />
<?php elseif($type=="list"): ?>
 <div class="top-panel clearfix">
  <a href="#" class="done_shortcode done-button"> Done </a>
  
 <select id="shortcode-list-preview">
   <option value='arrow'>arrow</option>
   <option value='clip'>clip</option>
   <option value='cross'>cross</option>
   <option value='folder'>folder</option>
   <option value='info'>info</option> 
   <option value='music'>music</option> 
   <option value='picture'>picture</option> 
   <option value='note'>note</option> 
   <option value='tick'>tick</option>  
   <option value='rounded-tick'>rounded-tick</option> 
   </select> 
  
 </div>
 
 <div id="list-preview" class="arrow styled">
 <h4> List Preview </h4>
 <ul >
   <li>List Item 1</li>
   <li>List Item 2</li>
   <li>List Item 3</li>
   <li>List Item 4</li>
   <li>List Item 5</li>
 </ul>
 </div>

<input type="hidden" class="shortcode_value" value="list" />

<?php elseif($type=="contact"):

 ?>
 
 <div class="top-panel">
 <select id="shortcode-contact-preview">
   <?php 
   
     $forms = get_option("archin_forms");
	  if(!$forms)
	  $forms = array();
   
	               foreach( $forms as $form)
				   {
					  
					   echo "<option value='{$form[key]}'>{$form[key]}</option>";
				   }
	         
   ?>
   </select>  <a href="#" class="done_shortcode button"> Done </a>
  <input type="hidden" class="shortcode_value" value="contact" />
 </div>
 

 

<?php endif; ?>



</div>