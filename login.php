<?php include_once("template_pageTop.php"); ?>

<!--HOME SECTION-->
<div id="home-sec">


    <div class="container"  >

        <form id="loginform" onsubmit="return false;">
            <label>Email:</label>
            <input type="text" id="email1" onfocus="emptyElement('status')" maxlength="88">
            <label>Password:</label>
            <input type="password" id="password" onfocus="emptyElement('status')" maxlength="100">
            <br /><br />                                   
            <p id="status"></p>
            <a href="pass.php">Forgot Your Password?</a>
            <!--a href="loginTwitter.php">
            <img src="images/sign-in-with-twitter-link.png" alt="logo" title="Sign in with Twitter">
            </a-->
        </form>
        <button type="button" class="btn btn-primary" id="btnlogin" onclick="login()">Send</button>
    </div>
</div>
<!--END HOME SECTION-->   

<?php include_once("template_pageBottom.php"); ?>

