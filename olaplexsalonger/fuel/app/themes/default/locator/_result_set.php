<div class="result-options" style="padding:5px 10px; display: none; overflow: auto;">
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-default back-btn"><i class="fa fa-angle-double-left"></i></button>
        <button type="button" class="btn btn-sm btn-default forward-btn"><i class="fa fa-angle-double-right"></i> </button>
        <?php if(count($categories) || count($services)): ?>
            <button style="display: none;" type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#filter-modal"><i class="fa fa-filter"></i> Filter  </button>
        <?php endif; ?>
        <div class="pull-right text-muted btn-sm"><span class="total_items"></span><!-- results in  --> resultat inom <span
                class="distance"></span></div>
    </div>

</div>

<div class="list-group loc-result-set " style="margin-bottom:0px; max-height: 480px; overflow: auto;">
    <div class="highlight list-group-item default-item" style="margin-bottom:0px;">
       <!-- <p class="list-group-item-text">
            <strong>Please enter a location</strong>

        <div>We'll show you the nearest store.</div>-->
        <div>Fyll i stad eller ort och tryck på förstoringsglaset.</div>
        </p>
    </div>
    <div class="highlight list-group-item no-results-item hide" style="margin-bottom:0px;">
        <p class="list-group-item-text">
            <strong><i class="fa fa-info-circle"></i> Sorry, no results found.</strong>

        <div>Please try another location and/or filters.</div>
        </p>
    </div>
    <div class="list-group-item template-item hide" style="cursor: pointer">
        <div class="list-group-item-text">
            <div class="pull-right skip-popup" style="padding-left:10px;">
                <small>{distance} {metric}</small>
            </div>
            <div style="font-weight: bold; overflow: hidden; white-space: nowrap;" class="btn-detail">{name}</div>
            <div class="image"><img src="{image}" class="image" style="height: 25px; width: auto; margin:3px 0px;"></div>
            <div style="overflow:auto;">
                <div class="pull-right skip-popup"><br><a href="#)" class="btn btn-default btn-detail"><i
                            class="fa fa-chevron-right"></i> </a></div>
                <div class="website"><a href="http://{website}" target="_blank" class="website">{website}</a></div>

                <div>
                    <small>{address}</small>
                </div>
                <div>
                    <small>{administrative_area_level_2} {administrative_area_level_1} {postal_code}</small>
                </div>
                <div style="margin-top: 5px;">
                    <a href="{twitter}" title="Twitter" target="_blank" class="twitter"><i class="fa fa-twitter-square fa-lg"></i></a>
                    <a href="{youtube}" title="YouTube" target="_blank" class="youtube"><i class="fa fa-youtube-square fa-lg"></i></a>
                    <a href="{googleplus}" title="Google+" target="_blank" class="googleplus"><i class="fa fa-google-plus-square fa-lg"></i></a>
                    <a href="{linkedin}" title="LinkedIn" target="_blank" class="linkedin"><i class="fa fa-linkedin-square fa-lg"></i></a>
                    <a href="{pinterest}" title="Pinterest" target="_blank" class="pinterest"><i class="fa fa-pinterest-square fa-lg"></i></a>
                    <a href="{instagram}" title="Instagram" target="_blank" class="instagram"><i class="fa fa-instagram fa-lg"></i></a>
                    <a href="{facebook}" title="Facebook" target="_blank" class="facebook"><i class="fa fa-facebook-square fa-lg"></i></a>
                </div>
                <div style="margin-top:5px; font-size:90%;">
                    <a class="btn-detail" style="display:none;"><i class="fa fa-map-marker"></i> Directions & Hours</a><br>
                    <div>
                        <a href="javascript:void(0)" class="phone" style="cursor:default;text-decoration: none;"><i class="fa fa-phone-square"></i> {phone} </a>
                        <a href="javascript:void(0)" class="fax"><i class="fa fa-print"></i> {fax}</a>
                    </div>
                    <a href="javascript:void(0)" class="email"><i class="fa fa-envelope"></i> {email}</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- detail template -->
