var SnippetLogin=function(){var i=$("#m_login"),e=function(i,e,n){var a=$('<div class="m-alert m-alert--outline alert alert-'+e+' alert-dismissible" role="alert">\t\t\t<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\t\t\t<span></span>\t\t</div>');i.find(".alert").remove(),a.prependTo(i),a.animateClass("fadeIn animated"),a.find("span").html(n)},n=function(){i.removeClass("m-login--forget-password"),i.removeClass("m-login--signin"),i.addClass("m-login--signup"),i.find(".m-login__signup").animateClass("flipInX animated")},a=function(){i.removeClass("m-login--forget-password"),i.removeClass("m-login--signup"),i.addClass("m-login--signin"),i.find(".m-login__signin").animateClass("flipInX animated")},t=function(){i.removeClass("m-login--signin"),i.removeClass("m-login--signup"),i.addClass("m-login--forget-password"),i.find(".m-login__forget-password").animateClass("flipInX animated")},l=function(){$("#m_login_forget_password").click(function(i){i.preventDefault(),t()}),$("#m_login_forget_password_cancel").click(function(i){i.preventDefault(),a()}),$("#m_login_signup").click(function(i){i.preventDefault(),n()}),$("#m_login_signup_cancel").click(function(i){i.preventDefault(),a()})},s=function(){},o=function(){$("#m_login_signup_submit").click(function(n){n.preventDefault();var t=$(this),l=$(this).closest("form");l.validate({rules:{fullname:{required:!0},email:{required:!0,email:!0},password:{required:!0},rpassword:{required:!0},agree:{required:!0}}}),l.valid()&&(t.addClass("m-loader m-loader--right m-loader--light").attr("disabled",!0),l.ajaxSubmit({url:"",success:function(n,s,o,r){setTimeout(function(){t.removeClass("m-loader m-loader--right m-loader--light").attr("disabled",!1),l.clearForm(),l.validate().resetForm(),a();var n=i.find(".m-login__signin form");n.clearForm(),n.validate().resetForm(),e(n,"success","Thank you. To complete your registration please check your email.")},2e3)}}))})},r=function(){};return{init:function(){l(),s(),o(),r()}}}();jQuery(document).ready(function(){SnippetLogin.init()});