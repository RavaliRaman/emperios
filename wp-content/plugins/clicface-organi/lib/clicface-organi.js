function parseNodes(children) { // takes a children array and turns it into a <ul>
	var ul = document.createElement("UL");
	for(var i=0; i<children.length; i++) {
		ul.appendChild(parseNode(children[i]));
	}
	return ul;
}

function parseNode(node) { // takes a node object and turns it into a <li>
	var li = document.createElement("LI");
	li.innerHTML = node.cellule + node.gestion;
	if ( node.ty == undefined ) {
		li.className = 's';
	} else {
		li.className = node.ty;
	}
	li.id = node.id;
	if(node.children) li.appendChild(parseNodes(node.children));
	return li;
}

jQuery.fn.contentChange = function(callback){
	var elms = jQuery(this);
	elms.each(
		function(i){
			var elm = jQuery(this);
			elm.data("lastContents", elm.html());
			window.watchContentChange = window.watchContentChange ? window.watchContentChange : [];
			window.watchContentChange.push({"element": elm, "callback": callback});
		}
	)
	return elms;
}

setInterval(function(){
	if(window.watchContentChange){
		for( i in window.watchContentChange){
			if(window.watchContentChange[i].element.data("lastContents") != window.watchContentChange[i].element.html()){
				window.watchContentChange[i].callback.apply(window.watchContentChange[i].element);
				window.watchContentChange[i].element.data("lastContents", window.watchContentChange[i].element.html())
			};
		}
	}
},500);