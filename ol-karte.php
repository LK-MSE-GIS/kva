<?php

$lon=$_GET["lon"];
$lat=$_GET["lat"];



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html"/>
<title>Kindertagesst&auml;tten im Landkreis Ludwigslust</title>
<meta name="Author" content="Landkreis Ludwigslust">
<meta name="Publisher" content="Landkreis Ludwigslust - Der Landrat">
<meta name="Copyright" content="Landkreis Ludwigslust">
<meta name="Keywords" content="">
<meta name="Description" content="">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="cache-control" content="public">
<meta http-equiv="pragma" content="public">

    <style type="text/css">
        body,td {font-family:Verdana,Helvetica,Arial,Nimbus Sans; font-size:11px; }

       #map {
            width: 700px;
            height: 500px;
            border: 1px solid black;
        }
    </style>


<script src="/OpenLayers/OpenLayers.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/OpenLayers/theme/default/style.css" type="text/css" />
    <script>

        var lon   = <?php echo $lon; ?>;
	var lat   = <?php echo $lat; ?>;
	var zoom  = 5;

    var map, info;

    function load() {
        map = new OpenLayers.Map({
            div: "map",
            projection: "EPSG:2398",
			scales: [20000, 10000, 5000, 2500, 1000, 500],
			maxResolution: "auto",
      		maxExtent:  new OpenLayers.Bounds(<?php echo $lon-10000,",",$lat-10000,",",$lon+10000,",",$lat+10000;?>),
      		units: 'm'
        });
		
		var osm_citymap = new OpenLayers.Layer.WMS.Untiled("OSM Stadtplan",
					 "http://geo.sv.rostock.de/geodienste/stadtplan/wms",
					{'layers': 'stadtplan', transparent: true, format: 'image/png'},
					{isBaseLayer: true}
				);

        var topomv = new OpenLayers.Layer.WMS("Topografie",
            "http://www.gaia-mv.de/dienste/gdimv_topomv",
            {'layers': 'gdimv_topomv', transparent: true, format: 'image/png'},
            {isBaseLayer: true}
        );

         var dop = new OpenLayers.Layer.WMS.Untiled("Luftbild",
		 		            "http://www.gaia-mv.de/dienste/adv_dop",
		 		            {'layers': 'adv_dop', transparent: true, format: 'image/png'},
		 		            {isBaseLayer: true}
        );

        var kitas = new OpenLayers.Layer.WMS.Untiled("Kitas",
		                 "http://geoport.landkreis-mueritz.de/cgi-bin/mapserv?map=/srv/www/wms/ol-mueritz.map&",
		                 {layers: 'Kitas', transparent: true, format: 'image/png'},
		                 {isBaseLayer: false}
        );

        var gemarkungen = new OpenLayers.Layer.WMS.Untiled("Gemarkungen",
		                 "http://geoport.landkreis-mueritz.de/cgi-bin/mapserv?map=/srv/www/wms/ol-mueritz.map&",
		                 {layers: 'Gemarkungen', transparent: true, format: 'image/png'},
		                 {isBaseLayer: false}
        );

        var flurkarte = new OpenLayers.Layer.WMS.Untiled("Flurkarte",
		                 "http://geoport.landkreis-mueritz.de/cgi-bin/mapserv?map=/srv/www/wms/ol/flurkarte.map&",
		                 {layers: 'Flurkarte', transparent: true, format: 'image/png'},
		                 {isBaseLayer: false}
        );


        var flst = new OpenLayers.Layer.WMS.Untiled("Flurstuecke",
		                 "http://geoport.landkreis-mueritz.de/cgi-bin/mapserv?map=/srv/www/wms/ol-mueritz.map&",
		                 {layers: 'Flurstuecke', transparent: true, format: 'image/png'},
		                 {isBaseLayer: false}
        );

        var flur = new OpenLayers.Layer.WMS.Untiled("Fluren",
		                 "http://geoport.landkreis-mueritz.de/cgi-bin/mapserv?map=/srv/www/wms/ol-mueritz.map&",
		                 {layers: 'Fluren', transparent: true, format: 'image/png'},
		                 {isBaseLayer: false}
        );

        var haus = new OpenLayers.Layer.WMS.Untiled("Gebaeude",
		                 "http://geoport.landkreis-mueritz.de/cgi-bin/mapserv?map=/srv/www/wms/ol-mueritz.map&",
		                 {layers: 'Gebaeude', transparent: true, format: 'image/png'},
		                 {isBaseLayer: false}
        );





        var highlight = new OpenLayers.Layer.Vector("Highlighted Features", {
            displayInLayerSwitcher: false,
            isBaseLayer: false
        });



        map.addLayers([osm_citymap,dop,flur,flst,haus]);

        info = new OpenLayers.Control.WMSGetFeatureInfo({
            url: 'http://geoport.landkreis-mueritz.de/cgi-bin/mapserv?map=/srv/www/wms/ol-mueritz.map',
            title: 'Identify features by clicking',
            queryVisible: true,
            eventListeners: {
                getfeatureinfo: function(event) {
                    map.addPopup(new OpenLayers.Popup.FramedCloud(
                        "chicken",
                        map.getLonLatFromPixel(event.xy),
                        null,
                        event.text,
                        null,
                        true
                    ));
                }
            }
        });
        map.addControl(info);
        info.activate();

        map.addControl(new OpenLayers.Control.LayerSwitcher());
		map.addControl(new OpenLayers.Control.Permalink());
		var lonLat = new OpenLayers.LonLat(lon, lat).transform(new OpenLayers.Projection("EPSG:2398"), map.getProjectionObject());
		map.setCenter(lonLat, 5);
    }

  </script>
</head>

<body onload="load();">
	<table width="800" border="0" cellpadding="0" align="center" cellspacing="0">
       <tr>
          <td width="800" height="600" border=0>
	         <div style="margin:1px" id="map"></div> &nbsp;&copy; Landkreis M&uuml;ritz&nbsp;| &nbsp;Kartendaten: &copy; LAIV-MV
          </td>
       </tr>
    </table>
</body>
</html>