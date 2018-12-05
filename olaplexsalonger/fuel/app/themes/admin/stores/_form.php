<?php echo Form::open(array('id' => 'store-form', 'enctype' => "multipart/form-data")); ?>


<div class='row'>
<div class="col-md-6">

    <!-- general information -->
    <div class="row">
        <div class="col-md-12">
            <div class="widget animated fadeInUp">
                <div class="widget-head">
                    <div class="pull-left"><i class="fa fa-edit"></i> General Information</div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-content padd">
                    <div class="form-group">
                        <label><i class="fa fa-info-circle"></i> Name</label>
                        <?php echo Form::input('name', Input::post('name', isset($model) ? $model->name : ''), array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Store Name')); ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-envelope"></i> Email</label>
                                <?php echo Form::input('email', Input::post('email', isset($model) ? $model->email : ''), array('class' => 'form-control', 'placeholder' => 'example@example.com')); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-globe"></i> Website</label>
                                <?php echo Form::input('website', Input::post('website', isset($model) ? $model->website : ''), array('class' => 'form-control', 'placeholder' => 'domain.com')); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-phone-square"></i> Phone</label>
                                <?php echo Form::input('phone', Input::post('phone', isset($model) ? $model->phone : ''), array('class' => 'form-control', 'placeholder' => '')); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-phone-square"></i> Fax</label>
                                <?php echo Form::input('fax', Input::post('fax', isset($model) ? $model->fax : ''), array('class' => 'form-control', 'placeholder' => '')); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label> Description</label>
                        <?php echo Form::textarea('description', Input::post('description', isset($model) ? $model->description : ''), array('class' => 'form-control', 'placeholder' => '', 'rows' => '5')); ?>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save
                            </button>
                            <div class="loader" style="display: none;"><i class="fa fa-spinner fa-spin"></i>
                                Geocoding...
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /general information -->

    <!-- categories -->
    <div class="row">
        <div class="col-md-12">
            <div class="widget animated fadeInUp">
                <div class="widget-head">
                    <div class="pull-left"><i class="fa fa-edit"></i> Categories & Services</div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-content padd">
                    <div class="form-group">
                        <label><i class="fa fa-tags"></i> Categories</label>

                        <div class="row">
                            <?php foreach (Model_Content::getByKey('categories') as $item): ?>
                                <div class="col-md-4">
                                    <label>
                                        <?php echo Form::checkbox('content[]', $item->id, isset($model) && $model->hasContent($item->id)); ?>
                                        <i class="<?php echo $item->icon ? $item->icon : "fa fa tags"; ?> fa-fw"></i>
                                        <?php echo $item->title; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-tags"></i> Services</label>

                        <div class="row">
                            <?php foreach (Model_Content::getByKey('services') as $item): ?>
                                <div class="col-md-4">
                                    <label>
                                        <?php echo Form::checkbox('content[]', $item->id, isset($model) && $model->hasContent($item->id)); ?>
                                        <i class="<?php echo $item->icon ? $item->icon : "fa fa tags"; ?> fa-fw"></i>
                                        <?php echo $item->title; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save
                            </button>
                            <div class="loader" style="display: none;"><i class="fa fa-spinner fa-spin"></i>
                                Geocoding...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /categories -->

    <!-- social -->
    <div class="row">
        <div class="col-md-12">
            <div class="widget animated fadeInUp">
                <div class="widget-head">
                    <div class="pull-left"><i class="fa fa-edit"></i> Social</div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-content padd">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-twitter-square"></i> Twitter</label>
                                <?php echo Form::input('twitter', Input::post('twitter', isset($model) ? $model->twitter : ''), array('class' => 'form-control', 'placeholder' => 'http://twitter.com/example')); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-youtube-square"></i> Youtube</label>
                                <?php echo Form::input('youtube', Input::post('youtube', isset($model) ? $model->youtube : ''), array('class' => 'form-control', 'placeholder' => 'http://youtube.com/example')); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-google-plus-square"></i> Google+</label>
                                <?php echo Form::input('googleplus', Input::post('googleplus', isset($model) ? $model->googleplus : ''), array('class' => 'form-control', 'placeholder' => 'http://plus.google.com/example')); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-linkedin-square"></i> LinkedIn</label>
                                <?php echo Form::input('linkedin', Input::post('linkedin', isset($model) ? $model->linkedin : ''), array('class' => 'form-control', 'placeholder' => 'http://linkedin.com/example')); ?>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-pinterest-square"></i> Pinterest</label>
                                <?php echo Form::input('pinterest', Input::post('pinterest', isset($model) ? $model->pinterest : ''), array('class' => 'form-control', 'placeholder' => 'http://pinterest.com/example')); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-instagram"></i> Instagram</label>
                                <?php echo Form::input('instagram', Input::post('instagram', isset($model) ? $model->instagram : ''), array('class' => 'form-control', 'placeholder' => 'http://instagram.com/example')); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fa fa-facebook-square"></i> Facebook</label>
                                <?php echo Form::input('facebook', Input::post('facebook', isset($model) ? $model->facebook : ''), array('class' => 'form-control', 'placeholder' => 'http://facebook.com/example')); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save
                            </button>
                            <div class="loader" style="display: none;"><i class="fa fa-spinner fa-spin"></i>
                                Geocoding...
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /social -->

</div>

<div class="col-md-6">

    <!-- location -->
    <div class="row">
        <div class="col-md-12">
            <div class="widget animated fadeInUp">
                <div class="widget-head">
                    <div class="pull-left"><i class="fa fa-edit"></i> Location</div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-content padd">

                    <div class="form-group">
                        <label>Address</label>
                        <?php echo Form::input('address', Input::post('address', isset($model) ? $model->address : ''), array('class' => 'form-control', 'placeholder' => '')); ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City/Province (Admin Area Level 2)</label>
                                <?php echo Form::input('administrative_area_level_2', Input::post('administrative_area_level_2', isset($model) ? $model->administrative_area_level_2 : ''), array('class' => 'form-control', 'placeholder' => '')); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>State/Region (Admin Area Level 1)</label>
                                <?php echo Form::input('administrative_area_level_1', Input::post('administrative_area_level_1', isset($model) ? $model->administrative_area_level_1 : ''), array('class' => 'form-control', 'placeholder' => '')); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Postal Code</label>
                                <?php echo Form::input('postal_code', Input::post('postal_code', isset($model) ? $model->postal_code : ''), array('class' => 'form-control', 'placeholder' => '')); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <?php echo Form::select('country', Input::post('country', isset($model) ? $model->country : Model_Setting::getValueByKey('default_country')), Model_Country::getOptions(), array('class' => 'form-control', 'required' => 'required')); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Latitude</label>
                                <?php echo Form::input('latitude', Input::post('latitude', isset($model) ? $model->latitude : ''), array('class' => 'form-control', 'placeholder' => '')); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Longitude</label>
                                <?php echo Form::input('longitude', Input::post('longitude', isset($model) ? $model->longitude : ''), array('class' => 'form-control', 'placeholder' => '')); ?>
                            </div>
                        </div>
                    </div>

                    <div style="text-align: right">
                        <i class="fa fa-leaf"></i> Leave latitude/longitude values blank to fetch (geocode) on submit.
                    </div>

                    <div class="location-dropdown alert alert-danger" style="display: none;">
                        <i class="fa fa-warning"></i> Multiple map points found based on address. Please select the
                        correct
                        location.
                        <ul></ul>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save
                            </button>
                            <div class="loader" style="display: none;"><i class="fa fa-spinner fa-spin"></i>
                                Geocoding...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /location -->

    <!-- additional -->
    <div class="row">
        <div class="col-md-12">
            <div class="widget animated fadeInUp">
                <div class="widget-head">
                    <div class="pull-left"><i class="fa fa-edit"></i> Hours & Image Upload</div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-content padd">
                    <div class="form-group">
                        <label> Hours</label>
                        <?php echo Form::textarea('hours', Input::post('hours', isset($model) ? $model->hours : ''), array('class' => 'form-control', 'placeholder' => '', 'rows' => '3')); ?>
                    </div>

                    <div class="form-group">
                        <label><i class="fa fa-picture-o"></i> Upload Image</label>
                        <?php echo Form::file('image', array('class' => 'form-control', 'placeholder' => '')); ?>
                        <?php if (isset($model) && $model->image): ?>
                            <img src="<?php echo $model->image; ?>" style="height:50px; width:auto; padding:5px;">
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary submit-btn"><i class="fa fa-save"></i> Save
                            </button>
                            <div class="loader" style="display: none;"><i class="fa fa-spinner fa-spin"></i>
                                Geocoding...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /additional -->


</div>
</div>



<?php echo Form::close(); ?>


<script>
    var PSL = {};
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

    var resultHandler = function (results) {
        alert('good');
        console.log(results);
    };

    var failedHandler = function (status) {
        alert(status);
    }

    $(document).ready(function () {
        $form = $("#store-form");
        $form.on('submit', function (e) {
            $lat = $(this.latitude);
            $lng = $(this.longitude);
            if ($lat.val().trim() == "" || $lng.val().trim() == "") {
                $(".submit-btn").hide();
                $(".loader").show();
                var address = this.address.value + " " + this.administrative_area_level_2.value + " " + this.administrative_area_level_1.value + " " + this.postal_code.value;
                PSL.geocode.fetch({'address': address, region: this.country.value}, function (results) {
                    if (results.length == 1) {
                        $lat.val(results[0].geometry.location.lat());
                        $lng.val(results[0].geometry.location.lng());
                        $form.submit();
                        return;
                    }
                    //otherwise, multiple results found, prompt for correct location
                    for (var i = 0; i < results.length; i++) {
                        var r = results[i];
                        var $li = $("<li><a role='menu-item' data-target='#' style='cursor:pointer;' data-r-index='" + i + "'>" + r.formatted_address + "</a></li>");
                        $(".location-dropdown ul").append($li);
                        $li.find('a').click(function () {
                            if (results[$(this).data('rIndex')]) {
                                var geo = results[$(this).data('rIndex')].geometry;
                                $lat.val(results[0].geometry.location.lat());
                                $lng.val(results[0].geometry.location.lng());
                                $form.submit();
                                return;
                            }
                        });
                    }
                    $(".loader").hide();
                    $(".location-dropdown").show();

                }, function (status) {
                    alert(status);
                });
                return false;
            }
        });
    });
</script>
