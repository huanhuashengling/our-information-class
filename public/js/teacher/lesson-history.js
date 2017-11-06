$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $(document)
        .on('click', '.panel-title', function(e) {
            e.preventDefault();
            var lessonsId = $(this).attr("value");
	        $.ajax({
	            type: "GET",
	            url: '/teacher/getLessonPostPerSclass',
	            data: {lessons_id: lessonsId},
	            success: function( data ) {
	            	// console.log(data);
	            	$("#lesson"+lessonsId).closest(".panel-body").html(data);
	            }
	        });
        })
});