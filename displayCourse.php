<?php
// error_reporting(E_ERROR | E_PARSE);   //while debugging remove this as ll warnings lost!! 
session_start();

?>

<html>
 <head>
  <title>DUMMY University Website</title>
</head>
 <body>
  <h1>
    I am Manikanta. I am sam fan!!
    <br>
  </h1>
<!-- 
 Browsing student!!

<table border="1" cellpadding="5" cellspacing="5">
  <tr>
    <th>
      cid
    </th>
    <th>
      name
    </th>
  </tr>
  <tr>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "university1";
  // $designation = $_POST["identity"];
  $mysqli = new mysqli($servername, $username, $password,$dbname);
  if (mysqli_connect_errno()) {
      die("Connection failed: " . mysqli_connect_error());
  }
  $sql_query = "SELECT cid, name FROM course";
  $result = $mysqli->query($sql_query);
  while ($stud = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$stud['cid']."</td>";
    echo "<td>".$stud['name']."</td>";
    echo "</tr>";
  }
  ?>
  </tr>
</table>
-->
<style>
  
  .node {
    cursor: pointer;
  }

  .node circle {
    fill: #fff;
    stroke: steelblue;
    stroke-width: 3px;
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
  
<script>
var treeData = [
{
  "name":"All courses",
  "parent": "null",
  "children":[
    //need to fill
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "university1";
    // $designation = $_POST["identity"];
    $mysqli = new mysqli($servername, $username, $password,$dbname);
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql_query = "SELECT distinct name,cid FROM course";
    // echo "$sql_query";
    $result = $mysqli->query($sql_query);
    while ($stud = $result->fetch_assoc()) {
      echo "{";
      echo  "'name' : '";
      echo $stud['name'];
      echo "' ,";
      echo  "'parent': 'All courses',";
      echo "'children': [";
      // echo "{";
      //for department
      $sql_query2 = "SELECT distinct d.name as name FROM department d, course c, offer o where o.cid = c.cid and o.did = d.did and c.cid = ".$stud['cid'];
      $result2 = $mysqli->query($sql_query2);
      $stud2 = $result2->fetch_assoc();
      echo "{";
      // echo "fill: #000;";
      echo  "'name' : '";
      echo $stud2['name'];
      echo "' ,";
      echo  "'parent': '";
      echo $stud['name'];
      echo "'},";
      //for instructor
      $sql_query2 = "SELECT distinct i.name as name FROM instructor i, course c, teach t where t.cid = c.cid and t.iid = i.iid and c.cid = ".$stud['cid'];
      $result2 = $mysqli->query($sql_query2);
      $stud2 = $result2->fetch_assoc();
      echo "{";
      echo  "'name' : '";
      echo $stud2['name'];
      echo "' ,";
      echo  "'parent': '";
      echo $stud['name'];
      echo "'},";
      $sql_query1 = "SELECT distinct s.name as name FROM student s, course c, takes t where c.cid = t.cid and t.sid = s.sid and c.cid = ".$stud['cid'];
      $result1 = $mysqli->query($sql_query1);
      while ($stud1 = $result1->fetch_assoc()) {
          echo "{";
          echo  "'name' : '";
          echo $stud1['name'];
          echo "' ,";
          echo  "'parent': '";
          echo $stud['name'];
          echo "'},";
      }

      echo "]";
      echo "},";
    }

    ?>
  ]
}
];

// window.alert(treeData);


// var treeData = [
//   {
//     "name": "Top Level",
//     "parent": "null",
//     "children": [
//       {
//         "name": "Level 2: A",
//         "parent": "Top Level",
//         "children": [
//           {
//             "name": "Son of A",
//             "parent": "Level 2: A"
//           },
//           {
//             "name": "Daughter of A",
//             "parent": "Level 2: A"
//           }
//         ]
//       },
//       {
//         "name": "Level 2: B",
//         "parent": "Top Level"
//       }
//     ]
//   }
// ];


// ************** Generate the tree diagram  *****************
var margin = {
  top: 20, right: 120, bottom: 20, left: 120},
  width = 960 - margin.right - margin.left,
  height = 500 - margin.top - margin.bottom;

var i = 0,
  duration = 750,
  root;

var tree = d3.layout.tree()
  .size([height, width]);

var diagonal = d3.svg.diagonal()
  .projection(function(d) { return [d.y, d.x]; });

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
collapseAll(root);
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
    .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
    .on("click", click);

  nodeEnter.append("circle")
    .attr("r", 1e-6)
    .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

  nodeEnter.append("text")
    .attr("x", function(d) { return d.children || d._children ? -13 : 13; })
    .attr("dy", ".35em")
    .attr("text-anchor", function(d) { return d.children || d._children ? "end" : "start"; })
    .text(function(d) { return d.name; })
    .style("fill-opacity", 1e-6);

  // Transition nodes to their new position.
  var nodeUpdate = node.transition()
    .duration(duration)
    .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });

  nodeUpdate.select("circle")
    .attr("r", 10)
    .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

  nodeUpdate.select("text")
    .style("fill-opacity", 1);

  // Transition exiting nodes to the parent's new position.
  var nodeExit = node.exit().transition()
    .duration(duration)
    .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
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

function expand(d){   
    var children = (d.children)?d.children:d._children;
    if (d._children) {        
        d.children = d._children;
        d._children = null;       
    }
    if(children)
      children.forEach(expand);
}

function expandAll(){
    expand(root); 
    update(root);
}

function collapseAll(){
    root.children.forEach(collapse);
    collapse(root);
    update(root);
}
function collapse(d) {
  if (d.children) {
    d._children = d.children;
    d._children.forEach(collapse);
    d.children = null;
  }
}

                      

</script>
  
</body>
</html>