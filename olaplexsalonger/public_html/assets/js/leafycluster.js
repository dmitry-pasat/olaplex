(function(){
    "use strict";

     L.Cluster = L.FeatureGroup.extend({
        features: [],//[[lat,lng,opt,..]]
        markers: [],
        active: false,

        initialize: function(opts){
            L.FeatureGroup.prototype.initialize.apply(this, arguments);
            for(var i in opts.features){
                this.features.push(L.latLng(opts.features[i][0],opts.features[i][1]));
            }
        },

        inRange: function(c, f, map) {

            var distance = Math.sqrt( Math.pow((c.lng - f.lng), 2) + Math.pow((c.lat - f.lat), 2) / this.aRes );
            return (distance <= this.distance);
        },

        createCluster: function(features){
            return {
                features: features,
                bounds: null,
                getBounds: function(){
                    if(!this.bounds) this.bounds = L.latLngBounds(this.features);
                    return this.bounds;
                },
                add: function(feature){
                    this.features.push(feature);
                },
                getSize: function(){
                    return this.features.length;
                },
                getCenter: function(){
                    //this.bounds = null;
                    return this.getBounds().getCenter();
                }
            }
        },

        handleChange: function(evt){
            for(var i in this.markers){
                evt.target.removeLayer(this.markers[i]);
            }
            this.onAdd(evt.target);
        },

        shouldCluster: function(cc, fc) {
            var distance = Math.sqrt( Math.pow((cc.lng - fc.lng), 2) + Math.pow((cc.lat - fc.lat), 2) );
            return false;
            switch(this.zoom){
                case 0:case 1:case 2: return (distance <= 10);
                case 3: return (distance <= 5);
                case 4: return (distance <= 3);
                case 5: return (distance <= 1.1);
                case 6: return (distance <= 0.5);
                case 7: return (distance <= 0.25);
                case 8: case 9:case 10: return (distance <= 0.15);
                case 11: (distance <= 0.001);
                default: return false;
            }

        },

        onAdd: function(map){

            var bounds = map.getBounds();
            this.zoom = map.getZoom();
            console.log(this.zoom);

            var exp = Math.pow(Math.E,(-1*this.zoom)) * 100;
            console.log(exp);

            var features = [];
            for(var i=0; i<this.features.length; i++){
                if(!this.features[i]) continue;
                var f = this.features[i];
                //saves ~80ms per 10k over bounds.intersect w/ latlngbounds([f])
                if(f.lat > bounds.getSouthWest().lat && f.lat < bounds.getNorthEast().lat && f.lng > bounds.getSouthWest().lng && f.lng < bounds.getNorthEast().lng){
                    features.push(f);
                }

            }

            var clusters = [];
            for(var i=0; i<features.length; i++){
                //if(i>100) break;
                var feature = features[i];
                var clustered = false;
                for(var j=clusters.length-1; j>=0; --j){
                    var cluster = clusters[j];
                    if(this.shouldCluster(cluster.getBounds().getCenter(), feature)) {
                        cluster.add(feature);
                        clustered = true;
                        break;
                    }
                }
                if(!clustered) {
                    clusters.push(this.createCluster([features[i]]));
                }
            }

            console.log('total clusters: ' + clusters.length);

            this.markers = [];
            for(var i in clusters){
                this.markers.push(L.marker(clusters[i].getCenter(), {icon: L.divIcon({
                    className: 'cluster cluster-' + (clusters[i].getSize() < 10 ? 'small' : clusters[i].getSize() < 100 ? 'medium' : 'large'),
                    html: "<div><span>" + clusters[i].getSize() + "</span></div>",
                    iconSize: L.point(40,40)
                })}).addTo(map));
            }

            if(!this.active){
                map.on('moveend', this.handleChange, this);
                this.active = true;
            }
        }
    });


})();