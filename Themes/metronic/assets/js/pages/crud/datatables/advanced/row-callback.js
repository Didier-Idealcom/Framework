"use strict";var KTDatatablesAdvancedColumnVisibility={init:function(){$("#kt_datatable").DataTable({responsive:!0,createdRow:function(t,e,a){var i=$("td",t).eq(6);1*e[6].replace(/[\$,]/g,"")>4e5&&1*e[6].replace(/[\$,]/g,"")<6e5&&i.addClass("highlight").css({"font-weight":"bold",color:"#716aca"}).attr("title","Over $400,000 and below $600,000"),1*e[6].replace(/[\$,]/g,"")>6e5&&i.addClass("highlight").css({"font-weight":"bold",color:"#f4516c"}).attr("title","Over $600,000"),i.html(KTUtil.numberString(e[6]))}})}};jQuery(document).ready(function(){KTDatatablesAdvancedColumnVisibility.init()});