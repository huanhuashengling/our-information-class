$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$("[name='no_post_sclasses_id']").on("change", function(e) {
		var sclassesId = $("[name='no_post_sclasses_id']").val();
		if(0 !=  sclassesId) {
			// alert(sclassesId + " --- " +lessonsId);
			$.ajax({
	            type: "POST",
	            url: '/teacher/getNoPostReport',
	            data: {sclassesId: sclassesId},
	            success: function( data ) {
	                // console.log(data);
	                $("#no-post-report").html(data);
	            }
	        });
		}
	});
});
