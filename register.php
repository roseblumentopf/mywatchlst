<?php include_once("template_pageTop.php"); ?>

<!--HOME SECTION-->
<div id="home-sec">


    <div class="container"  >

        <form name="signupform" id="signupform" onsubmit="return false;">
            <label>Email:</label>
            <input type="email" id="email" onfocus="emptyElement('status')" onkeyup="restrict('email')" placeholder="" maxlength="88"><br>
            <label>Password:</label>
            <input type="password" id="pass1"  onfocus="emptyElement('status')" placeholder="" maxlength="16"><br>
            <label>Password again:</label>
            <input type="password" id="pass2" onfocus="emptyElement('status')" placeholder="" maxlength="16"><br>
            <label>Gender:</label>
            <select id="gender">
                <option value="">Choose</option>
                <option value="m">Male</option>
                <option value="f">Female</option>
            </select>
            <label>Country:</label>
            <select id="country">
                <option value="">Choose</option>
                <option value="USA">USA</option>
                <option value="Germany">Germany</option>
                <!--?php include_once("template_country_list.php"); ?-->
            </select>
        </form>
        <span id="status"></span>
        <button type="button" class="btn btn-primary" id="btnregister" onclick="register()">Create</button>
    </div>
</div>
<!--END HOME SECTION-->   

<?php include_once("template_pageBottom.php"); ?>






