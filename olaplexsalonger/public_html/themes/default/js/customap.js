$(document).ready(function(){
    // Create a map and add OSM raster layer as the base layer
    var map1 = new OpenLayers.Map("map1");
    var osm1 = new OpenLayers.Layer.OSM();
    map1.addLayer(osm1);

    // Initial view location
    var center = new OpenLayers.LonLat(2, 40);
    center.transform(new OpenLayers.Projection("EPSG:4326"), new OpenLayers.Projection("EPSG:900913"));
    map1.setCenter(center, 2);
    // Add a LayerSwitcher control
    map1.addControl(new OpenLayers.Control.LayerSwitcher());

    // Define three colors that will be used to style the cluster features
    // depending on the number of features they contain.
    var colors = {
        low: "rgb(181, 226, 140)",
        middle: "rgb(241, 211, 87)",
        high: "rgb(253, 156, 115)"
    };

    // Define three rules to style the cluster features.
    var lowRule = new OpenLayers.Rule({
        filter: new OpenLayers.Filter.Comparison({
            type: OpenLayers.Filter.Comparison.LESS_THAN,
            property: "count",
            value: 15
        }),
        symbolizer: {
            fillColor: colors.low,
            fillOpacity: 0.9,
            strokeColor: colors.low,
            strokeOpacity: 0.5,
            strokeWidth: 12,
            pointRadius: 10,
            label: "${count}",
            labelOutlineWidth: 1,
            fontColor: "#ffffff",
            fontOpacity: 0.8,
            fontSize: "12px"
        }
    });
    var middleRule = new OpenLayers.Rule({
        filter: new OpenLayers.Filter.Comparison({
            type: OpenLayers.Filter.Comparison.BETWEEN,
            property: "count",
            lowerBoundary: 15,
            upperBoundary: 50
        }),
        symbolizer: {
            fillColor: colors.middle,
            fillOpacity: 0.9,
            strokeColor: colors.middle,
            strokeOpacity: 0.5,
            strokeWidth: 12,
            pointRadius: 15,
            label: "${count}",
            labelOutlineWidth: 1,
            fontColor: "#ffffff",
            fontOpacity: 0.8,
            fontSize: "12px"
        }
    });
    var highRule = new OpenLayers.Rule({
        filter: new OpenLayers.Filter.Comparison({
            type: OpenLayers.Filter.Comparison.GREATER_THAN,
            property: "count",
            value: 50
        }),
        symbolizer: {
            fillColor: colors.high,
            fillOpacity: 0.9,
            strokeColor: colors.high,
            strokeOpacity: 0.5,
            strokeWidth: 12,
            pointRadius: 20,
            label: "${count}",
            labelOutlineWidth: 1,
            fontColor: "#ffffff",
            fontOpacity: 0.8,
            fontSize: "12px"
        }
    });

    // Create a Style that uses the three previous rules
    var style = new OpenLayers.Style(null, {
        rules: [lowRule, middleRule, highRule]
    });

    // Create a vector layers
    var vector1 = new OpenLayers.Layer.Vector("Features", {
        protocol: new OpenLayers.Protocol.HTTP({
            url: "world_cities.json",
            format: new OpenLayers.Format.GeoJSON()
        }),
        renderers: ['Canvas','SVG'],
        strategies: [
            new OpenLayers.Strategy.Fixed(),
            new OpenLayers.Strategy.AnimatedCluster({
                distance: 45,
                animationMethod: OpenLayers.Easing.Expo.easeOut,
                animationDuration: 10
            })
        ],
        styleMap:  new OpenLayers.StyleMap(style)
    });


    // Create a vector layers
    var vector = new OpenLayers.Layer.Vector("Features", {
        renderers: ['Canvas','SVG'],
        strategies: [
            new OpenLayers.Strategy.AnimatedCluster({
                distance: 45,
                animationMethod: OpenLayers.Easing.Expo.easeOut,
                animationDuration: 20
            })
        ],
        styleMap:  new OpenLayers.StyleMap(style)
    });
    map1.addLayer(vector);

// Create some random features
    var features = [];
    for(var i=0; i< 2500; i++) {
        var lon = Math.random() * 2 + -4;
        var lat = Math.random() * 2 + 40;

        var lonlat = new OpenLayers.LonLat(lon, lat);
        lonlat.transform(new OpenLayers.Projection("EPSG:4326"), new OpenLayers.Projection("EPSG:900913"));

        var f = new OpenLayers.Feature.Vector( new OpenLayers.Geometry.Point(lonlat.lon, lonlat.lat));
        features.push(f);
    }
    vector.addFeatures(features);
})