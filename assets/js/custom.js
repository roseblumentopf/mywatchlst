

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

function pass() {
    var e = _("form-control").value;
    var status = _("status2");
    if (e === "" || check_email(e) === false) {
        status.innerHTML = "This is not a valid email.";
        console.log("1");
    } else {
        status.innerHTML = 'please wait ...';
        var ajax = ajaxObj("POST", "php_includes/pass_data.php");
        ajax.onreadystatechange = function () {
            if (ajaxReturn(ajax) === true) {
                var response = ajax.responseText;
                console.log(response);
                if (ajax.responseText !== "success") {
                    status.innerHTML = "Something went wrong, please try again.";
                } else {
                    $("#myAlert").append('<text><strong>Very Good!</strong> Everything worked fine and you can check your e-mail inbox.</text>');
                    $("#myAlert").slideDown(400);
                    setTimeout(function () { // this will automatically close the alert and remove this if the users doesnt close it in 5 secs
                        $("#myAlert").slideUp(400);
                    }, 5000);
                    _("form-control").value = '';
                    status.innerHTML = '';
                    window.location = 'http://h2201857.stratoserver.net/clean/index.php';
                }
            }
        },
                ajax.send("e=" + e);
    }
}

function change() {
    var p1 = _("new").value;
    var p2 = _("new2").value;
    var key = get_url_param("p");
    var status = _("status3");
    if (p1 === "" || p2 === "") {
        status.innerHTML = "Please fill out all of the form data.";
    } else if (p1 !== p2) {
        status.innerHTML = "Your password fields do not match.";
    } else {
        status.innerHTML = 'please wait ...';
        var ajax = ajaxObj("POST", "php_includes/pass_data.php");
        ajax.onreadystatechange = function () {
            if (ajaxReturn(ajax) === true) {
                if (ajax.responseText !== "success") {
                    status.innerHTML = ajax.responseText;
                } else {
                    $("#myAlert").append('<text><strong>Very Good!</strong> Everything worked fine and you can now use your new password.</text>');
                    $("#myAlert").slideDown(400);
                    setTimeout(function () { // this will automatically close the alert and remove this if the users doesnt close it in 5 secs
                        $("#myAlert").slideUp(400);
                    }, 5000);
                    _("new").value = '';
                    _("new2").value = '';
                    status.innerHTML = '';
                    window.location = 'http://h2201857.stratoserver.net/clean/index.php';
                }
            }
        },
                ajax.send("p=" + p1 + "&k=" + key);
    }
}

function changeuserpass() {
    var p0 = _("old").value;
    var p1 = _("new3").value;
    var p2 = _("new4").value;
    var status = _("status4");
    if (p1 === "" || p2 === "" || p0 === "") {
        status.innerHTML = "Please fill out all of the form data.";
    } else if (p1 !== p2) {
        status.innerHTML = "Your password fields do not match.";
    } else {
        status.innerHTML = 'please wait ...';
        var ajax = ajaxObj("POST", "php_includes/pass_data.php");
        ajax.onreadystatechange = function () {
            if (ajaxReturn(ajax) === true) {
                if (ajax.responseText !== "success") {
                    status.innerHTML = ajax.responseText;
                } else {
                    $("#myAlert").append('<text><strong>Very Good!</strong> Everything worked fine and you can now use your new password.</text>');
                    $("#myAlert").slideDown(400);
                    setTimeout(function () { // this will automatically close the alert and remove this if the users doesnt close it in 5 secs
                        $("#myAlert").slideUp(400);
                    }, 5000);
                    _("new3").value = '';
                    _("new4").value = '';
                    _("old").value = '';
                    status.innerHTML = '';
                }
            }
        },
                ajax.send("p=" + p1 + "&o=" + p0);
    }
}

//------------------------------typeahead.js-------------------------------------

$(function () {
    $('.form-control').typeahead({
        displayKey: 'value',
        header: '<b>&nbsp&nbspMovie suggestions...</b>',
        limit: 10,
        minLength: 3,
        remote: {
            url: 'https://api.themoviedb.org/3/search/movie?query=%QUERY&api_key=93ad36446acab4b05301022006e5bdc4',
            filter: function (parsedResponse) {
                retval = [];
                debugger;
                for (var i = 0; i < parsedResponse.results.length; i++) {
                    if (parsedResponse.results[i].release_date === '') {
                        retval.push({
                            value: parsedResponse.results[i].original_title,
                            tokens: parsedResponse.results[i].original_title,
                            id: parsedResponse.results[i].id
                        });
                    }
                    else {
                        var string = parsedResponse.results[i].release_date;
                        var array = string.split('-');
                        var year = array[0];
                        retval.push({
                            value: parsedResponse.results[i].original_title + ' (' + year + ')',
                            tokens: parsedResponse.results[i].original_title + ' (' + year + ')',
                            id: parsedResponse.results[i].id
                        });
                    }
                }
                return retval;
            },
            dataType: 'jsonp'
        }
    }).on('typeahead:selected', function ($e, retval) {
        var string = retval['id'];
        window.location = 'http://localhost/mywatchlst/movie/' + string;
    });
});

$(function () {
    $('#btnsearch').click(function () {
        var s = $('.form-control').val();
        if (s === "") {
            console.log("error");
        }
        else {
            window.location = 'http://localhost/mywatchlst/search/' + s;
        }
        return false;
    });
});



