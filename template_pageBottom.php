<!--FOOTER SECTION -->
<div id="footer">
    <?php
    $timestamp = time();
    $year = date("Y", $timestamp);
    if ($year > 2014) {
        $yeartext = "&copy; 2014-" . $year;
    } else {
        $yeartext = "&copy; 2014";
    }
    ?>
    <div id="pageBottom"><?php echo $yeartext ?> myWATCHLST. Movie data supplied by <a href="https://www.themoviedb.org" target="_blank">TMDb</a>.
    </div>  

</div>
<!-- END FOOTER SECTION -->

<!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!-- CORE JQUERY  -->
<script src="assets/plugins/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP CORE SCRIPT   -->
<script src="assets/plugins/bootstrap.min.js"></script>  
<!-- ISOTOPE SCRIPT   -->
<script src="assets/plugins/jquery.isotope.min.js"></script>
<!-- PRETTY PHOTO SCRIPT   -->
<script src="assets/plugins/jquery.prettyPhoto.js"></script>    
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>

<script src="assets/js/typeahead.min.js" type="text/javascript"></script>


