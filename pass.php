<?php include_once("template_pageTop.php"); ?>

<!--HOME SECTION-->
<div id="home-sec">


    <div class="container"  >
        <div class="row text-center">
            <div  class="col-md-12" >
                <?php include_once("php_includes/changepasschecker_data.php"); ?> 
                <?php if ($user_ok === false && $checker === false) { ?>
                    <form id="forgetpassform" onsubmit="return false;">
                        <div>Email:</div>
                        <input type="text" id="form-control" onfocus="emptyElement('status')" maxlength="88">                                  
                        <p id="status2"></p>
                        <button type="button" class="btn btn-primary" id="btnpass1" onclick="pass()">Send</button>
                    </form>
                <?php } ?>
                <?php if ($checker === true && $user_ok === false) { ?>
                    <form id="changeforgetpassform" onsubmit="return false;">
                        <div>New Password:</div>
                        <input type="password" id="new" onfocus="emptyElement('status')" maxlength="88"> 
                        <div>Confirm New Password:</div>
                        <input type="password" id="new2" onfocus="emptyElement('status')" maxlength="88"> 
                        <p id="status3"></p>
                        <button type="button" class="btn btn-primary" id="btnpass2" onclick="change()">Save</button>
                    </form>
                <?php } ?>
                <?php if ($user_ok !== false) { ?>
                    <form id="changepassform" onsubmit="return false;">
                        <div>Old Password:</div>
                        <input type="password" id="old" onfocus="emptyElement('status')" maxlength="88">
                        <div>New Password:</div>
                        <input type="password" id="new3" onfocus="emptyElement('status')" maxlength="88"> 
                        <div>Confirm New Password:</div>
                        <input type="password" id="new4" onfocus="emptyElement('status')" maxlength="88"> 
                        <p id="status4"></p>
                        <button type="button" class="btn btn-primary" id="btnpass3" onclick="changeuserpass()">Save</button>
                    </form>
                <?php } ?>


            </div>
        </div>
    </div>
</div>


<section  id="services-sec">
    <div class="container">
        <div class="row ">
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
        </div>
        <div class="row go-marg">

            <div class="col-md-4 col-sm-4">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h4 class="adjst">Tour Package One #1 </h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                        </p>


                    </div>
                </div> 

            </div>
            <div class="col-md-4 col-sm-4">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h4 class="adjst">Tour Package Two #2 </h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
                        </p>


                    </div>
                </div> 

            </div>
            <div class="col-md-4 col-sm-4">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h4 class="adjst">Tour Package Three #3 </h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Curabitur nec nisl odio. Mauris vehicula at nunc id posuere.
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

