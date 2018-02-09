/**
* jQuery org-chart/tree plugin.
*
* Author: Wes Nolte
* http://twitter.com/wesnolte
*
* Based on the work of Mark Lee
* http://www.capricasoftware.co.uk
*
* ID implementation fixed by Adrian Hinz
* 
* This software is licensed under the Creative Commons Attribution-ShareAlike
* 3.0 License.
*
* See here for license terms:
* http://creativecommons.org/licenses/by-sa/3.0
*/
(function($) {

	$.fn.jOrgChart = function(options) {
		var opts = $.extend({}, $.fn.jOrgChart.defaults, options);
		var $appendTo = $(opts.chartElement);

		// build the tree
		$this = $(this);
		var $container = $("<div class='" + opts.chartClass + "'/>");
		if($this.is("ul")) {
			buildNode($this.find("li:first"), $container, 0, opts);
		}
		else if($this.is("li")) {
			buildNode($this, $container, 0, opts);
		}
		$appendTo.append($container);

		// add drag and drop if enabled
		if(opts.dragAndDrop){
			$('div.node').draggable({
				cursor : 'move',
				distance : 40,
				helper : 'clone',
				opacity : 0.8,
				revert : true,
				revertDuration : 100,
				snap : 'div.node.expanded',
				snapMode : 'inner',
				stack : 'div.node'
			});

			$('div.node.s, div.node.a, div.node.b, div.node.o, div.node.d, div.node.e, div.node.f').droppable({
			//$('div.node').droppable({
				accept : '.node',
				activeClass : 'drag-active',
				hoverClass : 'drop-hover'
			});

			// Drag start event handler for nodes
			$('div.node').bind("dragstart", function handleDragStart( event, ui ){
				var sourceNode = $(this);
				sourceNode.parentsUntil('.node-container')
				.find('*')
				.filter('.node:data(ui-draggable)')
				.droppable('disable');
			});

			// Drag stop event handler for nodes
			$('div.node').bind("dragstop", function handleDragStop( event, ui ){
				/* reload the plugin */
				$(opts.chartElement).children().remove();
				$this.jOrgChart(opts);
			});

			// Drop event handler for nodes
			$('div.node').bind("drop", function handleDropEvent( event, ui ) {
				var sourceNode = ui.draggable;
				var targetNode = $(this);

				// finding nodes based on plaintext and html
				// content is hard!
				var targetLi = $('li').filter(function(){
					li = $(this).clone()
					.children("ul,li")
					.remove()
					.end();
					var attr = li.attr('id');
					if (typeof attr !== 'undefined' && attr !== false) {
						var attr2 = 'cellule_' + li.attr('id');
						return attr2 == targetNode.attr("id");
					} else {
						return li.html() == targetNode.html();
					}
				});

				var sourceLi = $('li').filter(function(){
					li = $(this).clone()
					.children("ul,li")
					.remove()
					.end();
					var attr = li.attr('id');
					if (typeof attr !== 'undefined' && attr !== false) {
						var attr2 = 'cellule_' + li.attr('id');
						return attr2 == sourceNode.attr("id");
					} else {
						return li.html() == sourceNode.html();
					}
				});

				var sourceliClone = sourceLi.clone();
				var sourceUl = sourceLi.parent('ul');

				if(sourceUl.children('li').size() > 1){
					sourceLi.remove();
				}else{
					sourceUl.remove();
				}

				var id = sourceLi.attr("id");

				if(targetLi.children('ul').size() >0){
					if (typeof id !== 'undefined' && id !== false) {
						if ( sourceLi.hasClass('o') ) {
							targetLi.children('ul').append('<li class ="o" id="'+id+'">'+sourceliClone.html()+'</li>');
						} else if ( sourceLi.hasClass('d') ) {
							targetLi.children('ul').append('<li class ="d" id="'+id+'">'+sourceliClone.html()+'</li>');
						} else if ( sourceLi.hasClass('e') ) {
							targetLi.children('ul').append('<li class ="e" id="'+id+'">'+sourceliClone.html()+'</li>');
						} else if ( sourceLi.hasClass('f') ) {
							targetLi.children('ul').append('<li class ="f" id="'+id+'">'+sourceliClone.html()+'</li>');
						} else {
							targetLi.children('ul').append('<li class ="s" id="'+id+'">'+sourceliClone.html()+'</li>');
						}
					}else{
						targetLi.children('ul').append('<li>'+sourceliClone.html()+'</li>');
					}
				}else{
					if (typeof id !== 'undefined' && id !== false) {
						if ( sourceLi.hasClass('o') ) {
							targetLi.append('<ul><li class ="o" id="'+id+'">'+sourceliClone.html()+'</li></ul>');
						} else if ( sourceLi.hasClass('d') ) {
							targetLi.append('<ul><li class ="d" id="'+id+'">'+sourceliClone.html()+'</li></ul>');
						} else if ( sourceLi.hasClass('e') ) {
							targetLi.append('<ul><li class ="e" id="'+id+'">'+sourceliClone.html()+'</li></ul>');
						} else if ( sourceLi.hasClass('f') ) {
							targetLi.append('<ul><li class ="f" id="'+id+'">'+sourceliClone.html()+'</li></ul>');
						} else {
							targetLi.append('<ul><li class ="s" id="'+id+'">'+sourceliClone.html()+'</li></ul>');
						}
					}else{
						targetLi.append('<ul><li>'+sourceliClone.html()+'</li></ul>');
					}
				}

			}); // handleDropEvent

		} // Drag and drop
	};

	// Option defaults
	$.fn.jOrgChart.defaults = {
		chartElement : 'body',
		depth : -1,
		chartClass : "clicface-jOrgChart",
		dragAndDrop: false
	};
	
	function countChildren($node) {
		var $childNodes = $node.children("ul:first").children("li.s, li.o, li.d");
		var $childAssistantsDroite = $node.children("ul:first").children("li.a");
		var $childAssistantsGauche = $node.children("ul:first").children("li.b");
		var $childServicesDroite = $node.children("ul:first").children("li.e");
		var $childServicesGauche = $node.children("ul:first").children("li.f");
		var $childHomologue = $node.children("ul:first").children("li.h");
		var $childOrganigrammes = $node.children("ul:first").children("li.o");
		return $childNodes.length;
	};
	
	function Recurse($item, depth) {
		$item.each(function() {
			depth.count++;
			if (depth.count > depth.max) {
				depth.max = depth.count;
			}
			Recurse($(this).children(), depth);
		});
		depth.count--;
		return depth.max;
	};
	
	// Method that recursively builds the tree
	function buildNode($node, $appendTo, level, opts) {

		var $table = $("<table cellpadding='0' cellspacing='0' border='0'/>");
		var $tbody = $("<tbody/>");

		// Construct the node container(s)
		var $nodeRow = $("<tr/>").addClass("node-cells");
		var $nodeCell = $("<td/>").addClass("node-cell").attr("colspan", 2);
		var $childNodes = $node.children("ul:first").children("li.s, li.o, li.d");
		var $childAssistantsDroite = $node.children("ul:first").children("li.a");
		var $childAssistantsGauche = $node.children("ul:first").children("li.b");
		var $childServicesDroite = $node.children("ul:first").children("li.e");
		var $childServicesGauche = $node.children("ul:first").children("li.f");
		var $childHomologue = $node.children("ul:first").children("li.h");
		var $childOrganigrammes = $node.children("ul:first").children("li.o");
		var $nodeDiv;

		if($childNodes.length > 1) {
			$nodeCell.attr("colspan", $childNodes.length * 2);
		}
		
		// Draw the node
		// Get the contents - any markup except li and ul allowed
		var $nodeContent = $node.clone()
		.children("ul,li")
		.remove()
		.end()
		.html();

		var new_node_id = $node.attr("id");
		if (typeof new_node_id !== 'undefined' && new_node_id !== false) {
			$nodeDiv = $("<div>").addClass("node").attr("id", 'cellule_' + $node.attr("id")).append($nodeContent);
		}else{
			$nodeDiv = $("<div>").addClass("node").append($nodeContent);
		}

		// Expand and contract nodes
		if ($childNodes.length > 0) {
			$nodeDiv.dblclick(function() {
				var $this = $(this);
				var $tr = $this.closest("tr");
				$tr.nextAll("tr").fadeToggle("fast");

				if($tr.hasClass('contracted')){
					$this.css('cursor','n-resize');
					$tr.removeClass('contracted');
					$tr.addClass('expanded');
				}else{
					$this.css('cursor','s-resize');
					$tr.removeClass('expanded');
					$tr.addClass('contracted');
				}
			});
		}

		$nodeCell.append($nodeDiv);
		$nodeRow.append($nodeCell);
		$tbody.append($nodeRow);

		if($childNodes.length > 0) {
			// if it can be expanded then change the cursor
			$nodeDiv.css('cursor','n-resize').addClass('expanded');

			// recurse until leaves found (-1) or to the level specified
			if(opts.depth == -1 || (level+1 < opts.depth)) {
				var $downLineRow = $("<tr/>");
				var $downLineCell = $("<td/>").attr("colspan", $childNodes.length*2);
				$downLineRow.append($downLineCell);

				// draw the connecting line from the parent node to the horizontal line
				$downLine = $("<div></div>").addClass("clicface-line clicface-down");
				$downLineCell.append($downLine);
				$tbody.append($downLineRow);

				// Draw the horizontal lines
				var $linesRow = $("<tr/>");
				$childNodes.each(function() {
					var $left = $("<td>&nbsp;</td>").addClass("clicface-line clicface-left clicface-top");
					var $right = $("<td>&nbsp;</td>").addClass("clicface-line clicface-right clicface-top");
					$linesRow.append($left).append($right);
				});

				// horizontal line shouldn't extend beyond the first and last child branches
				$linesRow.find("td:first")
				.removeClass("clicface-top")
				.end()
				.find("td:last")
				.removeClass("clicface-top");

				$tbody.append($linesRow);
				var $childNodesRow = $("<tr/>");
				$childNodes.each(function() {
					var $td = $("<td class='node-container'/>");
					$td.attr("colspan", 2);
					// recurse through children lists and items
					buildNode($(this), $td, level+1, opts);
					$childNodesRow.append($td);
				});
				
				if ( $childAssistantsDroite.length > 0 && $childAssistantsGauche.length == 0 && ($childServicesDroite.length > 0 || ($childServicesDroite.length == 0 && $childServicesGauche.length == 0)) ) {
					var myRegExp = /wktemp/;
					if ( clicface_user == 'gestionnaire' && !myRegExp.test( document.URL ) ) {
						var level = (( Recurse($childAssistantsDroite.first(), { count: 0, max:0 }) - 5 ) / 2) + 1;
					} else {
						var level = (( Recurse($childAssistantsDroite.first(), { count: 0, max:0 }) - 3 ) / 2) + 1;
					}
					//$nodeDiv.append('<b><font color="purple">j\'ai ' + $childAssistantsDroite.length + ' assistant(s) qui a ' + countChildren( $childAssistantsDroite.first() ) + ' subalternes sur ' + Recurse($childAssistantsDroite.first(), { count: 0, max:0 }) + ' niveaux</font></b><br />');
					
					$containerAssistants = $("<div style='width: " + (400 + 200 * countChildren( $childAssistantsDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					$downLineCell.append($containerAssistants);
					
					$childAssistantsDroite.each(function() {
						var $div = $("<div class='node-container' style='float:right;' />");
						// recurse through children lists and items
						buildNode($(this), $div, level+1, opts);
						$containerAssistants.append($div);
					});
					
					// draw a longer connecting line from the parent node to the horizontal line
					$downLine = $("<div></div>").addClass("clicface-tree clicface-down").height(level * 250);
					if ( clicface_organi_zoom == '50' ) {
						$leftPatte = $("<div class='clicface-side-fin' style='position: relative; top: 100px; left: 2px;'></div>").width( 180 + 50 * countChildren( $childAssistantsDroite.first() ) );
					} else {
						$leftPatte = $("<div class='clicface-side-epais' style='position: relative; top: 100px; left: 2px;'></div>").width( 150 + 50 * countChildren( $childAssistantsDroite.first() ) );
					}
					$containerAssistants.append($downLine);
					$downLine.append($leftPatte);
				}
				
				if ( $childAssistantsDroite.length > 0 && $childAssistantsGauche.length == 0 && $childServicesDroite.length == 0 && $childServicesGauche.length > 0 ) {
					var myRegExp = /wktemp/;
					if ( clicface_user == 'gestionnaire' && !myRegExp.test( document.URL ) ) {
						var level_droite = (( Recurse($childAssistantsDroite.first(), { count: 0, max:0 }) - 5 ) / 2) + 1;
						var level_gauche = (( Recurse($childServicesGauche.first(), { count: 0, max:0 }) - 5 ) / 2) + 1;
					} else {
						var level_droite = (( Recurse($childAssistantsDroite.first(), { count: 0, max:0 }) - 3 ) / 2) + 1;
						var level_gauche = (( Recurse($childServicesGauche.first(), { count: 0, max:0 }) - 3 ) / 2) + 1;
					}
					if ( level_droite <= level_gauche ) {
						var level = level_gauche;
					} else {
						var level = level_droite;
					}
					
					if ( countChildren( $childAssistantsDroite.first() ) > 1 ) {
						$containerAssistantsDroite = $("<div style='width: " + (200 + 200 * countChildren( $childAssistantsDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else if ( countChildren( $childAssistantsDroite.first() ) > 0 ) {
						$containerAssistantsDroite = $("<div style='width: " + (300 + 200 * countChildren( $childAssistantsDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else {
						$containerAssistantsDroite = $("<div style='width: " + (400 + 200 * countChildren( $childAssistantsDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					}
					if ( countChildren( $childServicesGauche.first() ) > 1 ) {
						$containerServicesGauche = $("<div style='width: " + (400 + 200 * countChildren( $childServicesGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else if ( countChildren( $childServicesGauche.first() ) > 0 ) {
						$containerServicesGauche = $("<div style='width: " + (300 + 200 * countChildren( $childServicesGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else {
						$containerServicesGauche = $("<div style='width: " + (400 + 200 * countChildren( $childServicesGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					}
					$downLineCell.append($containerServicesGauche);
					$containerServicesGauche.append($containerAssistantsDroite);
					
					$childAssistantsDroite.each(function() {
						var $div = $("<div class='node-container' style='float:right;' />");
						// recurse through children lists and items
						buildNode($(this), $div, level+1, opts);
						$containerAssistantsDroite.append($div);
					});
					
					$childServicesGauche.each(function() {
						var $div = $("<div class='node-container' style='float:left;' />");
						// recurse through children lists and items
						buildNode($(this), $div, level+1, opts);
						$containerServicesGauche.append($div);
					});
					
					// draw a longer connecting line from the parent node to the horizontal line
					$downLine = $("<div></div>").addClass("clicface-tree clicface-down").height(level * 250);
					if ( clicface_organi_zoom == '50' ) {
						$rightPatte = $("<div class='clicface-side-fin' style='position: relative; top: 104px; left: 2px;'></div>").width( 180 + 50 * countChildren( $childServicesGauche.first() ) ).css( "margin-left", -1*(180 + 50 * countChildren( $childServicesGauche.first() )) );
						$leftPatte = $("<div class='clicface-side-fin' style='position: relative; top: 100px; left: 2px;'></div>").width( 180 + 50 * countChildren( $childAssistantsDroite.first() ) );
					} else {
						$rightPatte = $("<div class='clicface-side-epais' style='position: relative; top: 104px; left: 2px;'></div>").width( 150 + 50 * countChildren( $childServicesGauche.first() ) ).css( "margin-left", -1*(150 + 50 * countChildren( $childServicesGauche.first() )) );
						$leftPatte = $("<div class='clicface-side-epais' style='position: relative; top: 100px; left: 2px;'></div>").width( 150 + 50 * countChildren( $childAssistantsDroite.first() ) );
					}
					$containerAssistantsDroite.append($downLine);
					$containerServicesGauche.append($downLine);
					$downLine.append($rightPatte);
					$downLine.append($leftPatte);
				}
				
				if ( $childAssistantsGauche.length > 0 && $childAssistantsDroite.length == 0 && ($childServicesGauche.length > 0 || ($childServicesGauche.length == 0 && $childServicesDroite.length == 0)) ) {
					var myRegExp = /wktemp/;
					if ( clicface_user == 'gestionnaire' && !myRegExp.test( document.URL ) ) {
						var level = (( Recurse($childAssistantsGauche.first(), { count: 0, max:0 }) - 5 ) / 2) + 1;
					} else {
						var level = (( Recurse($childAssistantsGauche.first(), { count: 0, max:0 }) - 3 ) / 2) + 1;
					}
					
					$containerAssistants = $("<div style='width: " + (400 + 200 * countChildren( $childAssistantsGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					$downLineCell.append($containerAssistants);
					
					$childAssistantsGauche.each(function() {
						var $div = $("<div class='node-container' style='float:left;' />");
						// recurse through children lists and items
						buildNode($(this), $div, level+1, opts);
						$containerAssistants.append($div);
					});
					
					// draw a longer connecting line from the parent node to the horizontal line
					$downLine = $("<div></div>").addClass("clicface-tree clicface-down").height(level * 250);
					if ( clicface_organi_zoom == '50' ) {
						$rightPatte = $("<div class='clicface-side-fin' style='position: relative; top: 100px; left: 2px;'></div>").width( 180 + 50 * countChildren( $childAssistantsGauche.first() ) ).css( "margin-left", -1*(180 + 50 * countChildren( $childAssistantsGauche.first() )) );
					} else {
						$rightPatte = $("<div class='clicface-side-epais' style='position: relative; top: 100px; left: 2px;'></div>").width( 150 + 50 * countChildren( $childAssistantsGauche.first() ) ).css( "margin-left", -1*(150 + 50 * countChildren( $childAssistantsGauche.first() )) );
					}
					$containerAssistants.append($downLine);
					$downLine.append($rightPatte);
				}
				
				if ( $childAssistantsGauche.length > 0 && $childAssistantsDroite.length == 0 && $childServicesGauche.length == 0 && $childServicesDroite.length > 0 ) {
					var myRegExp = /wktemp/;
					if ( clicface_user == 'gestionnaire' && !myRegExp.test( document.URL ) ) {
						var level_droite = (( Recurse($childServicesDroite.first(), { count: 0, max:0 }) - 5 ) / 2) + 1;
						var level_gauche = (( Recurse($childAssistantsGauche.first(), { count: 0, max:0 }) - 5 ) / 2) + 1;
					} else {
						var level_droite = (( Recurse($childServicesDroite.first(), { count: 0, max:0 }) - 3 ) / 2) + 1;
						var level_gauche = (( Recurse($childAssistantsGauche.first(), { count: 0, max:0 }) - 3 ) / 2) + 1;
					}
					if ( level_droite <= level_gauche ) {
						var level = level_gauche;
					} else {
						var level = level_droite;
					}
					
					if ( countChildren( $childServicesDroite.first() ) > 1 ) {
						$containerServicesDroite = $("<div style='width: " + (200 + 200 * countChildren( $childServicesDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else if ( countChildren( $childServicesDroite.first() ) > 0 ) {
						$containerServicesDroite = $("<div style='width: " + (300 + 200 * countChildren( $childServicesDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else {
						$containerServicesDroite = $("<div style='width: " + (400 + 200 * countChildren( $childServicesDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					}
					if ( countChildren( $childAssistantsGauche.first() ) > 1 ) {
						$containerAssistantsGauche = $("<div style='width: " + (200 + 200 * countChildren( $childAssistantsGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else if ( countChildren( $childAssistantsGauche.first() ) > 0 ) {
						$containerAssistantsGauche = $("<div style='width: " + (300 + 200 * countChildren( $childAssistantsGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else {
						$containerAssistantsGauche = $("<div style='width: " + (400 + 200 * countChildren( $childAssistantsGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					}
					$downLineCell.append($containerAssistantsGauche);
					$containerAssistantsGauche.append($containerServicesDroite);
					
					$childServicesDroite.each(function() {
						var $div = $("<div class='node-container' style='float:right;' />");
						// recurse through children lists and items
						buildNode($(this), $div, level+1, opts);
						$containerServicesDroite.append($div);
					});
					
					$childAssistantsGauche.each(function() {
						var $div = $("<div class='node-container' style='float:left;' />");
						// recurse through children lists and items
						buildNode($(this), $div, level+1, opts);
						$containerAssistantsGauche.append($div);
					});
					
					// draw a longer connecting line from the parent node to the horizontal line
					$downLine = $("<div></div>").addClass("clicface-tree clicface-down").height(level * 250);
					if ( clicface_organi_zoom == '50' ) {
						$rightPatte = $("<div class='clicface-side-fin' style='position: relative; top: 104px; left: 2px;'></div>").width( 180 + 50 * countChildren( $childAssistantsGauche.first() ) ).css( "margin-left", -1*(180 + 50 * countChildren( $childAssistantsGauche.first() )) );
						$leftPatte = $("<div class='clicface-side-fin' style='position: relative; top: 100px; left: 2px;'></div>").width( 180 + 50 * countChildren( $childServicesDroite.first() ) );
					} else {
						$rightPatte = $("<div class='clicface-side-epais' style='position: relative; top: 104px; left: 2px;'></div>").width( 150 + 50 * countChildren( $childAssistantsGauche.first() ) ).css( "margin-left", -1*(150 + 50 * countChildren( $childAssistantsGauche.first() )) );
						$leftPatte = $("<div class='clicface-side-epais' style='position: relative; top: 100px; left: 2px;'></div>").width( 150 + 50 * countChildren( $childServicesDroite.first() ) );
					}
					$containerServicesDroite.append($downLine);
					$containerAssistantsGauche.append($downLine);
					$downLine.append($rightPatte);
					$downLine.append($leftPatte);
				}
				
				if ( $childAssistantsGauche.length > 0 && $childAssistantsDroite.length > 0 ) {
					var myRegExp = /wktemp/;
					if ( clicface_user == 'gestionnaire' && !myRegExp.test( document.URL ) ) {
						var level_droite = (( Recurse($childAssistantsDroite.first(), { count: 0, max:0 }) - 5 ) / 2) + 1;
						var level_gauche = (( Recurse($childAssistantsGauche.first(), { count: 0, max:0 }) - 5 ) / 2) + 1;
					} else {
						var level_droite = (( Recurse($childAssistantsDroite.first(), { count: 0, max:0 }) - 3 ) / 2) + 1;
						var level_gauche = (( Recurse($childAssistantsGauche.first(), { count: 0, max:0 }) - 3 ) / 2) + 1;
					}
					if ( level_droite <= level_gauche ) {
						var level = level_gauche;
					} else {
						var level = level_droite;
					}
					
					if ( countChildren( $childAssistantsDroite.first() ) > 1 ) {
						$containerAssistantsDroite = $("<div style='width: " + (200 + 200 * countChildren( $childAssistantsDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else if ( countChildren( $childAssistantsDroite.first() ) > 0 ) {
						$containerAssistantsDroite = $("<div style='width: " + (300 + 200 * countChildren( $childAssistantsDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else {
						$containerAssistantsDroite = $("<div style='width: " + (400 + 200 * countChildren( $childAssistantsDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					}
					if ( countChildren( $childAssistantsGauche.first() ) > 1 ) {
						$containerAssistantsGauche = $("<div style='width: " + (200 + 200 * countChildren( $childAssistantsGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else if ( countChildren( $childAssistantsGauche.first() ) > 0 ) {
						$containerAssistantsGauche = $("<div style='width: " + (300 + 200 * countChildren( $childAssistantsGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else {
						$containerAssistantsGauche = $("<div style='width: " + (400 + 200 * countChildren( $childAssistantsGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					}
					$downLineCell.append($containerAssistantsGauche);
					$containerAssistantsGauche.append($containerAssistantsDroite);
					
					$childAssistantsDroite.each(function() {
						var $div = $("<div class='node-container' style='float:right;' />");
						// recurse through children lists and items
						buildNode($(this), $div, level+1, opts);
						$containerAssistantsDroite.append($div);
					});
					
					$childAssistantsGauche.each(function() {
						var $div = $("<div class='node-container' style='float:left;' />");
						// recurse through children lists and items
						buildNode($(this), $div, level+1, opts);
						$containerAssistantsGauche.append($div);
					});
					
					// draw a longer connecting line from the parent node to the horizontal line
					$downLine = $("<div></div>").addClass("clicface-tree clicface-down").height(level * 250);
					if ( clicface_organi_zoom == '50' ) {
						$rightPatte = $("<div class='clicface-side-fin' style='position: relative; top: 104px; left: 2px;'></div>").width( 180 + 50 * countChildren( $childAssistantsGauche.first() ) ).css( "margin-left", -1*(180 + 50 * countChildren( $childAssistantsGauche.first() )) );
						$leftPatte = $("<div class='clicface-side-fin' style='position: relative; top: 100px; left: 2px;'></div>").width( 180 + 50 * countChildren( $childAssistantsDroite.first() ) );
					} else {
						$rightPatte = $("<div class='clicface-side-epais' style='position: relative; top: 104px; left: 2px;'></div>").width( 150 + 50 * countChildren( $childAssistantsGauche.first() ) ).css( "margin-left", -1*(150 + 50 * countChildren( $childAssistantsGauche.first() )) );
						$leftPatte = $("<div class='clicface-side-epais' style='position: relative; top: 100px; left: 2px;'></div>").width( 150 + 50 * countChildren( $childAssistantsDroite.first() ) );
					}
					$containerAssistantsDroite.append($downLine);
					$containerAssistantsGauche.append($downLine);
					$downLine.append($rightPatte);
					$downLine.append($leftPatte);
				}
				
				if ( $childServicesDroite.length > 0 && $childServicesGauche.length == 0 && ($childAssistantsDroite.length > 0 || ($childAssistantsDroite.length == 0 && $childAssistantsGauche.length == 0)) ) {
					var myRegExp = /wktemp/;
					if ( clicface_user == 'gestionnaire' && !myRegExp.test( document.URL ) ) {
						var level = (( Recurse($childServicesDroite.first(), { count: 0, max:0 }) - 5 ) / 2) + 1;
					} else {
						var level = (( Recurse($childServicesDroite.first(), { count: 0, max:0 }) - 3 ) / 2) + 1;
					}
					//$nodeDiv.append('<b><font color="purple">j\'ai ' + $childServicesDroite.length + ' assistant(s) qui a ' + countChildren( $childServicesDroite.first() ) + ' subalternes sur ' + Recurse($childServicesDroite.first(), { count: 0, max:0 }) + ' niveaux</font></b><br />');
					
					$containerServices = $("<div style='width: " + (400 + 200 * countChildren( $childServicesDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					$downLineCell.append($containerServices);
					
					$childServicesDroite.each(function() {
						var $div = $("<div class='node-container' style='float:right;' />");
						// recurse through children lists and items
						buildNode($(this), $div, level+1, opts);
						$containerServices.append($div);
					});
					
					// draw a longer connecting line from the parent node to the horizontal line
					$downLine = $("<div></div>").addClass("clicface-tree clicface-down").height(level * 250);
					if ( clicface_organi_zoom == '50' ) {
						$leftPatte = $("<div class='clicface-side-fin' style='position: relative; top: 100px; left: 2px;'></div>").width( 180 + 50 * countChildren( $childServicesDroite.first() ) );
					} else {
						$leftPatte = $("<div class='clicface-side-epais' style='position: relative; top: 100px; left: 2px;'></div>").width( 150 + 50 * countChildren( $childServicesDroite.first() ) );
					}
					$containerServices.append($downLine);
					$downLine.append($leftPatte);
				}
				
				if ( $childServicesGauche.length > 0 && $childServicesDroite.length == 0 && ($childAssistantsGauche.length > 0 || ($childAssistantsGauche.length == 0 && $childAssistantsDroite.length == 0 )) ) {
					var myRegExp = /wktemp/;
					if ( clicface_user == 'gestionnaire' && !myRegExp.test( document.URL ) ) {
						var level = (( Recurse($childServicesGauche.first(), { count: 0, max:0 }) - 5 ) / 2) + 1;
					} else {
						var level = (( Recurse($childServicesGauche.first(), { count: 0, max:0 }) - 3 ) / 2) + 1;
					}
					
					$containerServices = $("<div style='width: " + (400 + 200 * countChildren( $childServicesGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					$downLineCell.append($containerServices);
					
					$childServicesGauche.each(function() {
						var $div = $("<div class='node-container' style='float:left;' />");
						// recurse through children lists and items
						buildNode($(this), $div, level+1, opts);
						$containerServices.append($div);
					});
					
					// draw a longer connecting line from the parent node to the horizontal line
					$downLine = $("<div></div>").addClass("clicface-tree clicface-down").height(level * 250);
					if ( clicface_organi_zoom == '50' ) {
						$rightPatte = $("<div class='clicface-side-fin' style='position: relative; top: 100px; left: 2px;'></div>").width( 180 + 50 * countChildren( $childServicesGauche.first() ) ).css( "margin-left", -1*(180 + 50 * countChildren( $childServicesGauche.first() )) );
					} else {
						$rightPatte = $("<div class='clicface-side-epais' style='position: relative; top: 100px; left: 2px;'></div>").width( 150 + 50 * countChildren( $childServicesGauche.first() ) ).css( "margin-left", -1*(150 + 50 * countChildren( $childServicesGauche.first() )) );
					}
					$containerServices.append($downLine);
					$downLine.append($rightPatte);
				}
				
				if ( $childServicesGauche.length > 0 && $childServicesDroite.length > 0 ) {
					var myRegExp = /wktemp/;
					if ( clicface_user == 'gestionnaire' && !myRegExp.test( document.URL ) ) {
						var level_droite = (( Recurse($childServicesDroite.first(), { count: 0, max:0 }) - 5 ) / 2) + 1;
						var level_gauche = (( Recurse($childServicesGauche.first(), { count: 0, max:0 }) - 5 ) / 2) + 1;
					} else {
						var level_droite = (( Recurse($childServicesDroite.first(), { count: 0, max:0 }) - 3 ) / 2) + 1;
						var level_gauche = (( Recurse($childServicesGauche.first(), { count: 0, max:0 }) - 3 ) / 2) + 1;
					}
					if ( level_droite <= level_gauche ) {
						var level = level_gauche;
					} else {
						var level = level_droite;
					}
					
					if ( countChildren( $childServicesDroite.first() ) > 1 ) {
						$containerServicesDroite = $("<div style='width: " + (200 + 200 * countChildren( $childServicesDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else if ( countChildren( $childServicesDroite.first() ) > 0 ) {
						$containerServicesDroite = $("<div style='width: " + (300 + 200 * countChildren( $childServicesDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else {
						$containerServicesDroite = $("<div style='width: " + (400 + 200 * countChildren( $childServicesDroite.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					}
					if ( countChildren( $childServicesGauche.first() ) > 1 ) {
						$containerServicesGauche = $("<div style='width: " + (200 + 200 * countChildren( $childServicesGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else if ( countChildren( $childServicesGauche.first() ) > 0 ) {
						$containerServicesGauche = $("<div style='width: " + (300 + 200 * countChildren( $childServicesGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					} else {
						$containerServicesGauche = $("<div style='width: " + (400 + 200 * countChildren( $childServicesGauche.first() ) + 200 * countChildren( $childOrganigrammes.first() )) + "px; margin-left: auto; margin-right: auto;' />");
					}
					$downLineCell.append($containerServicesGauche);
					$containerServicesGauche.append($containerServicesDroite);
					
					$childServicesDroite.each(function() {
						var $div = $("<div class='node-container' style='float:right;' />");
						// recurse through children lists and items
						buildNode($(this), $div, level+1, opts);
						$containerServicesDroite.append($div);
					});
					
					$childServicesGauche.each(function() {
						var $div = $("<div class='node-container' style='float:left;' />");
						// recurse through children lists and items
						buildNode($(this), $div, level+1, opts);
						$containerServicesGauche.append($div);
					});
					
					// draw a longer connecting line from the parent node to the horizontal line
					$downLine = $("<div></div>").addClass("clicface-tree clicface-down").height(level * 250);
					if ( clicface_organi_zoom == '50' ) {
						$rightPatte = $("<div class='clicface-side-fin' style='position: relative; top: 104px; left: 2px;'></div>").width( 180 + 50 * countChildren( $childServicesGauche.first() ) ).css( "margin-left", -1*(180 + 50 * countChildren( $childServicesGauche.first() )) );
						$leftPatte = $("<div class='clicface-side-fin' style='position: relative; top: 100px; left: 2px;'></div>").width( 180 + 50 * countChildren( $childServicesDroite.first() ) );
					} else {
						$rightPatte = $("<div class='clicface-side-epais' style='position: relative; top: 104px; left: 2px;'></div>").width( 150 + 50 * countChildren( $childServicesGauche.first() ) ).css( "margin-left", -1*(150 + 50 * countChildren( $childServicesGauche.first() )) );
						$leftPatte = $("<div class='clicface-side-epais' style='position: relative; top: 100px; left: 2px;'></div>").width( 150 + 50 * countChildren( $childServicesDroite.first() ) );
					}
					$containerServicesDroite.append($downLine);
					$containerServicesGauche.append($downLine);
					$downLine.append($rightPatte);
					$downLine.append($leftPatte);
				}
				
				var nombre_colonnes = $nodeCell.attr("colspan") / 2;
				var largeur_colonne = (100 / nombre_colonnes) + '%';
				
				if ($childHomologue.length > 0) {
					var $HomologueRow = $("<td/>").addClass("node-cell").attr("colspan", nombre_colonnes);
					$containerHomologue = $("<div/>");
					
					$childHomologue.each(function() {
						var $div = $("<div class='node-container' />");
						// recurse through children lists and items
						buildNode($(this), $div, level+1, opts);
						$containerHomologue.append($div);
					});
					
					$nodeCell.attr("colspan", nombre_colonnes);
					
					$nodeRow.append( $HomologueRow );
					$HomologueRow.append( $containerHomologue );
					
					var $linesRow = $("<tr/>");
					$nodeCell.parents('tr').after($linesRow);
					
					var $RCol1 = $("<td><table cellpadding='0' cellspacing='0' border='0' style='width:100%;'></table></td>");
					$RCol1.attr("colspan", nombre_colonnes);
					$linesRow.append($RCol1);
					
					var $Col1 = $("<tr/>");
					$RCol1.children("table").append($Col1);
					
					var $RCol2 = $("<td><table cellpadding='0' cellspacing='0' border='0' style='width:100%;'></table></td>");
					$RCol2.attr("colspan", nombre_colonnes);
					$linesRow.append($RCol2);
					
					var $Col2 = $("<tr/>");
					$RCol2.children("table").append($Col2);
					
					if ( nombre_colonnes % 2 == 0 ) {
						// si le nombre de subalternes est pair
						for (i = 0; i < nombre_colonnes / 2 - 1; i++) {
							var $vide = $("<td>&nbsp;</td>").css("width", largeur_colonne);
							$Col1.append($vide);
						}
						var $left = $("<td>&nbsp;</td>").addClass("clicface-line clicface-left").css("width", largeur_colonne);
						$Col1.append($left);
						var $right = $("<td>&nbsp;</td>").addClass("clicface-line clicface-bottom clicface-right").css("width", largeur_colonne);
						$Col1.append($right);
						for (i = 0; i < nombre_colonnes / 2 - 1; i++) {
							var $bottom = $("<td>&nbsp;</td>").addClass("clicface-line clicface-bottom").css("width", largeur_colonne);
							$Col1.append($bottom);
						}
						
						for (i = 0; i < nombre_colonnes / 2 - 1; i++) {
							var $bottom = $("<td>&nbsp;</td>").addClass("clicface-line clicface-bottom").css("width", largeur_colonne);
							$Col2.append($bottom);
						}
						var $left = $("<td>&nbsp;</td>").addClass("clicface-line clicface-bottom clicface-left").css("width", largeur_colonne);
						$Col2.append($left);
						var $right = $("<td>&nbsp;</td>").addClass("clicface-line clicface-right").css("width", largeur_colonne);
						$Col2.append($right);
						for (i = 0; i < nombre_colonnes / 2 - 1; i++) {
							var $vide = $("<td>&nbsp;</td>").css("width", largeur_colonne);
							$Col2.append($vide);
						}
					} else {
						// si le nombre de subalternes est impair
						for (i = 0; i < (nombre_colonnes+1) / 2 - 1; i++) {
							var $vide = $("<td>&nbsp;</td>").css("width", largeur_colonne);
							$Col1.append($vide);
						}
						var $right = $("<td class='node-cell'><table cellpadding='0' cellspacing='0' border='0' style='width:100%;'><tbody><tr class='node-cells'><td class='node-cell clicface-line clicface-left'></td><td class='node-cell clicface-line clicface-bottom clicface-right'></td></tr></tbody></table></td>");
						$Col1.append($right);
						for (i = 0; i < (nombre_colonnes+1) / 2 - 1; i++) {
							var $bottom = $("<td>&nbsp;</td>").addClass("clicface-line clicface-bottom").css("width", largeur_colonne);
							$Col1.append($bottom);
						}
						
						for (i = 0; i < (nombre_colonnes+1) / 2 - 1; i++) {
							var $bottom = $("<td>&nbsp;</td>").addClass("clicface-line clicface-bottom").css("width", largeur_colonne);
							$Col2.append($bottom);
						}
						var $left = $("<td class='node-cell'><table cellpadding='0' cellspacing='0' border='0' style='width:100%;'><tbody><tr class='node-cells'><td class='node-cell clicface-line clicface-bottom clicface-left'></td><td class='node-cell clicface-line clicface-right'></td></tr></tbody></table></td>");
						$Col2.append($left);
						for (i = 0; i < (nombre_colonnes+1) / 2 - 1; i++) {
							var $vide = $("<td>&nbsp;</td>").css("width", largeur_colonne);
							$Col2.append($vide);
						}
					}
				}
			}
			$tbody.append($childNodesRow);
		}

		// any classes on the LI element get copied to the relevant node in the tree
		// apart from the special 'collapsed' class, which collapses the sub-tree at this point
		if ($node.attr('class') != undefined) {
			var classList = $node.attr('class').split(/\s+/);
			$.each(classList, function(index,item) {
				if (item == 'collapsed') {
					$nodeRow.nextAll('tr').css('display', 'none');
					$nodeRow.removeClass('expanded');
					$nodeRow.addClass('contracted');
					$nodeDiv.css('cursor','s-resize');
				} else {
					$nodeDiv.addClass(item);
				}
			});
		}

		$table.append($tbody);
		$appendTo.append($table);
	};

})(jQuery);