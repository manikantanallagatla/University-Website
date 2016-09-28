<?php
error_reporting(E_ERROR | E_PARSE);   //while debugging remove this as ll warnings lost!! 
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

<form method="post">
  <select name="coursetoleave">
  <option value="" selected="selected"></option>
    <?php
  $name = $_SESSION["name"];
  $email = $_SESSION["email"];
  $userpassword = $_SESSION["userpassword"];


  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "university1";
  // $designation = $_POST["identity"];
  $mysqli = new mysqli($servername, $username, $password,$dbname);
  if (mysqli_connect_errno()) {
      die("Connection failed: " . mysqli_connect_error());
  }
  $sql_query = "SELECT iid FROM instructor WHERE name = '$name' AND emailid = '$email' limit 1";
  $result = $mysqli->query($sql_query);
  $stud = $result->fetch_assoc();
  $temp_iid = $stud['iid'];

  $sql_query = "SELECT distinct c.cid, c.name FROM course c, instructor i, teach t where i.iid = '".$temp_iid."' and i.iid = t.iid and c.cid = t.cid";
  $result = $mysqli->query($sql_query);
  while ($stud = $result->fetch_assoc()) {
    // <option value="volvo">Volvo</option>
    echo "<option value = '";
    echo $stud['cid'];
    echo "'>";
    echo $stud['name'];
    echo "</option>";
  }
  ?>

  </select>
  <!-- <br> -->
  <input type="submit" value="leave">
</form>

<?php


$coursetoleave1 = $_POST["coursetoleave"];
if($coursetoleave1!=""){
  $sql_query = "DELETE from teach where teach.iid = '".$temp_iid."' and teach.cid = '".$coursetoleave1."'";
  if($mysqli->query($sql_query) === true){
    echo "Succesfully removed!!";
  }else{
    echo "Already removed!!";
  }
  header("Refresh:0");
}
// $file = "code.txt"; 
// $Saved_File = fopen($file, 'w');
// fwrite($Saved_File, $code);
// fclose($Saved_File);

// $file = "testcases.txt"; 
// $Saved_File = fopen($file, 'w');
// fwrite($Saved_File, $testcases);
// fclose($Saved_File);

// $data = array('dummy');

// $pythonScript = "/opt/lampp/htdocs/tryFolder/runme.py $language_no";
// // echo $pythonScript;
// $cmd = array("python", $pythonScript, escapeshellarg(json_encode($data)));
// $cmdText = implode(' ', $cmd);

// // echo "Running command: " . $cmdText . "\n";
// // echo "<br/>";
// $result = shell_exec($cmdText);
// // $arr = json_decode($result);
// $lines = explode("\n", $result);
// if($lines[0] === "[]"){
//   $lines[0] = "[error]";
// }
// echo "Compile message:<br><textarea rows='2' cols='100' name = 'resultbox' style='resize: none;max-height:50px;min-height:50px;'>$lines[0]</textarea><br>";
// 
// Output:
// <br>
// <textarea rows="200" cols="100" name = "testcases" style="resize: none;max-height:150px;min-height:150px;">
// 
// $output_print = $lines[1];
// $output_print = str_replace("[","",$output_print);
// $output_print = str_replace("]","",$output_print);
// $output_print = str_replace("'","",$output_print);

// $token = strtok($output_print, "\\n");

// while ($token !== false)
// {
// echo "$token". "\xA";;
// // echo "<br>";
// $token = strtok("\\n");
// // } 
// }
// echo $output_print;
?>

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
  <?php
  $name = $_SESSION["name"];
  $email = $_SESSION["email"];
  $userpassword = $_SESSION["userpassword"];


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "university1";
    // $designation = $_POST["identity"];
    $mysqli = new mysqli($servername, $username, $password,$dbname);
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>
  var treeData = [
  {
    "name": <?php echo "'$name'";?>,
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
        $sql_query1 = "SELECT distinct c.name as name FROM instructor i, course c, teach t where c.cid = t.cid and t.iid = i.iid and i.name = '".$name."'";
        // echo $sql_query1;
        $result1 = $mysqli->query($sql_query1);
        while ($stud1 = $result1->fetch_assoc()) {
            echo "{";
            echo  "'name' : '";
            echo $stud1['name'];
            echo "' ,";
            echo  "'parent': '";
            echo $name;
            echo "'},";
        }

        // echo "]";
        // echo "},";

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
  // collapseAll(root);
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

