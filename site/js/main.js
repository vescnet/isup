//AJAX communication from theUrl to site
function httpGet(id, theUrl, site, recursion) {
	var xmlHttp = null;

	xmlHttp = new XMLHttpRequest();

	xmlHttp.onreadystatechange=function() {
		if (xmlHttp.readyState==4 && xmlHttp.status==200) {
			var retorno = xmlHttp.responseText; 		
			
			if (retorno) {
				if (document.getElementById(id) != null) {
					document.getElementById(id).style.fill = "greenyellow";	
				} else {
					alert("Error! " + id);
				}
			}
		}
	}

	xmlHttp.open( "GET", theUrl + "?site=" + site, true );

	xmlHttp.send( null );			
}

// Create the Google Map…
var map = new google.maps.Map(d3.select("#map").node(), {
  zoom: 3,
  center: new google.maps.LatLng(2.239945,-51.416016),
  mapTypeId: google.maps.MapTypeId.ROADMAP
});

//var overlay = new google.maps.OverlayView();

// Load the station data. When the data comes back, create an overlay.
d3.json("stations.json", function(data) {
  var overlay = new google.maps.OverlayView();

  // Add the container when the overlay is added to the map.
  overlay.onAdd = function() {
    var layer = d3.select(this.getPanes().overlayLayer).append("div")
        .attr("class", "stations");

    // Draw each marker as a separate SVG element.
    // We could use a single SVG, but what size would it have?
    overlay.draw = function() {
      var projection = this.getProjection(),
          padding = 10;

      var marker = layer.selectAll("svg")
          .data(d3.entries(data))
          .each(transform) // update existing markers
          .enter().append("svg:svg")
          .each(transform)
          .attr("class", "marker");

      // Add a circle.
      marker.append("svg:circle")
          .attr("r", 4.5)
          .attr("cx", padding)
          .attr("cy", padding)
          .attr("id", function(d) { return d.key; });

      // Add a label.
      marker.append("svg:text")
          .attr("x", padding + 7)
          .attr("y", padding)
          .attr("dy", ".31em")
	  .text(function(d) { return d.key; });

      function transform(d) {
        d = new google.maps.LatLng(d.value[1], d.value[0]);
        d = projection.fromLatLngToDivPixel(d);
        return d3.select(this)
            .style("left", (d.x - padding) + "px")
            .style("top", (d.y - padding) + "px");
      }
    };
  };

  // Bind our overlay to the map…
  overlay.setMap(map); 
  
});
