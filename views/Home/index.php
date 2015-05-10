<script src="/content/js/jssor.js" type="text/javascript"></script>
<script src="/content/js/jssor.slider.js" type="text/javascript"></script>
<div><br /></div>
<h3 class="topN">Топ 10 най-харесвани снимки</h3>
    <div class="col-sm-2 col-xs-1"></div>
        <div class="col-sm-8 col-xs-9">
                <style> 
                    .captionOrange, .captionBlack
                    {
                        color: #fff;
                        font-size: 20px;
                        line-height: 30px;
                        text-align: center;
                        border-radius: 4px;
                    }
                    .captionOrange
                    {
                        background: #EB5100;
                        background-color: rgba(235, 81, 0, 0.6);
                    }
                    .captionBlack
                    {
                        font-size:16px;
                        background: #000;
                        background-color: rgba(0, 0, 0, 0.4);
                    }
                    a.captionOrange, A.captionOrange:active, A.captionOrange:visited
                    {
                            color: #ffffff;
                            text-decoration: none;
                    }
                    a.captionOrange:hover
                    {
                        color: #eb5100;
                        text-decoration: underline;
                        background-color: #eeeeee;
                        background-color: rgba(238, 238, 238, 0.7);
                    }
                    .bricon
                    {
                        background: url(../images/browser-icons.png);
                    }
                </style>
                <script>

                    jQuery(document).ready(function ($) {
                        var options = {
                            $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                            $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                            $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                            $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                            $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                            $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                            $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                           // $SlideWidth: 1200,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                           // $SlideHeight: 1300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                            $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                            $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                            $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                            $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                            $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                            $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                            $ArrowNavigatorOptions: {
                                $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
                                $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                                $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                                $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                            },

                            $ThumbnailNavigatorOptions: {
                                $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                                $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                                $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                                $AutoCenter: 3,                                 //[Optional] Auto center thumbnail items in the thumbnail navigator container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 3
                                $Lanes: 1,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
                                $SpacingX: 3,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                                $SpacingY: 3,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                                $DisplayPieces: 9,                              //[Optional] Number of pieces to display, default value is 1
                                $ParkingPosition: 260,                          //[Optional] The offset position to park thumbnail
                                $Orientation: 1,                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                                $DisableDrag: false                             //[Optional] Disable drag or not, default value is false
                            }
                        };

                        var jssor_slider2 = new $JssorSlider$("slider2_container", options);
                        //responsive code begin
                        //you can remove responsive code if you don't want the slider scales while window resizes
                        function ScaleSlider() {
                            var parentWidth = jssor_slider2.$Elmt.parentNode.clientWidth;
                            if (parentWidth)
                                jssor_slider2.$ScaleWidth(Math.min(parentWidth, 1000));
                            else
                                window.setTimeout(ScaleSlider, 30);
                        }
                        ScaleSlider();

                        $(window).bind("load", ScaleSlider);
                        $(window).bind("resize", ScaleSlider);
                        $(window).bind("orientationchange", ScaleSlider);
                        //responsive code end
                    });
                </script>
                <!-- Jssor Slider Begin -->
                <!-- You can move inline styles to css file or css block. -->
                <div id="slider2_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 300px; overflow: hidden; ">

                    <!-- Loading Screen -->
                    <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                        <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                            background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                        </div>
                        <div style="position: absolute; display: block; background: url(/content/img/loading.gif) no-repeat center center;
                            top: 0px; left: 0px;width: 100%;height:100%;">
                        </div>
                    </div>
                    <!-- Slides Container -->
                    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 600px; height: 300px; overflow: hidden;">
                        <?php
                        if (isset($this->photos)) {
                            foreach ($this->photos as $photo) {
                                ?>
                                <div>
                                    <img u="image" src="/content/photos/<?= $photo['Image'] ?>" />
                                    <img u="thumb" src="/content/photos/<?= $photo['Image'] ?>" />
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- Arrow Navigator Skin Begin -->
                    <style>
                        /* jssor slider arrow navigator skin 02 css */
                        /*
                        .jssora02l              (normal)
                        .jssora02r              (normal)
                        .jssora02l:hover        (normal mouseover)
                        .jssora02r:hover        (normal mouseover)
                        .jssora02ldn            (mousedown)
                        .jssora02rdn            (mousedown)
                        */
                        .jssora02l, .jssora02r, .jssora02ldn, .jssora02rdn
                        {
                            position: absolute;
                            cursor: pointer;
                            display: block;
                            background: url(/content/img/a02.png) no-repeat;
                            overflow:hidden;
                        }
                        .jssora02l { background-position: -3px -33px; }
                        .jssora02r { background-position: -63px -33px; }
                        .jssora02l:hover { background-position: -123px -33px; }
                        .jssora02r:hover { background-position: -183px -33px; }
                        .jssora02ldn { background-position: -243px -33px; }
                        .jssora02rdn { background-position: -303px -33px; }
                    </style>
                    <!-- Arrow Left -->
                    <span u="arrowleft" class="jssora02l" style="width: 55px; height: 55px; top: 123px; left: 8px;">
                    </span>
                    <!-- Arrow Right -->
                    <span u="arrowright" class="jssora02r" style="width: 55px; height: 55px; top: 123px; right: 8px">
                    </span>
                    <!-- Arrow Navigator Skin End -->

                    <!-- ThumbnailNavigator Skin Begin -->
                    <div u="thumbnavigator" class="jssort03" style="position: absolute; width: 600px; height: 60px; left:0px; bottom: 0px;">
                        <div style=" background-color: #000; filter:alpha(opacity=30); opacity:.3; width: 100%; height:100%;"></div>

                        <!-- Thumbnail Item Skin Begin -->
                        <style>
                            /* jssor slider thumbnail navigator skin 03 css */
                            /*
                            .jssort03 .p            (normal)
                            .jssort03 .p:hover      (normal mouseover)
                            .jssort03 .pav          (active)
                            .jssort03 .pav:hover    (active mouseover)
                            .jssort03 .pdn          (mousedown)
                            */
                            .jssort03 .w, .jssort03 .pav:hover .w
                            {
                                    position: absolute;
                                    width: 60px;
                                    height: 30px;
                                    border: white 1px dashed;
                            }
                            * html .jssort03 .w
                            {
                                    width /**/: 62px;
                                    height /**/: 32px;
                            }
                            .jssort03 .pdn .w, .jssort03 .pav .w { border-style: solid; }
                            .jssort03 .c
                            {
                                    width: 62px;
                                    height: 32px;
                                    filter:  alpha(opacity=45);
                                    opacity: .45;

                                    transition: opacity .6s;
                                -moz-transition: opacity .6s;
                                -webkit-transition: opacity .6s;
                                -o-transition: opacity .6s;
                            }
                            .jssort03 .p:hover .c, .jssort03 .pav .c
                            {
                                    filter:  alpha(opacity=0);
                                    opacity: 0;
                            }
                            .jssort03 .p:hover .c
                            {
                                 transition: none;
                                -moz-transition: none;
                                -webkit-transition: none;
                                -o-transition: none;
                            }
                        </style>
                        <div u="slides" style="cursor: move;">
                            <div u="prototype" class="p" style="POSITION: absolute; WIDTH: 62px; HEIGHT: 32px; TOP: 0; LEFT: 0;">
                                <div class=w><div u="thumbnailtemplate" style=" WIDTH: 100%; HEIGHT: 100%; border: none;position:absolute; TOP: 0; LEFT: 0;"></div></div>
                                <div class=c style="POSITION: absolute; BACKGROUND-COLOR: #000; TOP: 0; LEFT: 0">
                                </div>
                            </div>
                        </div>
                        <!-- Thumbnail Item Skin End -->
               
                </div>
        </div>
   
</div>
<div class="clear"></div>

<div class="topCatalogs">
    <h3 class="topN">Топ 10 най-харесвани албума</h3>
    <div class="row">
        <div class="col-md-1 col-xs-1 col-lg-1"></div>
        <div class="col-md-10 col-xs-10 col-lg-10 categories">
            <?php
            if (isset($this->catalogs)) {
                foreach ($this->catalogs as $catalog){
                    echo "<span style='cursor:auto' class='categoryContent' title='" . htmlspecialchars($catalog['Description']) . "' href='#'>  ";
                        echo '<div  class="col-md-3 col-xs-10 col-lg-2 category">';
                            echo "<div class='row'>";
                            echo '<div class="col-md-12 col-xs-12 col-lg-12 categoryTitle"> '
                                     . '<span>' . htmlspecialchars($catalog['Name']) . '</span>'; 
                                echo  '</div>';
                            echo "</div>";
                            echo "<div class='row'>";
                                 echo '<img class="categoryImg" src="../content/galleryPhoto/' . htmlspecialchars($catalog['image']) . '" alt=""/>';
                             echo "</div>";
                        echo "</div>";
                    echo '</span>';
                }
            }
            ?>
        </div>
        <div class="col-md-1 col-xs-1 col-lg-1"></div>
    </div>
</div>