"use strict";var datatable,MyListDatatable={init:function(a,t,e){!function(a,t,e){datatable=$(a).KTDatatable({data:{type:"remote",source:{read:{url:t,headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}},pageSize:10,serverPaging:!0,serverFiltering:!0,serverSorting:!0},layout:{scroll:!1,footer:!1},sortable:!0,pagination:!0,search:{input:$("#databable_search"),delay:400},columns:e})}(a,t,e),$("#kt_form_status").on("change",function(){datatable.search($(this).val().toLowerCase(),"Status")}),datatable.on("kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated",function(a){var t=datatable.rows(".kt-datatable__row--active").nodes().length;$("#kt_subheader_group_selected_rows").html(t),t>0?($("#kt_subheader_search").addClass("kt-hidden"),$("#kt_subheader_group_actions").removeClass("kt-hidden")):($("#kt_subheader_search").removeClass("kt-hidden"),$("#kt_subheader_group_actions").addClass("kt-hidden"))})}},MyScriptGeneral={init:function(){$(".card-body").on("click",".toggle-active",function(a){var t=$(this);$.ajax({method:"GET",url:$(this).data("url"),success:function(a,e,n){if(t.data("reload"))datatable.reload();else{var l=t.data("label-on"),r=t.data("label-off");t.hasClass("btn-success")?t.html(t.html().replace(l,r)):t.html(t.html().replace(r,l)),t.toggleClass("btn-success btn-danger"),t.find("i").toggleClass("la-toggle-on la-toggle-off")}},error:function(a,t,e){console.log("Status "+t+" : "+e)}})}),$(".my-link__save").on("click",function(a){a.preventDefault(),$($(this).attr("href")).trigger("click")}),$(".input-multilangue").not(".lang-fr").parents(".form-group").hide(),$('.lang-change[data-lang="fr"]').addClass("active"),$(".lang-change").on("click",function(a){if(a.preventDefault(),!$(this).hasClass("active")){var t=$(this).data("lang");$(".input-multilangue").parents(".form-group").hide(),$(".input-multilangue.lang-"+t).parents(".form-group").fadeIn(),$(".lang-change").removeClass("active"),$('.lang-change[data-lang="'+t+'"]').addClass("active")}})}};jQuery(document).ready(function(){MyScriptGeneral.init()});