<div class="list-group loc-store-detail-template hide"
     style="margin-bottom:0px; height: 520px; max-height: 520px; overflow: auto;">
    <div class="highlight list-group-item" style="margin-bottom: 0px; ">
        <div class="pull-right btn-group">
            <a href='#' class="btn btn-default btn-sm link-btn"><i class="fa fa-bookmark"></i></a>
            <button class="btn btn-default btn-sm close-btn"><i class="fa fa-times"></i></button>
        </div>
        <h5 style="margin:0px;line-height: 30px;">Location Detail</h5>
    </div>
    <div class="list-group-item template-item" style="cursor: pointer">
        <div class="list-group-item-text">
            <h4 style="font-weight: bold; margin-bottom: 2px;">{name} <a class="addthis_button" target="_blank" style="font-size:80%;" title="Click to Share"><i class="fa fa-share-square fa-lg"></i></a></h4>
            <img src="{image}" class="image" style="height: 50px; width: auto; margin:5px 0px;">
            <div style="overflow:auto;">
                <div>
                    <small>{address}</small>
                </div>
                <div>
                    <small>{administrative_area_level_2} {administrative_area_level_1} {postal_code}</small>
                </div>

                <div style="margin-top: 5px;">
                    <a href="{twitter}" title="Twitter" target="_blank" class="twitter"><i class="fa fa-twitter-square fa-lg"></i></a>
                    <a href="{youtube}" title="YouTube" target="_blank" class="youtube"><i class="fa fa-youtube-square fa-lg"></i></a>
                    <a href="{googleplus}" title="Google+" target="_blank" class="googleplus"><i class="fa fa-google-plus-square fa-lg"></i></a>
                    <a href="{linkedin}" title="LinkedIn" target="_blank" class="linkedin"><i class="fa fa-linkedin-square fa-lg"></i></a>
                    <a href="{pinterest}" title="Pinterest" target="_blank" class="pinterest"><i class="fa fa-pinterest-square fa-lg"></i></a>
                    <a href="{instagram}" title="Instagram" target="_blank" class="instagram"><i class="fa fa-instagram fa-lg"></i></a>
                    <a href="{facebook}" title="Facebook" target="_blank" class="facebook"><i class="fa fa-facebook-square fa-lg"></i></a>
                </div>
                <div style="margin-top:5px; font-size:90%;">
                    <div class="website"><a href="http://{website}" target="_blank" class="website"><i class="fa fa-globe"></i> {website}</a></div>
                    <div>
                        <a href="tel:{phone}" class="phone"><i class="fa fa-phone-square"></i> {phone} </a>
                        <a href="tel:{fax}" class="fax"><i class="fa fa-print"></i> {fax}</a>
                    </div>
                    <a href="mailto:{email}" class="email"><i class="fa fa-envelope"></i> {email}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group-item template-item" style="cursor: pointer">
        <div class="list-group-item-text">
            <div style="font-weight: bold;">Directions</div>
            <div>
                <div style="margin-top:5px;" class="btn-group">
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><i
                            class="fa fa-compass"></i> Get Directions <i class="fa fa-caret-down"></i></button>
                    <ul class="dropdown-menu direction-links" role="menu">
                        <li><a href="https://maps.google.com/maps?daddr=" target="_blank"><i
                                    class="fa fa-external-link"></i> Google Maps Directions</a></li>
                        <li><a href="http://www.bing.com/maps/default.aspx?rtp=adr~adr." target="_blank"><i
                                    class="fa fa-external-link"></i> Bing Maps Directions</a></li>
                        <!-- <li><a href="http://mapq.st/directions?q=" target="_blank"><i class="fa fa-external-link"></i> MapQuest Directions</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group-item template-item" style="">
        <div class="list-group-item-text" style="min-height: 50px;">
            <div style="font-weight: bold;">Hours</div>
            <div>
                <div>
                    <small>{hours}</small>
                </div>
            </div>
        </div>
    </div>

    <div class="list-group-item template-item" style="cursor: pointer">
        <div class="list-group-item-text" style="min-height: 50px;">
            <section class="services" style="margin-bottom: 5px;">
            <div style="font-weight: bold;">Services</div>
            <div>
                <div>
                    <small>{services}</small>
                </div>
            </div>
            </section>
            <section class="categories" style="margin-bottom: 5px;">
                <div style="font-weight: bold;">Categories</div>
                <div>
                    <div>
                        <small>{categories}</small>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="list-group-item template-item" style="">
        <div class="list-group-item-text" style="min-height: 50px;">
            <div style="font-weight: bold;">Additional Information</div>
            <div>
                <div>
                    <small>{description}</small>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /detail template -->

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-53665d7f3b2b758e"></script>

<div class="modal fade" id="filter-modal">
    <form id="cat-form" action="#" autocomplete="off">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Filter Search Results</h4>
            </div>
            <div class="modal-body">

                <?php if(count($categories) || count($services)): ?>
                    <div id="categories" class="collapse in">
                        <form id="cat-form" style="margin-top:5px; font-size: 90%;">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <?php if(count($categories)): ?>
                                        <strong>Filter by Category:</strong>
                                        <div class="row">
                                            <?php foreach($categories as $item): ?>
                                                <div class="col-md-12">
                                                    <label style="font-weight:normal;">
                                                        <?php echo Form::checkbox('c[]', $item->id, in_array($item->id, Input::get('c', array())), array('id'=>'form_c_'.$item->id)); ?>
                                                        <i class="<?php echo $item->icon ? $item->icon : "fa fa-tags"; ?> fa-fw"></i>
                                                        <?php echo $item->title; ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <?php if(count($services)): ?>
                                        <strong>Filter by Services:</strong>
                                        <div class="row">
                                            <?php foreach($services as $item): ?>
                                                <div class="col-md-12">
                                                    <label style="font-weight:normal;">
                                                        <?php echo Form::checkbox('c[]', $item->id, in_array($item->id, Input::get('c', array())), array('id'=>'form_c_'.$item->id)); ?>
                                                        <i class="<?php echo $item->icon ? $item->icon : "fa fa-tags"; ?> fa-fw"></i>
                                                        <?php echo $item->title; ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default" ><i class="fa fa-search"></i> Apply Search Filters</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->

