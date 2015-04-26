function get_option_sport(div_append, div_from, level, type){
	if(type == 1) var type_link = 'get_option_sport';
	else if(type == 2) var type_link = 'get_option_category';

	var sport_id = $("select[name="+div_from+"]").val();
    $.get(base_url+"/"+type_link+"/"+sport_id+"/"+level, function(data) {
        data = $.parseJSON(data);
        if(data.success){
            var str = '';
            $.each(data.options, function(i,val){
		      str += '<option value="'+i+'">'+val+'</option>';
		    });
		    $("select[name="+div_append+"]").html(str);
        } else {
            alert("Something wrong");
        }
    });
}

function get_team_sport(div_append1, div_append2, div_from, level, type){
	if(type == 1) var type_link = 'get_option_sport';
	else if(type == 2) var type_link = 'get_option_category';

	var sport_id = $("select[name="+div_from+"]").val();
    $.get(base_url+"/"+type_link+"/"+sport_id+"/"+level, function(data) {
        data = $.parseJSON(data);
        if(data.success){
            var str = '';
            $.each(data.options, function(i,val){
		      str += '<option value="'+i+'">'+val+'</option>';
		    });
		    $("select[name="+div_append1+"]").html(str);
		    $("select[name="+div_append2+"]").html(str);
        } else {
            alert("Something wrong");
        }
    });
}

function delete_match(id) {
    bootbox.confirm("Are you sure to delete this match?", function(result) {
      if(result) {
      	$.ajax({
		   url: base_url+"/match/delete",
		   type: 'DELETE',
		   data: {id:id},
		   success: function(data) {
			    if(data == 'success') {
	              $("#tr_"+id).hide('slow', function(){
	              	$("#tr_"+id).remove();
	              });
	            } else {
	              alert("You can not delete this match");
	            }
			}
		});
      }
      else {
      
      }
    });
}
function delete_livescore(id) {
    bootbox.confirm("Are you sure to delete this?", function(result) {
      if(result) {
      	$.ajax({
		   url: base_url+"/match/score/delete",
		   type: 'DELETE',
		   data: {id:id},
		   success: function(data) {
			    if(data == 'success') {
	              $("#tr_"+id).hide('slow', function(){
	              	$("#tr_"+id).remove();
	              });
	            } else {
	              alert("You can not delete this score");
	            }
			}
		});
      }
      else {
      
      }
    });
}

function delete_team(id) {
    bootbox.confirm("Are you sure to delete this team players?", function(result) {
      if(result) {
      	$.ajax({
		   url: base_url+"/teams/delete",
		   type: 'DELETE',
		   data: {id:id},
		   success: function(data) {
			    if(data == 'success') {
	              $("#tr_"+id).hide('slow', function(){
	              	$("#tr_"+id).remove();
	              });
	            } else {
	              alert("You can not delete this team");
	            }
			}
		});
      }
      else {
      
      }
    });
}

function delete_player(id) {
    bootbox.confirm("Are you sure to delete this player?", function(result) {
      if(result) {
      	$.ajax({
		   url: base_url+"/teams/delete/player",
		   type: 'DELETE',
		   data: {id:id},
		   success: function(data) {
			    if(data == 'success') {
	              $("#tr_"+id).hide('slow', function(){
	              	$("#tr_"+id).remove();
	              });
	            } else {
	              alert("You can not delete this player");
	            }
			}
		});
      }
      else {
      
      }
    });
}
function change_status(player_id, status) {
	$("#btn_"+player_id).html('Processing..');

      	$.ajax({
		   url: base_url+"/teams/player/status",
		   type: 'PUT',
		   data: {player_id:player_id, status:status},
		   success: function(data) {
			    if(data == 'success') {
			    	if(status == 0){
	             		$("#btn_"+player_id).html('Mark Active');
	             		$("#btn_"+player_id).onclick("change_status("+player_id+",1)");
			    	} else {
			    		$("#btn_"+player_id).html('Mark Inactive');
	             		$("#btn_"+player_id).onclick("change_status("+player_id+",0||)");
			    	}
	            } else {
	              alert("DB error");
	            }
			}
		});
 }
$(function() {
	$.extend($.tablesorter.themes.bootstrap, {
		table      : 'table table-bordered',
		header     : 'bootstrap-header', // give the header a gradient background
		footerRow  : '',
		footerCells: '',
		icons      : '', // add "icon-white" to make them white; this icon class is added to the <i> in the header
		sortNone   : 'fa fa-sort',
		sortAsc    : 'fa fa-chevron-up',
		sortDesc   : 'fa fa-chevron-down',
		active     : '', // applied when column is sorted
		hover      : '', // use custom css here - bootstrap class may not override it
		filterRow  : '', // filter row class
		even       : '', // odd row zebra striping
		odd        : ''  // even row zebra striping
	});
	
	$(".tablesorter").tablesorter({
		theme : "bootstrap",
		widthFixed: true,
		headerTemplate : '{content} {icon}', 
		widgets : [ "uitheme", "filter", "zebra" ],
		widgetOptions : {
			zebra : ["even", "odd"],
			filter_reset : ".reset"
		},
		headers: {
	    }
	})
});

$(document).ready(function(){

	$('.datepicker').datepicker({'format':'dd-mm-yyyy'});
	// var editor =  $('.textarea').wysihtml5({
	// 	"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
	// 	"emphasis": true, //Italics, bold, etc. Default true
	// 	"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
	// 	"html": true, //Button which allows you to edit the generated HTML. Default false
	// 	"link": true, //Button to insert a link. Default true
	// 	"image": false, //Button to insert an image. Default true,
	// 	"color": false //Button to change color of font  
	// });

	// editor.on("load", function() {
	//    editor.focus();
	//    editor.composer.commands.exec("insertHTML", "<a href='#'>asdasd</a>");
	// });
});