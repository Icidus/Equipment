$(document).ready(function() {
	
	$(".location").on("click", function() {
        getRecords($(this).attr("id"));
    });
    
       
    $(document).on('click', '.delete', function(b){
	   b.preventDefault();
	   if (confirm("Are you sure?")) {
	   	 removeRecords($(this).attr("id"));
    	}
		return false;
    }); 
    
   $(document).on('submit', '.equip', function(b){
	   b.preventDefault();
	   updateRecords($(this).attr("id"));
    });
    
    $(document).on('submit', '.new', function(b){
	   b.preventDefault();
	   addRecords();
    });

});	


function getRecords(id)
{
	$.ajax({
        dataType: "json",
        url: "process.php?action=getRecords",
        data: "loc=" + id,
        success: function(response) {
	         var b = "";
	         	b += '<div class="table">';
	         	b += '<div class="table-row">';
	         	b += '<div class="table-head">Local Image</div>';
	         	b += '<div class="table-head">System ID</div>';
	         	b += '<div class="table-head">Title</div>';
	         	b += '<div class="table-head">Owner</div>';
	         	b += '<div class="table-head">Sort Order</div>';
	         	b += '<div class="table-head"></div>';
	         	b += '<div class="table-head"></div>';
	         	b += '</div>';
	          	b += '<form class="new form-inline table-row" role="form" method="post">';
	          	b += '<span class="local table-cell"><i class="fa fa-plus-circle"></i></span>';
                b += '<div class="table-cell"><div class="form-group">';
                b += '<label for="new_id" class="sr-only">Name</label>';
                b += '<input size="9" type="text" class="form-control" name="new_id" id="new_id" value="">';
                b += '</div></div>';
                b += '<div class="table-cell"><div class="form-group">';
                b += '<label for="new_title" class="sr-only">Title</label>';
                b += '<input type="text" class="form-control" name="new_title" id="new_title" value="">';
                b += '</div></div>';
                b += '<div class="table-cell"><div class="form-group">';
                b += '<label for="new_owner" class="sr-only">Owner</label>';
                b += '<input size="2" type="text" class="form-control" name="new_owner" id="new_owner" value='+id+'>';
                b += '</div></div>';
                b += '<div class="table-cell"><div class="form-group">';
                b += '<label for="new_sort_order" class="sr-only">Sort Order</label>';
                b += '<input size="4" type="text" class="form-control" name="new_sort" id="new_sort" value="">';
                b += '</div></div>';
                b += '<div class="table-cell"><button type="submit" class="btn btn-primary add">Add</button></div>';
                b += '</form>';
            $.each(response, function(i, result) {
	            if(result.result !== 'false') {
	            b += '<form id="'+result.id+'" class="equip form-inline table-row" role="form" method="post">';
	            b += '<span class="local table-cell">' + result.image + '</span>';
                b += '<div class="table-cell"><div class="form-group">';
                b += '<label for="id" class="sr-only">Name</label>';
                b += '<input type="text" class="form-control" name="id" id="id'+result.id+'" value='+ result.id + '>';
                b += '</div></div>';
                b += '<div class="table-cell"><div class="form-group">';
                b += '<label for="title" class="sr-only">Title</label>';
                b += '<input type="text" class="form-control" name="title" id="title'+result.id+'" value="'+ result.title + '">';
                b += '</div></div>';
                b += '<div class="table-cell"><div class="form-group">';
                b += '<label for="owner" class="sr-only">Owner</label>';
                b += '<input size="2" type="text" class="form-control" name="owner" id="owner'+result.id+'" value='+ result.owner + '>';
                b += '</div></div>';
                b += '<div class="table-cell"><div class="form-group">';
                b += '<label for="sort_order" class="sr-only">Sort Order</label>';
                b += '<input size="4" type="text" class="form-control" name="sort" id="sort'+result.id+'" value='+ result.sort + '>';
                b += '</div></div>';
                b += '<div class="btn-group table-cell" role="group">';
                b += '<button type="submit" class="btn btn-primary edit">Save</button>';
                b += '<button type="submit" id="'+result.id+'"class="btn btn-danger delete">Delete</button>';
                b += '</div>';
                b += '</form>';
/*
                b += '<td><input type="text" class="form-control" value="'+ result.title + '"></td>';
                b += '<td><input type="text" class="form-control" value='+ result.sort + '></td>';
                b += '</tr></tbody>';
                
*/
				}
  	         });
  	         b += '</div>';

  	         $(".data").fadeIn(533).html(b);       
        }
    })
}

function updateRecords(id)
{
    var b = $("#" + id).serialize();
    $.post("process.php?action=updateRecords", b, function(a) {  
        getRecords(a.loc);   
    });
}

function addRecords()
{
    var b = $(".new").serialize();
    var owner = this.new_owner;
    $.post("process.php?action=addRecords", b, function(a) {
	    getRecords(a.loc);
    });
}

function removeRecords(id)
{
	var b = $("#" + id).serialize();
	$.post("process.php?action=deleteRecords", b, function(a) {
	    getRecords(a.loc);
    });
}