<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Org Chart</title>

    <style>

	.node {
		cursor: pointer;
	}

	.node circle {
	  fill: #fff;
	  stroke: steelblue;
	  stroke-width: 2px;
	}

	.node text {
	  font: 12px sans-serif;
	}

	.link {
	  fill: none;
	  stroke: #ccc;
	  stroke-width: 2px;
	}

    </style>

  </head>

  <body>

<!-- load the d3.js library -->
<script src="http://d3js.org/d3.v3.min.js"></script>
<?php

mysql_connect("localhost", "dvishal_wp8", "E^PGePFTJfZEO^A]Gk~17&(6") or
    die("Could not connect: " . mysql_error());
mysql_select_db("dvishal_wp8");

$result = mysql_query("SELECT user_id,Name,Position,Email_id,Contact,Address,ReportTo,ReportedBy,Detail,Image FROM OrgChart");
if (!$result) {
    echo 'Could not run query: ' . mysql_error();
    exit;
}
echo $result;
$row = mysql_fetch_row($result);
?>
<script>

var treeData = [
  {
  
  
    "name": "Sheikh Ali Faiz",
    "value": 10,
    "type": "black",
    "level": "red",
    "icon": "https://i.ytimg.com/vi/-9067341JXo/maxresdefault.jpg",
    "parent": "null",
    "children": [
      {
        "name": "Sanjay Samal",
        "parent": "Top Level",
        "children": [
          {
            "name": "Richa Gupta",
            "parent": "Level 2: A"
          },
          {
            "name": "Majeed",
            "parent": "Level 2: A",
            "children": [
          {
            "name": "Mahidur R Khan ",
            //"parent": "Level 2: A"
          "children": [
          {
            "name": "Nikita ",
            //"parent": "Level 2: A"
          },
          {
            "name": "Rakesh ",
            //"parent": "Level 2: A"

            	"children": [
          {
            "name": "Veer ",
            //"parent": "Level 2: A"
          },
          {
            "name": "mehtab ",
            //"parent": "Level 2: A"
          }
          ]


          },
          {
            "name": "Deepika ",
            //"parent": "Level 2: A"
          }

          ]         }

          ]

          },
          {
            "name": "Sambhavana Jain",
            "parent": "Level 2: A",
             "children": [
          {
            "name": "Satish ",
            //"parent": "Level 2: A"
          }]
          },{
            "name": "Piyush Rani",
            "parent": "Level 2: A"
          },
          {
            "name": "Chakhradhar Yadav",
            "parent": "Level 2: A"
          },
          {
            "name": "Abhinav Rao",
            "parent": "Level 2: A"
          }
        ]
      },

    ]
  }
];


// ************** Generate the tree diagram	 *****************
var margin = {top: 30, right: 100, bottom: 20, left: 100},
	width = 1500 - margin.right - margin.left,
	height = 1100 - margin.top - margin.bottom;

var i = 0,
  duration = 550,
	root;

var tree = d3.layout.tree()
	.size([height, width]);

var diagonal = d3.svg.diagonal()
	.projection(function(d) { return [d.x, d.y]; });

var svg = d3.select("body").append("svg")
	.attr("width", width + margin.right + margin.left)
	.attr("height", height + margin.top + margin.bottom)
  .append("g")
	.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

root = treeData[0];
root.x0 = height / 2;
root.y0 = 0;

update(root);

d3.select(self.frameElement).style("height", "500px");

function update(source) {

  // Compute the new tree layout.
  var nodes = tree.nodes(root).reverse(),
	  links = tree.links(nodes);

  // Normalize for fixed-depth.
  nodes.forEach(function(d) { d.y = d.depth * 180; });

  // Update the nodes…
  var node = svg.selectAll("g.node")
	  .data(nodes, function(d) { return d.id || (d.id = ++i); });

  // Enter any new nodes at the parent's previous position.
  var nodeEnter = node.enter().append("g")
	  .attr("class", "node")
	  .attr("transform", function(d) { return "translate(" + source.x0 + "," + source.y0 + ")"; })
	  .on("click", click);

  nodeEnter.append("circle")
	  .attr("r", 1e-6)
	  .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

  nodeEnter.append("text")
	  .attr("x", function(d) { return d.children || d._children ? -5 : 10; })
	  .attr("dx", ".10em")
    .attr("y", function(d) { return d.children || d._children ? -20 : 10; })
    .attr("dy",".10em")
	  .attr("text-anchor", function(d) { return d.children || d._children ? "end" : "start"; })
	  .text(function(d) { return d.name; })
	  .style("fill-opacity", 1e-6);

  // Transition nodes to their new position.
  var nodeUpdate = node.transition()
	  .duration(duration)
	  .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

  nodeUpdate.select("circle")
	  .attr("r", 10)
	  .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

  nodeUpdate.select("text")
	  .style("fill-opacity", 1);

  // Transition exiting nodes to the parent's new position.
  var nodeExit = node.exit().transition()
	  .duration(duration)
	  .attr("transform", function(d) { return "translate(" + source.x + "," + source.y + ")"; })
	  .remove();

  nodeExit.select("circle")
	  .attr("r", 1e-6);

  nodeExit.select("text")
	  .style("fill-opacity", 1e-6);

  // Update the links…
  var link = svg.selectAll("path.link")
	  .data(links, function(d) { return d.target.id; });

  // Enter any new links at the parent's previous position.
  link.enter().insert("path", "g")
	  .attr("class", "link")
	  .attr("d", function(d) {
		var o = {x: source.x0, y: source.y0};
		return diagonal({source: o, target: o});
	  });

  // Transition links to their new position.
  link.transition()
	  .duration(duration)
	  .attr("d", diagonal);

  // Transition exiting nodes to the parent's new position.
  link.exit().transition()
	  .duration(duration)
	  .attr("d", function(d) {
		var o = {x: source.x, y: source.y};
		return diagonal({source: o, target: o});
	  })
	  .remove();

  // Stash the old positions for transition.
  nodes.forEach(function(d) {
	d.x0 = d.x;
	d.y0 = d.y;
  });
}

// Toggle children on click.
function click(d) {
  if (d.children) {
	d._children = d.children;
	d.children = null;
  } else {
	d.children = d._children;
	d._children = null;
  }
  update(d);
}

</script>

  </body>
</html>

<?php
include ('logout.php');
?>