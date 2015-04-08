

/*=============================================================
    Authour URI: www.binarytheme.com
    License: Commons Attribution 3.0

    http://creativecommons.org/licenses/by/3.0/

    100% To use For Personal And Commercial Use.
    IN EXCHANGE JUST GIVE US CREDITS AND TELL YOUR FRIENDS ABOUT US
   
    ========================================================  */


(function ($) {
    "use strict";
    var mainApp = {

        main_fun: function () {
          
       
            // PRETTYPHOTO FUNCTION 

            $("a.preview").prettyPhoto({
                social_tools: false
            });

          
            /*====================================
               WRITE YOUR SCRIPTS BELOW 
           ======================================*/


        },

        initialization: function () {
            mainApp.main_fun();

        }

    }
    // Initializing ///

    $(document).ready(function () {
        mainApp.main_fun();
    });

}(jQuery));

function _(x) {
    return document.getElementById(x);
}

$(function () {
    var video = $("#trailerid").attr("src");
    $('#btnclose').click(function () {
        $("#myModalTrailer").modal("hide");
        $("#trailerid").attr("src", video);
        return false;
    });
});

function get_url_param(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");

    var regexS = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(window.location.href);

    if (results == null)
        return "";
    else
        return results[1];
}


function emptyElement(x) {
    _(x).innerHTML = "";
}

function restrict(elem) {
    var tf = _(elem);
    var rx = new RegExp;
    if (elem === "email") {
        rx = /[' "]/gi;
    } else if (elem === "username") {
        rx = /[^a-z0-9]/gi;
    }
    tf.value = tf.value.replace(rx, "");
}

function check_email(e) {
    if (!e.match(/\S+@\S+\.\S+/)) { // Jaymon's / Squirtle's solution
        return false;
    }
    if (e.indexOf(' ') !== -1 || e.indexOf('..') !== -1) {
        return false;
    }
    return true;
}

//------------------------ajax.js--------------------------------------------

function ajaxObj(meth, url) {
    var x = new XMLHttpRequest();
    x.open(meth, url, true);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    return x;
}
function ajaxReturn(x) {
    if (x.readyState === 4 && x.status === 200) {
        return true;
    }
}

//---------------------------------------------------------------------------


function register() {
    var e = _("email").value;
    var p1 = _("pass1").value;
    var p2 = _("pass2").value;
    var c = _("country").value;
    var g = _("gender").value;
    var status = _("status");
    if (e === "" || p1 === "" || p2 === "" || c === "" || g === "") {
        status.innerHTML = "Please fill out all of the form data";
    } else if (p1 !== p2) {
        status.innerHTML = "Your password fields do not match";
    } else {
        status.innerHTML = 'please wait ...';
        var ajax = ajaxObj("POST", "php_includes/register_data.php");
        ajax.onreadystatechange = function () {
            if (ajaxReturn(ajax) === true) {
                if (ajax.responseText !== "signup_success") {
                    status.innerHTML = ajax.responseText;
                } else {
//                    $("#myAlert").append('<text><strong>Very Good!</strong> Everything worked fine and you can check your e-mail inbox.</text>');
//                    $("#myAlert").slideDown(400);
//                    setTimeout(function () { // this will automatically close the alert and remove this if the users doesnt close it in 5 secs
//                        $("#myAlert").slideUp(400);
//                    }, 5000);
//                    $("#register").modal("hide");
                    _("email").value = '';
                    _("pass1").value = '';
                    _("pass2").value = '';
                    _("country").value = '';
                    _("gender").value = '';
                    status.innerHTML = '';
                }
            }
        },
                ajax.send("e=" + e + "&p=" + p1 + "&c=" + c + "&g=" + g);
    }
}

function login() {
    var e = _("email1").value;
    var p = _("password").value;
    var status = _("status");
    if (e === "" || p === "") {
        status.innerHTML = "Fill out all of the form data";
    } else {
        status.innerHTML = 'please wait ...';
        var ajax = ajaxObj("POST", "php_includes/login_data.php");
        ajax.onreadystatechange = function () {
            if (ajaxReturn(ajax) === true) {
                if (ajax.responseText !== "login_success") {
                    status.innerHTML = "Login unsuccessful, please try again.";
                } else {
                    //$("#login").modal("hide");
                    _("email1").value = '';
                    _("password").value = '';
                    status.innerHTML = '';
                    //location.reload();
                    location.href="index.php";
                }
            }
        },
                ajax.send("e=" + e + "&p=" + p);
    }
}



