/**
 * PSL (locator.js) Component
 * @copyright 2013+ Rapid Digital LLC, PHP Store Locator Script
 * @license see license.html in root directory, all rights reserved
 */
(function () {
    "use strict";

    var PSL = function () {
    };

    PSL.$form = $("#loc-form");
    PSL.$filterForm = $("#cat-form");

    PSL.$fields = {
        location: $("#form_location"),
        latitude: $("#form_latitude"),
        longitude: $("#form_longitude"),
        country: $("#form_iso2")
    }

    PSL.$c = {
        resultSet: $('.loc-result-set'),
        resultOpts: $('.result-options'),
        backBtn: $('.result-options .back-btn'),
        forwardBtn: $('.result-options .forward-btn'),
        filterBtn: $('.result-options .filter-btn'),
       /* detailTemplate: $('.loc-store-detail-template'),*/
        resultSetContainer: $('.result-set-container')
    }

    PSL.settings = {
        api: 'index.php/api/search/'
    }

    PSL.geocode = {
        geocoder: new google.maps.Geocoder(),
        fetch: function (params, resultHandler, failedHandler) {
            PSL.geocode.geocoder.geocode(params, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    resultHandler(results);
                    return;
                }
                failedHandler(status);
            });
        },
        getAddressComponent: function (r, name) {
            for (var i in r.address_components) {
                var c = r.address_components[i];
                for (var j in c.types) {
                    if (c.types[j].toLowerCase() == name) {
                        return c;
                    }
                }
            }
            return null;
        }
    }

    PSL.hideMapLayers = function () {
        for (var i in PSL.ol.layerNames) {
            PSL.ol.layers[i].setVisible(false);
        }
    }

    PSL.createMap = function (opts) {
        PSL.l = {
            opts: opts,
            map: L.map('map1').setView([opts.map_center.lat, opts.map_center.lng], opts.map_center.zoom, {animate: true}),
            layers: [],
            clearLayers: function () {
                for (var i in PSL.l.layers) {
                    PSL.l.layers[i].clearLayers();
                    PSL.l.map.removeLayer(PSL.l.layers[i]);
                }
                PSL.l.layers = [];
            }
        };

        //if(!opts.cloudmade_api_key) return PSL.handleMissingComponent('Website administrator, please set CloudMake API Key in administration panel.');
        L.tileLayer('//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy;<a href="http://openstreetmap.org">OpenStreetMap</a> contributors, &copy;<a href="https://storelocatorscript.com" title="Store Finder App by Store Locator Script">PSL</a>',
            maxZoom: 18
        }).addTo(PSL.l.map);
        L.control.scale().addTo(PSL.l.map);

    }

    PSL.handleFailedRequest = function () {
        $(".failed-server-alert").removeClass('hide');
    }

    PSL.handleMissingComponent = function (message) {
        //if(console) console.log(message);
        var alert = $(".general-alert").clone().removeClass('hide');
        $(alert).find('.message').html(message);
        $('.main-body').prepend(alert);
    }

    PSL.configurePaging = function (data) {
        PSL.$c.backBtn.prop('disabled', false);
        PSL.$c.forwardBtn.prop('disabled', false);

        if (data.pagination.current_page <= 1) {
            PSL.$c.backBtn.prop('disabled', true);
        } else {
            PSL.$c.backBtn.click(function () {
                PSL.lastParams.page = Number(data.pagination.current_page) - 1;
                var qString = "?";
                var count = 0;
                for (var i in PSL.lastParams) {
                    qString += (count > 0 ? "&" : "") + i + "=" + PSL.lastParams[i];
                    count++;
                }
                $.address.value(qString);
            });
        }

        if (data.pagination.total_pages <= data.pagination.current_page) {
            PSL.$c.forwardBtn.prop('disabled', true);
        } else {
            PSL.$c.forwardBtn.click(function () {
                PSL.lastParams.page = Number(data.pagination.current_page) + 1;
                var qString = "?";
                var count = 0;
                for (var i in PSL.lastParams) {
                    qString += (count > 0 ? "&" : "") + i + "=" + PSL.lastParams[i];
                    count++;
                }
                $.address.value(qString);
            });
        }
    }

    PSL.handleFetch = function (data) {
        if (data.pagination.total_items == 0) {
            PSL.$c.resultOpts.find('.total_items').html(data.pagination.total_items);
            PSL.$c.resultSet.find('.default-item').hide().end().find('.no-results-item').removeClass('hide');
            PSL.l.map.setView(L.latLng(PSL.$fields.latitude.val(), PSL.$fields.longitude.val()), 12, {animate: true});
            return;
        }
        PSL.$c.resultSet.find('.default-item').hide();

        PSL.stores = data.stores;
        PSL.data = data;

        var group = L.featureGroup();
        for (var i in data.stores) {
            var $t = PSL.$c.resultSet.find('.template-item').clone().removeClass('hide').removeClass('template-item').addClass('result-item');
            $t.attr('store-id', data.stores[i]['id']).data('storeIndex', i).attr('id', 'ri' + i).hide();
            for (var j in data.stores[i]) {
                if (!data.stores[i][j]) data.stores[i][j] = "";
                if (j == 'distance') data.stores[i][j] = Number(data.stores[i][j]).toFixed(1);
                $t.html($t.html().replace(new RegExp('{' + j + '}', 'g'), data.stores[i][j]));
                if (!data.stores[i][j]) {
                    $t.find('.' + j).remove();
                }
            }

            var link = $.param({
                store: data.stores[i]['id'],
                latitude: data.stores[i]['latitude'],
                longitude: data.stores[i]['longitude'],
                iso2: data.stores[i]['country'],
                location: decodeURIComponent(PSL.lastParams.location.replace(/\+/g, '%20'))
            });

            PSL.$c.resultSet.append($t);
            $t.fadeIn();


            $t.find('.btn-detail').attr('href', "#?" + link);
            var popupHtml = $($t.clone().find('.skip-popup').remove().end().html()).attr('id', i).get(0);

            var marker = L.marker([data.stores[i]['latitude'], data.stores[i]['longitude']], {
                title: data.stores[i].name,
                alt: data.stores[i].name,
                riseOnHover: true
            }).bindPopup(popupHtml).on('popupopen', function (evt) {
                PSL.$c.resultSet.find('.result-item').removeClass('highlight');
                $('#ri' + $(evt.popup.getContent()).attr('id')).addClass('highlight');
            });
            group.addLayer(marker);

            $t.click(function (evt) {
                PSL.$c.resultSet.find('.result-item').removeClass('highlight');
                $(this).addClass('highlight');
                var marker = group.getLayers()[$(this).data('storeIndex')];
                PSL.l.map.panTo(marker.getLatLng());
                marker.openPopup();
            });


            $t.find('.btn-detail').data('storeIndex', i).click(function () {
                var store = PSL.stores[$(this).data('storeIndex')];
                document.title = store.name + " - " + store.address;
                var marker = group.getLayers()[$(this).data('storeIndex')];
                PSL.l.map.panTo(marker.getLatLng());
                marker.openPopup();

                var $t = PSL.$c.detailTemplate.clone().removeClass('hide').addClass('store-detail');
                for (var j in store) {
                    if (!store[j]) store[j] = "";
                    if (j == 'distance') store[j] = Number(store[j]).toFixed(1);
                    if (j == 'hours' || j == 'description') store[j] = store[j].replace(/\n/g, '<br />');
                    if (store[j].length > 0 && (j == 'categories' || j == 'services')) store[j] = store[j].join('');
                    $t.html($t.html().replace(new RegExp('{' + j + '}', 'g'), store[j]));
                    if (!store[j]) {
                        $t.find('.' + j).remove();
                    }
                }

                PSL.$c.resultOpts.hide();
                PSL.$c.resultSet.hide();
                PSL.$c.resultSetContainer.append($t);

                $t.find('.direction-links a').each(function () {
                    //$(this).attr('href',$(this).attr('href') + store['latitude'] + "," + store['longitude']);
                    $(this).attr('href', $(this).attr('href') + store['address'] + ", " + store['administrative_area_level_2'] + " " + store['administrative_area_level_1'] + " " + store['postal_code'] + " " + store['country']);
                });

                var link = $.param({
                    store: store['id'],
                    latitude: store['latitude'],
                    longitude: store['longitude'],
                    iso2: store['country'],
                    location: decodeURIComponent(PSL.lastParams.location.replace(/\+/g, '%20'))
                });
                $t.find('.link-btn').attr('href', "#?" + link);
                $t.find('.addthis_button').attr('id', 'share-btn-' + store.id);
                addthis.button('#share-btn-' + store.id, {}, {
                    url: link,
                    title: document.title
                });


                $t.find('.close-btn').click(function () {
                    document.title = "Find a Store";
                    $t.remove();
                    PSL.$c.resultOpts.fadeIn();
                    PSL.$c.resultSet.fadeIn();
                });
                return false;
            });

        }

        PSL.l.layers.push(group.addTo(PSL.l.map));
        PSL.l.map.fitBounds(group.getBounds(), {paddingTopLeft: [10, 10]});
        PSL.$c.resultOpts.find('.total_items').html(data.pagination.total_items);
        PSL.$c.resultOpts.find('.distance').html(data.max_distance + " " + data.stores[0]['metric']);
        PSL.configurePaging(data);
        PSL.$c.resultOpts.fadeIn();

        if (PSL.lastParams.store) {
            $(".result-item[store-id='" + PSL.lastParams.store + "'] .btn-detail:first").trigger('click');
        }

    }

    PSL.displayUSAStates = function () {
        var params = {};
        params[ptk] = $.cookie(ptk);
        $.post(PSL.settings.api + "us_states", params,function (data) {
            PSL.l.us_state_geo = { type: "FeatureCollection", features: [] };
            while (data.states.length) {
                var state = data.states.pop();
                for (var i in GeoUSAStates.features) {
                    if (GeoUSAStates.features[i].properties.name.toLowerCase() == state.name.toLowerCase()) {
                        GeoUSAStates.features[i].properties.short_name = state.short_name;
                        PSL.l.us_state_geo.features.push(GeoUSAStates.features[i]);
                    }
                }
            }
            //console.log(PSL.l.us_state_geo);
            PSL.l.layers.push(L.geoJson(PSL.l.us_state_geo, {
                onEachFeature: PSL.onEachUSAStateFeature,
                style: {
                    'color': PSL.l.opts.map_poli_color.default,
                    'weight': 2
                }
            }).addTo(PSL.l.map));
        }, 'json').fail(PSL.handleFailedRequest);
    }


    PSL.onEachFeature = function (feature, layer) {
        layer.on('mouseover', function () {
            layer.setStyle({ 'color': PSL.l.opts.map_poli_color.hover  })
        });
        layer.on('mouseout', function () {
            layer.setStyle({ 'color': PSL.l.opts.map_poli_color.default  })
        });
        layer.on('click', function (evt) {
            if (feature.properties.name && feature.properties.name != 'Alaska') {
                PSL.l.map.fitBounds(layer.getBounds());
            }
            ;
        });
    }

    PSL.plotCluster = function (data) {
        var markers = L.markerClusterGroup();
        var markerList = [];
        for (var i in data.stores) {
            var marker = L.marker(L.latLng(data.stores[i].latitude, data.stores[i].longitude));
            marker.bindPopup(data.stores[i].id);
            markerList.push(marker);
            marker.on('popupopen', function (evt) {
                var params = { id: evt.popup.getContent() };
                params[ptk] = $.cookie(ptk);
                evt.popup.setContent('<div align="center"><i class="fa fa-spinner fa-spin"></i></div>');
                $.post(PSL.settings.api + "store", params,function (store) {
                    var $t = PSL.$c.resultSet.find('.template-item').clone().removeClass('hide').removeClass('template-item').addClass('result-item');
                    for (var j in store) {
                        if (!store[j]) store[j] = "";
                        if (j == 'distance') store[j] = Number(store[j]).toFixed(1);
                        $t.html($t.html().replace(new RegExp('{' + j + '}', 'g'), store[j]));
                        if(!store[j]) $t.find('.'+j).remove();
                    }
                    $t.find('.skip-popup').remove();

                    var link = $.param({
                        store: store['id'],
                        latitude: store['latitude'],
                        longitude: store['longitude'],
                        iso2: store['country'],
                        location: store['administrative_area_level_2'] + " " + store['administrative_area_level_1']
                    });
                    $t.find('.btn-detail').attr('href', "#?" + link);
                    var popupHtml = $($t.clone().find('.skip-popup:first').remove().end().html()).attr('id', i).get(0);

                    evt.popup.setContent(popupHtml);


                }, 'json').fail(PSL.handleFailedRequest);


            });
        }
        markers.addLayers(markerList);
        PSL.l.layers.push(markers);
        PSL.l.map.addLayer(markers);
    }

    PSL.onEachUSAStateFeature = function (feature, layer) {
        PSL.onEachFeature(feature, layer);
        layer.on('click', function (evt) {
            PSL.l.map.removeLayer(layer);
            var params = {administrative_area_level_1: feature.properties.short_name, country: 'US'};
            params[ptk] = $.cookie(ptk);
            $.post(PSL.settings.api + "map_data", params, PSL.plotCluster, 'json').fail(PSL.handleFailedRequest);
        });
    }

    PSL.onEachCountryFeature = function (feature, layer) {
        layer.on('mouseover', function () {
            layer.setStyle({ 'color': PSL.l.opts.map_poli_color.hover  })
        });
        layer.on('mouseout', function () {
            layer.setStyle({ 'color': PSL.l.opts.map_poli_color.default  })
        });
        layer.on('click', function (evt) {
            PSL.l.map.removeLayer(layer);
            //console.log(layer);
            if (PSL.l.map.getZoom() < 3) {
                PSL.l.map.setView(layer.getBounds().getCenter(), 3);
            } else {
                PSL.l.map.setView(evt.latlng);
            }
        });
        switch (feature.id) {
            case "USA": //load state geo
                layer.on('click', PSL.displayUSAStates);
                break;
            default: //load marker data
                layer.on('click', function (evt) {
                    var params = {country: feature.properties.iso2};
                    params[ptk] = $.cookie(ptk);
                    $.post(PSL.settings.api + "map_data", params,function (data) {
                        setTimeout(function () {
                            PSL.plotCluster(data);
                        }, 100);
                    }, 'json').fail(PSL.handleFailedRequest);
                });
        }
    }

    PSL.handleCountryData = function (data) {
        if (!PSL.l) return setTimeout(function () {
            PSL.handleCountryData(data);
        }, 500);
        if (PSL.l) PSL.l.clearLayers();
        PSL.l.map.setView([PSL.l.opts.map_center.lat, PSL.l.opts.map_center.lng], PSL.l.opts.map_center.zoom, {animate: true});
        PSL.l.geo = PSL.l.geo ? PSL.l.geo : { type: "FeatureCollection", features: [] };
        if (PSL.l.geo.features.length == 0) {
            while (data.countries.length) {
                var country = data.countries.pop();
                for (var i in GeoCountries.features) {
                    if (GeoCountries.features[i].id == country.iso3) {
                        GeoCountries.features[i].properties = country;
                        PSL.l.geo.features.push(GeoCountries.features[i]);
                    }
                }
            }
        }

        PSL.l.layers.push(L.geoJson(PSL.l.geo, {
            onEachFeature: PSL.onEachCountryFeature,
            style: {
                'color': PSL.l.opts.map_poli_color.default,
                'weight': 2
            }
        }).addTo(PSL.l.map));

    }

    PSL.handleCurrentLocationRequest = function () {
        var btn = this;
        $(".search-btn").hide();
        PSL.$fields.location.hide();
        $(btn).prop('disabled', true).find('i').addClass('fa-spin').end().find('span').fadeIn().end().attr('style', 'border:0px; width:100%');

        var showSearchInput = function () {
            $(btn).prop('disabled', false).find('i').removeClass('fa-spin').end().find('span').hide().end().attr('style', '');
            $(".search-btn").show();
            PSL.$fields.location.fadeIn();
        }

        var handleLocationError = function () {
            showSearchInput();
            $(".main-body").prepend($(".general-alert").removeClass('hide').show().html("<b>Sorry,</b> wasn't able to obtain your current location. Please try entering your location below."));
            setTimeout(function () {
                $(".general-alert").fadeOut();
            }, 5000);
        }

        PSL.l.map.on('locationfound', function (evt) {
            PSL.geocode.fetch({'latLng': new google.maps.LatLng(evt.latitude, evt.longitude)}, function (results) {
                PSL.l.clearLayers();
                PSL.$fields.location.val(results[1].formatted_address);
                PSL.$fields.latitude.val(evt.latitude);
                PSL.$fields.longitude.val(evt.longitude);
                //set iso2
                PSL.$fields.country.val(PSL.geocode.getAddressComponent(results[1], 'country').short_name);
                $.address.value("?" + PSL.$form.serialize());
                showSearchInput();
            }, function (status) {
                handleLocationError();
                showSearchInput();
            });
        });

        PSL.l.map.on('locationerror', handleLocationError);
        PSL.l.map.locate({enableHighAccuracy: true, setView: true});
    }

    PSL.fetch = function (evt) {
        if (PSL.l) PSL.l.clearLayers();

        var params = PSL.lastParams = evt.parameters;
        PSL.queryString = evt.queryString;

        params[ptk] = $.cookie(ptk);
        for (var i in PSL.$fields) {
            PSL.$fields[i].val("");
        }
        //set filter cats on modal
        var cats = decodeURIComponent(params['cats']).split(',');
        for (var i in cats) {
            $("#form_c_" + cats[i]).prop('checked', true);
        }


        PSL.$c.resultSet.find('> div:not(.default-item,.no-results-item,.template-item)').remove();
        PSL.$c.resultSet.find('.no-results-item').addClass('hide');

        $(".store-detail").remove();
        PSL.$c.resultOpts.show();
        PSL.$c.resultSet.show();

        PSL.$c.backBtn.unbind('click');
        PSL.$c.forwardBtn.unbind('click');

        if (!params.location || !params.latitude || !params.longitude) {
            PSL.$c.resultSet.find('.default-item').show();
            PSL.$c.resultOpts.hide();
            $.post(PSL.settings.api + "countries", params, PSL.handleCountryData, 'json').fail(PSL.handleFailedRequest);
            return;
        }

        PSL.$fields.location.val(decodeURIComponent(params.location.replace(/\+/g, '%20')));
        PSL.$fields.latitude.val(params.latitude);
        PSL.$fields.longitude.val(params.longitude);
        if (params.country) PSL.$fields.country.val(params.country);
        $.post(PSL.settings.api, params, PSL.handleFetch, 'json').fail(PSL.handleFailedRequest);
    }

    PSL.handleFormSubmit = function (evt) {
        evt.preventDefault();
        PSL.l.clearLayers();
        PSL.$fields.location.tooltip('destroy');

        //reset filters if new location query
        if (PSL.$form.find('#cat-filters').data('q') && PSL.$form.find('#cat-filters').data('q') != PSL.$fields.location.val()) {
            alert(PSL.$form.find('#cat-filters').data('q'));
            alert('hi');
            PSL.$form.find('#form_cats').val("");
            PSL.$filterForm.get(0).reset();
        }

        PSL.geocode.fetch({address: PSL.$fields.location.val(), region: PSL.$fields.country.val()}, function (results) {
            var handleResults = function (r) {
                PSL.$fields.location.tooltip('destroy');
                PSL.$fields.location.val(r.formatted_address);
                PSL.$fields.latitude.val(r.geometry.location.lat());
                PSL.$fields.longitude.val(r.geometry.location.lng());
                PSL.$fields.country.val(PSL.geocode.getAddressComponent(r, 'country').short_name);
                $.address.value("?" + PSL.$form.serialize());
            }

            if (results.length == 1) {
                handleResults(results.pop());
                return;
            }

            $(".location-dropdown ul").html("");
            for (var i in results) {
                var r = results[i];
                var $li = $("<li><a role='menu-item' data-target='#' style='cursor:pointer;' data-r-index='" + i + "'>" + r.formatted_address + "</a></li>");
                $(".location-dropdown ul").append($li);
                $li.find('a').click(function () {
                    if (results[$(this).data('rIndex')]) {
                        handleResults(results[$(this).data('rIndex')]);
                    }
                });
            }
            $(".location-dropdown .dropdown-toggle").trigger('click');//dropdown('toggle');

            PSL.$fields.location.tooltip({
                placement: 'top',
                title: 'Please select a location below.',
                trigger: 'manual'
            }).tooltip('show');
        }, function (status) {
            //console.log(status);
        });
        return false;
    }

    PSL.registerEventListeners = function () {
        $.address.change(PSL.fetch);
        $(".loc-btn").on('click', PSL.handleCurrentLocationRequest);
        PSL.$form.submit(PSL.handleFormSubmit);
        PSL.$filterForm.submit(function (e) {
            e.preventDefault();
            $('#filter-modal').modal('hide');
            var cats = [];
            $(this).find('input:checked').clone().each(function () {
                cats.push($(this).val());
            });
            PSL.$form.find('input[name="cats"]').val(cats.join(','));
            PSL.$form.find('#cat-filters').data('q', PSL.$fields.location.val());
            PSL.$form.submit();
        });
    }

    PSL.init = function () {
        PSL.registerEventListeners();
        $.getJSON(PSL.settings.api + 'map_settings',function (settings) {
            PSL.createMap(settings);
        }).fail(PSL.handleFailedRequest);
    }

    PSL.init();

})();