// JavaScript Document
<?php

$path = __FILE__;
$pathwp = explode( 'wp-content', $path );
$wp_url = $pathwp[0];
require_once( $wp_url.'/wp-load.php' ); ?>


var loc = "<?php echo HURL; ?>";

var img_loc = loc+"/shortcodes/js/icons/image.png";
loc = loc + "/shortcodes/mce.php";


// Creates a new plugin class
tinymce.create('tinymce.plugins.button', {
    createControl: function(n, cm) 
                {
                    switch (n) {
            case 'button':
                var c = cm.createMenuButton('Shortcodes', {
   title : 'WPTitans Shortcode Editor',
    image : img_loc
});

c.onRenderMenu.add(function(c, m) {
    m.add({title : 'Shortcodes', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
    
	 m.add({title : 'Layouts'
	 ,onclick:function(){
		  
		   tb_show('Insert Shortcode',"#TB_inline"); 
		 jQuery("#TB_ajaxContent").load(loc+"?type=layout");
					jQuery("#TB_ajaxContent").css({ 
					  
					  width: jQuery("#TB_ajaxContent").parent().width()-30,
					  height: jQuery("#TB_ajaxContent").parent().height()-40
					 });
		 }
	 });
	
	
					
					 
	var sub1 = m.addMenu({title : 'Blog', onclick : function() {   }});
	sub1.add({title : 'Recent Posts', onclick : function() { tinyMCE.activeEditor.selection.setContent("[recentposts count='3' excerpt=true excerpt_length='100' /]");  }});
	sub1.add({title : 'Popular Posts', onclick : function() { tinyMCE.activeEditor.selection.setContent("[popularposts count='3' excerpt=true excerpt_length='100' /]");  }});
	sub1.add({title : 'Related Posts', onclick : function() { tinyMCE.activeEditor.selection.setContent("[relatedposts count='3'  /]");  }});
	sub1.add({title : 'Posts', onclick : function() {  tinyMCE.activeEditor.selection.setContent("[posts count='3' excerpt=true excerpt_length='100' author_name='' category_name='' tag='' /]");  }});
	
	var sub2 = m.addMenu({title : 'Media', onclick : function() {   }});
	sub2.add({title : 'Youtube', onclick : function() { tinyMCE.activeEditor.selection.setContent("[youtube id='j0lSpNtjPM8' width='300' height='250' /]   ");  }});
	sub2.add({title : 'Vimeo', onclick : function() { tinyMCE.activeEditor.selection.setContent("[vimeo id='23281150' width='300' height='250' /]   ");  }});
	sub2.add({title : 'Imagewrapper', onclick : function() { tinyMCE.activeEditor.selection.setContent("[imagewrapper src='' caption='' class='' width='' height='' /]   ");  }});
	
	
	var sub3 = m.addMenu({title : 'Typography', onclick : function() {   }});
	sub3.add({title : 'Format', onclick : function() { tinyMCE.activeEditor.selection.setContent('[format]'+tinyMCE.activeEditor.selection.getContent()+"[/format]");  }});
	sub3.add({title : 'Pre', onclick : function() { tinyMCE.activeEditor.selection.setContent('[pre]'+tinyMCE.activeEditor.selection.getContent()+"[/pre]");  }});
	sub3.add({title : 'Quotes', onclick : function() { tinyMCE.activeEditor.selection.setContent('[quotes]'+tinyMCE.activeEditor.selection.getContent()+"[/quotes]");  }});
	sub3.add({title : 'Quotes Left', onclick : function() { tinyMCE.activeEditor.selection.setContent('[quotes_left]'+tinyMCE.activeEditor.selection.getContent()+"[/quotes_left]");  }});
	sub3.add({title : 'Quotes Right', onclick : function() { tinyMCE.activeEditor.selection.setContent('[quotes_right]'+tinyMCE.activeEditor.selection.getContent()+"[/quotes_right]");  }});
	sub3.add({title : 'Custom font', onclick : function() { tinyMCE.activeEditor.selection.setContent('[customfont]'+tinyMCE.activeEditor.selection.getContent()+"[/customfont]");  }});

	
	
	var sub4 = m.addMenu({title : 'UI', onclick : function() {   }});
		sub4.add({title : 'Error Box', onclick : function() {  tinyMCE.activeEditor.selection.setContent('[box title="your title" type="error" width="600px" ]'+tinyMCE.activeEditor.selection.getContent()+"[/box]");  }});
		sub4.add({title : 'Warning Box', onclick : function() {  tinyMCE.activeEditor.selection.setContent('[box title="your title" type="warning" width="600px" ]'+tinyMCE.activeEditor.selection.getContent()+"[/box]");  }});
		sub4.add({title : 'Success Box', onclick : function() {  tinyMCE.activeEditor.selection.setContent('[box title="your title" type="success" width="600px" ]'+tinyMCE.activeEditor.selection.getContent()+"[/box]");  }});
		sub4.add({title : 'Information Box', onclick : function() {  tinyMCE.activeEditor.selection.setContent('[box title="your title" type="information" width="600px" ]'+tinyMCE.activeEditor.selection.getContent()+"[/box]");  }});
		sub4.add({title : 'Action Box', onclick : function() {  tinyMCE.activeEditor.selection.setContent('[action buttonTitle="ACTION BUTTON" link="" ] ' +tinyMCE.activeEditor.selection.getContent()+' [/action]');  }});
		
		sub4.add({title : 'Button', onclick : function() {    tb_show('Insert Shortcode',"#TB_inline"); 
		 jQuery("#TB_ajaxContent").load(loc+"?type=button");
					jQuery("#TB_ajaxContent").css({ 
					  
					  width: jQuery("#TB_ajaxContent").parent().width()-30,
					  height: jQuery("#TB_ajaxContent").parent().height()-40
					 });  }});
	
		sub4.add({title : 'Separator', onclick : function() { tinyMCE.activeEditor.selection.setContent("[separator /]");  }});
	    sub4.add({title : 'List', onclick : function() {
			
			 tb_show('Insert Shortcode',"#TB_inline"); 
		 jQuery("#TB_ajaxContent").load(loc+"?type=list");
					jQuery("#TB_ajaxContent").css({ 
					  
					  width: jQuery("#TB_ajaxContent").parent().width()-30,
					  height: jQuery("#TB_ajaxContent").parent().height()-40
					});
			
			  }});
		sub4.add({title : 'Stylish Table', onclick : function() { tinyMCE.activeEditor.selection.setContent('[styledTable] ' +tinyMCE.activeEditor.selection.getContent()+' [/styledTable]');   }});
		
	var sub5 = m.addMenu({title : 'Widgets', onclick : function() {   }});
   sub5.add({title : 'Tabs', onclick : function() { tinyMCE.activeEditor.selection.setContent('[tabs][tab title="your tab1 title"] your content here... [/tab][/tabs]');   }});
    sub5.add({title : 'Accordion', onclick : function() { tinyMCE.activeEditor.selection.setContent('[accordion][section  title="your tab1 title"] your content here...  [/section][/accordion]');   }});
	 sub5.add({title : 'Toggle Box', onclick : function() { tinyMCE.activeEditor.selection.setContent('[toggle title="your tab1 title"] your content here...  [/toggle ]');   }});
   sub5.add({title : 'Pie Chart', onclick : function() { tinyMCE.activeEditor.selection.setContent("[pie width='250' height='100' values='50,20,30' labels='label 1,label 2,label 3' /]");  }});
     sub5.add({title : 'Line Chart', onclick : function() { tinyMCE.activeEditor.selection.setContent("[pie width='250' height='100' values='50,20,30' labels='label 1,label 2,label 3' /]");  }});
	   sub5.add({title : 'Bar Graph', onclick : function() { tinyMCE.activeEditor.selection.setContent("[pie width='250' height='100' values='50,20,30' labels='label 1,label 2,label 3' /]");  }});
	
	 
	m.add({title : 'Contact Forms', onclick : function() { 
	 
	  tb_show('Insert Shortcode',"#TB_inline"); 
		 jQuery("#TB_ajaxContent").load(loc+"?type=contact");
					jQuery("#TB_ajaxContent").css({ 
					  
					  width: jQuery("#TB_ajaxContent").parent().width()-30,
					  height: jQuery("#TB_ajaxContent").parent().height()-40
					});
					
	  }});
 
});
                // Return the new splitbutton instance
                return c;
        }

            
                    return null;
                }
});

// Register plugin
tinymce.PluginManager.add('button', tinymce.plugins.button);