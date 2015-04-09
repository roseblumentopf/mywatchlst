<?php include_once("template_pageTop.php"); ?>
<?php include_once("php_includes/search_data.php"); ?>  
<!--HOME SECTION-->
<!--div id="home-sec">


<div class="container"  >
    <div class="row text-center">
        <div  class="col-md-12" >
           
     
             
        </div>
    </div>
</div>
     </div-->


<section  id="services-sec">
    <div class="container">
        <!--div class="row ">
            <div class="text-center g-pad-bottom">
                <div class="col-md-4 col-sm-4 alert-info">
                        <h4>Free To Use </h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                     Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                        
                </div>
                <div class="col-md-4 col-sm-4 alert-success">
                        <h4>100%  Responsive </h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                     Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                             Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                        
                </div>
               
                <div class="col-md-4 col-sm-4 alert-danger">
                        <h4> Customizable </h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                     Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </p>
                      
                </div>
            </div>
              </div-->
        <div class="row go-marg">

            <div class="col-md-4 col-sm-4">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h4 class="adjst">Result #1 </h4>
                        <p>
                            <?php echo $sresult0 ?>

                        </p>


                    </div>
                </div> 

            </div>
            <div class="col-md-4 col-sm-4">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h4 class="adjst">Result #2 </h4>
                        <p>
                            <?php echo $sresult1 ?>
                        </p>


                    </div>
                </div> 

            </div>
            <div class="col-md-4 col-sm-4">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h4 class="adjst">Result #3 </h4>
                        <p>
                            <?php echo $sresult2 ?>
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

