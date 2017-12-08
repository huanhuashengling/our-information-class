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
<<<<<<< HEAD
	            type: "GET",
=======
	            type: "POST",
>>>>>>> 20171104_MultiAuth
	            url: '/teacher/getLessonPostPerSclass',
	            data: {lessons_id: lessonsId},
	            success: function( data ) {
	            	// console.log(data);
	            	$("#lesson"+lessonsId).closest(".panel-body").html(data);
	            }
	        });
        })
});