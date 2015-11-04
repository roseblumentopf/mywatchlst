<?php include_once("template_pageTop.php"); ?>
<?php include_once("php_includes/movie_data.php"); ?>
<?php include_once("php_includes/services_data.php"); ?>
<?php include_once("assets/css/background.css.php"); ?>
<!--HOME SECTION-->
<div id="home-sec">


    <div class="container"  >
        <div class="row text-center">
            <div  class="col-md-12" >



            </div>
        </div>
    </div>
</div>


<section  id="services-sec">
    <div class="container">
        <!--        <div class="row ">
                    <div class="text-center g-pad-bottom">
                        <div class="col-md-4 col-sm-4 alert-info">
                            <p>
        <?php echo $poster; ?>
                            </p>
        
                        </div>
                        <div class="col-md-4 col-sm-4 alert-success">
                            <p>
                            <div class="movie_name">
        <?php echo $name ?>
                            </div>
                            <br>
                            <div id="overview">
        <?php echo $overview ?>
                            </div>
                            <div id="credits">
                                <strong>Cast:</strong>
        <?php echo $credits ?>                        
                            </div>
                            <div id="director">
                                <strong>Director:</strong>
        <?php echo $director ?>
                            </div>
                            <div id="runtime">
                                <strong>Runtime:</strong>
        <?php echo $runtime ?> 
                            </div>
                            <div id="genres">
                                <strong>Genres:</strong>
        <?php echo $genres ?>
                            </div>
                            <div id="trailer">
                                <strong><?php echo $trailer ?></strong>
                            </div>
                            <div id="tmdblink">
                                Get more at:
        <?php echo $tmdblink ?>/<?php echo $imdblink ?>
                            </div>
                            </p>
        
                        </div>
        
                        <div class="col-md-4 col-sm-4 alert-danger">
                            <p>
        <?php
        if (isset($trackPricetemp)) {
            ?>
                                    <div class="price">
            <?php echo $trackPrice ?> 
                                    </div>
            <?php
        }
        ?>
        <?php
        if (isset($trackRentalPricetemp)) {
            ?>
                                    <div class="price">
            <?php echo $trackRentalPrice ?>
                                    </div>
            <?php
        }
        ?>
        
        
                        </div>
                    </div>
                </div>-->
        <div class="row go-marg">

            <div class="col-md-4 col-sm-4">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h4 class="adjst"></h4>

                        <p>
                            <?php echo getPoster($row) ?>
                        </p>



                    </div>
                </div> 

            </div>
            <div class="col-md-4 col-sm-4">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h4 class="adjst"><?php echo getName($row) ?></h4>
                        <p>
                        <div id="overview">
                            <?php echo getOverview($row) ?>
                        </div>
                        <div id="credits">
                            <strong>Cast:</strong>
                            <?php echo getCredits($row) ?>                        
                        </div>
                        <div id="director">
                            <strong>Director:</strong>
                            <?php echo getDirector($row) ?>
                        </div>
                        <div id="runtime">
                            <strong>Runtime:</strong>
                            <?php echo getRuntime($row) ?> 
                        </div>
                        <div id="genres">
                            <strong>Genres:</strong>
                            <?php echo getGenres($row) ?>
                        </div>
                        <!--div id="trailer">
                            <strong><?php echo getTrailerUrl($row) ?></strong>
                        </div-->
                        <div id="tmdblink">
                            Get more at:
                            <?php echo getTmdbLink() ?>/<?php echo getImdbLink($row) ?>
                        </div>


                    </div>
                </div> 

            </div>
            <div class="col-md-4 col-sm-4">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h4 class="adjst"></h4>
                        <p>
                            <?php
                            if (isset($trackPricetemp)) {
                                ?>
                            <div class="price">
                                <?php echo $trackPrice ?> 
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        if (isset($trackRentalPricetemp)) {
                            ?>
                            <div class="price">
                                <?php echo $trackRentalPrice ?>
                            </div>
                            <?php
                        }
                        ?>
                        </p>


                    </div>
                </div> 

            </div>
        </div>

    </div>
</section>
<!--END HOME SECTION-->   

<?php include_once("template_pageBottom.php"); ?>

</body>
</html>
