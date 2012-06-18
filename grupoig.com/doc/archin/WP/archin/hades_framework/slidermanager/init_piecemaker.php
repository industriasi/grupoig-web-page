

<script type="text/javascript">
    
   var flashvars = {};
   flashvars.cssSource = "<?php echo URL; ?>/stylesheets/piecemaker.css";
   flashvars.xmlSource = "<?php echo URL;?>/hades_framework/helper/piecemaker.php";
		
   var params = {};
   params.play = "true";
   params.menu = "false";
   params.scale = "showall";
   params.wmode = "transparent";
   params.allowfullscreen = "true";
   params.allowscriptaccess = "always";
   params.allownetworking = "all";
   swfobject.embedSWF('<?php echo URL ?>/js/piecemaker.swf', 'piecemaker', '100%', '425', '10', null, flashvars, params, null);
    
    </script>
	
	<div class="slider-wrapper-full">
          <div id="piecemaker">
              <a href="http://www.adobe.com/go/getflashplayer">
                      <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
              </a>
          </div>
	</div>
		
	