/**
 * Woocommerce Category Accordion Functions
 *
 * @author 		TechieResource
 * @category 	Mcebutton js
 * @version 	2.0
 */
(function() {
	
	tinymce.PluginManager.add('WC_Category_Accordion', function( editor, url ) {
		var sh_tag = 'WC-Category-Accordion';
		//helper functions 
		function getAttr(s, n) {
			n = new RegExp(n + '=\"([^\"]+)\"', 'g').exec(s);
			return n ?  window.decodeURIComponent(n[1]) : '';
		};

		function html( cls, data ,con) {
			var placeholder = url + '/img/' + getAttr(data,'ac_theme') + '.png';
			data = window.encodeURIComponent( data );
			content = window.encodeURIComponent( con );

			return '<img src="' + placeholder + '" class="mceItem ' + cls + '" ' + 'data-sh-attr="' + data + '" data-mce-resize="false" data-mce-placeholder="1" />';
		}

		function replaceShortcodes( content ) {
			return content.replace( /\[WC-Category-Accordion([^\]]*)\]([^\]]*)\[\/WC-Category-Accordion\]/g, function( all,attr,con) {
				return html( 'wp-WC_Category_Accordion', attr , con);
			});
		}

		function restoreShortcodes( content ) {
			return content.replace( /(?:<p(?: [^>]+)?>)*(<img [^>]+>)(?:<\/p>)*/g, function( match, image ) {
				var data = getAttr( image, 'data-sh-attr' );
				var con = getAttr( image, 'data-sh-content' );

				if ( data ) {
					return '<p>[' + sh_tag + data + ']' + con + '[/'+sh_tag+']</p>';
				}
				return match;
			});
		}
		
		//add popup
		
		editor.addCommand('WC_Category_Accordion_popup', function(ui, v) {
			//setup defaults
			var show_count;
			if (v.show_count)
				show_count = v.show_count;
								
			var hide_empty;
			if (v.hide_empty)
				hide_empty = v.hide_empty;
				
			var enb_rtl;
			if (v.enb_rtl)
				enb_rtl = v.enb_rtl;
				
			var show_subcats;
			if (v.show_subcats)
				show_subcats = v.show_subcats;
				
			var open_cat;
			if (v.open_cat)
				open_cat = v.open_cat;

			var disable_parent;
			if (v.disable_parent)
				disable_parent = v.disable_parent;
			
			var disable_aclink;
			if (v.disable_aclink)
				disable_aclink = v.disable_aclink;
		
			var sortby = 'name';	
			if (v.sortby)
				sortby = v.sortby;
				
			var order = 'ASC';	
			if (v.order)
				order = v.order;
					
			var ac_theme = 'default';
			if (v.ac_theme)
				ac_theme = v.ac_theme;
			
			var level = 0
			if (v.level)
				level = parseInt(v.level);
				
				
			var event_type = 'click';
			if (v.event_type)
				event_type = v.event_type;				
				
			var ac_type = 'toggle';
			if (v.ac_type)
				ac_type = v.ac_type;
			
			var ac_icon = 'angle';
			if (v.ac_icon)
				ac_icon = v.ac_icon;
				
			var ac_opencat = '';
			if (v.ac_opencat)
				ac_opencat = v.ac_opencat;
			
			var exclude_tree = '';
			if (v.exclude_tree)
				exclude_tree = v.exclude_tree;
				
			var ac_speed = 'fast';	
			if (v.ac_speed)
				ac_speed = v.ac_speed;				
		
			editor.windowManager.open( {
				title: 'WooCommerce Category Accordion Shortcode',
				 autoScroll: true,
   				 width: 600,
    			 height: 500,
   				 classes: 'trwca-panel',
				
				body: [
					{
						type: 'checkbox',
						name: 'enb_rtl',
						label: 'Enable RTL',
						value: enb_rtl,
						checked: enb_rtl,
						classes: 'enb_rtl'	
            	    },
					{
						type: 'listbox',
						name: 'event_type',
						label: 'Accordion Event Type',
						value: event_type,
						'values': [
							{text: 'Click',  value:'click'},
							{text: 'Hover', value: 'hover'}				
					
						],
						tooltip: 'Choose Event Type'
					},
					{
						type: 'listbox',
						name: 'ac_type',
						label: 'Accordion Type (Toggle / collapsed )',
						value: ac_type,
						'values': [
							{text: 'Toggle',  value:'toggle'},
							{text: 'Collapsed', value: 'collapsed'}				
					
						],
						tooltip: 'Choose Accordion Type'
					},
					{
						type: 'listbox',
						name: 'ac_theme',
						label: 'Accordion Theme',
						value: ac_theme,
						'values': [
							{text: 'Classic', value: 'acclassic'},
							{text: 'Light', value: 'aclight'},
							{text: 'Red', value: 'acred'},
							{text: 'Green', value: 'acgreen'},
							{text: 'Turquoise', value: 'acturquoise'},
							{text: 'Blue', value: 'acblue'},
							{text: 'Purple', value: 'acpurple'},
							{text: 'Pink', value: 'acpink'},
							{text: 'Yellow', value: 'acgamboge'},
							{text: 'Brown', value: 'acbrown'},
							{text: 'Dark Blue', value: 'acdblue'},
							{text: 'Orange', value: 'acorange'},
							{text: 'Dark', value: 'acblack'}
						],
						tooltip: 'Select the Accordion Theme'
					},
					{
						type: 'listbox',
						name: 'ac_icon',
						label: 'Accordion Icon',
						value: ac_icon,
						
						'values': [
							{text: 'Angle',  value:'angle'},
							{text: 'Double Angle', value: 'doubleangle'},
							{text: 'Plus',  value:'plus'},
							{text: 'Plus Circle',  value:'plus-circle'},
							{text: 'Plus Square1',  value:'plus-square1'},
							{text: 'Plus Square2',  value:'plus-square2'},
							{text: 'Arrow Circle1',  value:'arrow-circle1'},
							{text: 'Arrow Circle2',  value:'arrow-circle2'},
							{text: 'Arrow Right',  value:'arrow-right'},
							{text: 'Caret',  value:'caret'},
							{text: 'Caret Square',  value:'caret-square'},
							{text: 'Chevron',  value:'chevron'},
							{text: 'Chevron Circle',  value:'chevron-circle'},
							{text: 'Hand',  value:'hand'},
							{text: 'Circle',  value:'circle'},
							{text: 'Heart',  value:'heart'},
							{text: 'Level up',  value:'levelup'},
							{text: 'Square',  value:'square'},
							{text: 'Rotate',  value:'rotate'},
									
					
						],
						tooltip: 'Choose Accordion Icon'
					},

					{
						type: 'listbox',
						name: 'sortby',
						label: 'Sort by',
						value: sortby,
						//minWidth: 250,
						'values': [
							{text: 'Name', value: 'name'},
							{text: 'Slug', value: 'slug'},
							{text: 'Id', value: 'id'},
						
						],
						tooltip: 'Choose Accordion sorting'
					},
					
					{
						type: 'checkbox',
						name: 'show_count',
						label: 'Enable Products Count',
						value: show_count,
						checked: show_count,
						classes: 'show_count'	
            	    },	
					{
						type: 'checkbox',
						name: 'hide_empty',
						label: 'Hide If Empty',
						value: hide_empty,
						checked: hide_empty,
						classes: 'hide_empty'	
            	    },
					{
						type: 'listbox',
						name: 'order',
						label: 'Order by',
						value: order,
						'values': [
							{text: 'Ascending', value: 'ASC'},
							{text: 'Descending', value: 'DESC'},
					
						],
						tooltip: 'Choose Accordion Order'
					},
					{
						type: 'listbox',
						name: 'level',
						label: 'Accordion Hierarchy Level',
						value: level,
						'values': [
							{text: 'All',  value: 0},
							{text: '1', value: 1},
							{text: '2', value: 2},
							{text: '3', value: 3},
							{text: '4', value: 4},
							{text: '5', value: 5},
							{text: '6', value: 6},
							{text: '7', value: 7},
							{text: '8', value: 8},
							{text: '9', value: 9},
							{text: '10', value: 10},
					
						],
						tooltip: 'Choose Accordion Order'
					},							 		
					
					{
						type: 'checkbox',
						name: 'open_cat',
						label: ' Enbale Open / Highlight Category',
						value: open_cat,
						checked: open_cat,
						classes: 'open_cat'	
            	    },
					{
						type: 'checkbox',
						name: 'disable_parent',
						label: 'Disable Top level Parent  Link',
						value: disable_parent,
						checked: disable_parent,
						classes: 'disable_parent'	
            	    },
					{
						type: 'checkbox',
						name: 'show_subcats',
						label: 'Show subcategories only',
						value: show_subcats,
						checked: show_subcats,
						classes: 'show_subcats'	
            	    },					
					{
						type: 'checkbox',
						name: 'disable_aclink',
						label: 'Disable All Parent Link',
						value: disable_aclink,
						checked: disable_aclink,
						classes: 'disable_aclink'	
            	    },
					{
						type: 'textbox',
						name: 'ac_opencat',
						label: 'Default Category to Open',
						value: ac_opencat,
						tooltip: 'Enter Category ID to open by Default (works only if Open / Highlight option enabled) '
					},
					{
						type: 'textbox',
						name: 'exclude_tree',
						label: 'Enter a Category ID to exlude',
						value: exclude_tree,
						tooltip: 'category IDs, separated by commas.'
					},
					{
						type: 'listbox',
						name: 'ac_speed',
						label: 'Accordion Speed',
						value: ac_speed,
						'values': [
							{text: 'Slow', value: 'slow'},
							{text: 'Nomal', value: 'normal'},
							{text: 'Fast', value: 'fast'}
							
					
						],
						tooltip: 'Choose Accordion Speed'
					},				
					
				],
				onsubmit: function( e ) {
					var shortcode_str = '[' + sh_tag + ' ac_theme="'+e.data.ac_theme+'"';
					//check for header
							
					shortcode_str += ' sortby="'+e.data.sortby+'"';				
					
					shortcode_str += ' order="'+e.data.order+'"';
					
					shortcode_str += ' level="'+e.data.level+'"';
					
					shortcode_str += ' event_type="'+e.data.event_type+'"';					
					
					shortcode_str += ' ac_type="'+e.data.ac_type+'"';
					
					shortcode_str += ' ac_icon="'+e.data.ac_icon+'"';
					
					shortcode_str += ' ac_speed="'+e.data.ac_speed+'"';
					
					if (typeof e.data.ac_opencat != 'undefined' && e.data.ac_opencat.length)
						shortcode_str += ' ac_opencat="' + e.data.ac_opencat + '"';
					
					if (typeof e.data.exclude_tree != 'undefined' && e.data.exclude_tree.length)
						shortcode_str += ' exclude_tree="' + e.data.exclude_tree + '"';
						
					if (typeof e.data.show_count != 'undefined' && e.data.show_count==true)
						shortcode_str += ' show_count="' + e.data.show_count + '"';
					
					if (typeof e.data.enb_rtl != 'undefined' && e.data.enb_rtl==true)
						shortcode_str += ' enb_rtl="' + e.data.enb_rtl + '"';
						
					if (typeof e.data.hide_empty != 'undefined' && e.data.hide_empty==true)
						shortcode_str += ' hide_empty="' + e.data.hide_empty + '"';
						
					if (typeof e.data.open_cat != 'undefined' && e.data.open_cat==true)
						shortcode_str += ' open_cat="' + e.data.open_cat + '"';
						
					if (typeof e.data.disable_parent != 'undefined' && e.data.disable_parent==true)
						shortcode_str += ' disable_parent="' + e.data.disable_parent + '"';
						
					if (typeof e.data.show_subcats != 'undefined' && e.data.show_subcats==true)
						shortcode_str += ' show_subcats="' + e.data.show_subcats + '"';						
					
					if (typeof e.data.disable_aclink != 'undefined' && e.data.disable_aclink==true)
						shortcode_str += ' disable_aclink="' + e.data.disable_aclink + '"';						
						
						
						

					//add panel content
					shortcode_str += ']' + e.data.content + '[/' + sh_tag + ']';
					//insert shortcode to tinymce
					editor.insertContent( shortcode_str);
				}
			});
	      	});

		//add button
		editor.addButton('WC_Category_Accordion', {
			image: url + '/img/accordion.png',
			tooltip: 'WC Category Accordion',
			onclick: function() {

			editor.execCommand('WC_Category_Accordion_popup','',{

					ac_theme   : 'default',
					sortby: 'name',
					enb_rtl: '',
					order : 'ASC',
					level : 3,
					event_type : 'click',
					ac_type : 'toggle',
					ac_icon : 'angle',
					open_cat : false,
					show_count : false,
					hide_empty : false,
					disable_parent : true,
					show_subcats  : false,
					disable_aclink : false,
					ac_opencat : '',
					exclude_tree: '',
					ac_speed: 'fast',
				});
			}
		});

		//replace from shortcode to an image placeholder
		editor.on('BeforeSetcontent', function(event){ 
			event.content = replaceShortcodes( event.content );
		});

		//replace from image placeholder to shortcode
		editor.on('GetContent', function(event){
			event.content = restoreShortcodes(event.content);
		});

		//open popup on placeholder double click
		editor.on('DblClick',function(e) {
			
			
			
			var cls  = e.target.className.indexOf('wp-WC_Category_Accordion');
			if ( e.target.nodeName == 'IMG' && e.target.className.indexOf('wp-WC_Category_Accordion') > -1 ) {
				var title = e.target.attributes['data-sh-attr'].value;
				title = window.decodeURIComponent(title);
				
				var show_count=getAttr(title,'show_count')=="true" ? true : false;
				
				var enb_rtl=getAttr(title,'enb_rtl')=="true" ? true : false;
				
				var hide_empty=getAttr(title,'hide_empty')=="true" ? true : false;
				
				var open_cat=getAttr(title,'open_cat')=="true" ? true : false;
				
				var disable_parent=getAttr(title,'disable_parent')=="true" ? true : false;
				
				var show_subcats=getAttr(title,'show_subcats')=="true" ? true : false;
				
				var disable_aclink=getAttr(title,'disable_aclink')=="true" ? true : false;
				
				editor.execCommand('WC_Category_Accordion_popup','',{
			
					ac_theme   : getAttr(title,'ac_theme'),
					sortby  : getAttr(title,'sortby'),
					order : getAttr(title,'order'),
					level : getAttr(title,'level'),
					event_type : getAttr(title,'event_type'),
					ac_type : getAttr(title,'ac_type'),
					ac_icon : getAttr(title,'ac_icon'),	
					content: content,
					show_count: show_count,
					enb_rtl: enb_rtl,
					hide_empty: hide_empty,
					open_cat : open_cat,
					disable_parent : disable_parent,					
					show_subcats : show_subcats,
					disable_aclink : disable_aclink,
					ac_opencat : getAttr(title,'ac_opencat'),
					exclude_tree : getAttr(title,'exclude_tree'),
					ac_speed:  getAttr(title,'ac_speed')
										
				});
				
	
			}
});
	});
})();