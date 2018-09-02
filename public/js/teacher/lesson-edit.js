$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

    $("select[name='courses_id']").change(function(e) {
    	// alert($("select[name='courses_id']").val());
    	$.ajax({
            type: "POST",
            url: '/teacher/get-unit-list-by-courses-id',
            data: {coursesId: $("select[name='courses_id']").val()},
            success: function( data ) {
            	// console.log(data);
            	$("#units-id").html(data);
            }
        });
    });
});