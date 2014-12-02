# treeNetwork
library(devtools)
install_github(c('rstudio/htmltools',
                 'ramnathv/htmlwidgets',
                 'christophergandrud/networkD3'))





#packages installed
install.packages("rjson")
install.packages("whisker")
library(whisker)

url <- 'all-songs-clustering-single.json'
clusters <- getURL(url)
library(rjson)
clusters <- fromJSON(file="dendo.json")
d3Tree(List = clusters, 
                file = "dendogram.html", fontsize = 20, opacity = 0.9, diameter = 5000, 
                width = 15000, height = 15000,  zoom = FALSE)

url = "dendo.json"
readChar(url, file.info(url)$size) -> a
d3Tree(a, file_out = "dendo.html", text = 10, height = 1500, width = 2000)

D3Dendo<-function(JSON, text=15, height=800, width=700, file_out){
  
  header<-paste0("<!DOCTYPE html>
                 <meta charset=\"utf-8\">
                 <style>

                 .node circle {
                 fill: #fff;
                 stroke: steelblue;
                 stroke-width: 1.5px;
                 }
                 
                 .node {
                 font: ",text , "px sans-serif;
                 }
                 
                 .link {
                 fill: none;
                 stroke: #ccc;
                 stroke-width: 1.5px;
                 }
                 
                 </style>
                 <body>
                 <script src=\"http://d3js.org/d3.v3.min.js\"></script>
                 
                 <script type=\"application/json\" id=\"data\">")
  
  
  footer<-paste0("</script>
                 
                 
                 
                 
                 <script>
                 
                 var data = document.getElementById('data').innerHTML;
                 root = JSON.parse(data);
                 
                 var width = ", width, ",
                 height = ", height, ";
                 
                 var cluster = d3.layout.cluster()
                 .size([height-50, width - 160]);
                 
                 var diagonal = d3.svg.diagonal()
                 .projection(function(d) { return [d.y, d.x]; });
                 
                 var svg = d3.select(\"body\").append(\"svg\")
                 .attr(\"width\", width)
                 .attr(\"height\", height)
                 .append(\"g\")
                 .attr(\"transform\", \"translate(40,0)\");
                 
                  var force = d3.layout.force()
                  .charge(-120)
                  .linkDistance(30)
                  .size([width, height]);
                                   
                 var nodes = cluster.nodes(root),
                 links = cluster.links(nodes);

                 var link = svg.selectAll(\".link\")
                 .data(links)
                 .enter().append(\"path\")
                 .attr(\"class\", \"link\")
                 .attr(\"d\", diagonal);

                  document.write(link)
                 
                 var node = svg.selectAll(\".node\")
                 .data(nodes)
                 .enter().append(\"g\")
                 .attr(\"class\", \"node\")
                .attr(\"transform\", function(d) 
                  { return \"translate(\" + d.y + \",\" + d.x + \")\"; })

                  .on(\"mouseover\", function(d)
                   {
                       d3.select(labels[0][d.index]).style(\"visibility\",\"visible\")
                   })
                  .on(\"mouseout\", function(d)
                   {
                       d3.select(labels[0][d.index]).style(\"visibility\",\"hidden\")
                   })
                  .call(force.drag);
  
  node.append(\"circle\")
  .attr(\"r\", 4.5);
  
  node.append(\"text\")
  .attr(\"dx\", function(d) { return d.children ? 8 : 8; })
  .attr(\"dy\", function(d) { return d.children ? 20 : 4; })
  .style(\"text-anchor\", function(d) { return d.children ? \"end\" : \"start\"; })
  .text(function(d) { return d.name; });

force.on(\"tick\", function() {
 link.attr(\"x1\", function(d) { return d.source.x; })
    .attr(\"y1\", function(d) { return d.source.y; })
    .attr(\"x2\", function(d) { return d.target.x; })
    .attr(\"y2\", function(d) { return d.target.y; });

 nodes.attr(\"transform\", function(d) { 
    return 'translate(' + [d.x, d.y] + ')'; 
}); 
});
  
  </script>") 
  
  fileConn<-file(file_out)
  writeLines(paste0(header, JSON, footer), fileConn)
  close(fileConn)
  
}
