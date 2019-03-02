$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$("[name='sclasses_id']").on("change", function(e) {
		checkSelection();
	});

	$("[name='lessons_id']").on("change", function(e) {
		checkSelection();
	});

});

function checkSelection() {
	var sclassesId = $("[name='sclasses_id']").val();
	var lessonsId = $("[name='lessons_id']").val();
	if(0 !=  sclassesId && 0 != lessonsId) {
		// alert(sclassesId + " --- " +lessonsId);
		$.ajax({
            type: "POST",
            url: '/teacher/getLessonLog',
            data: {sclassesId: sclassesId, lessonsId: lessonsId},
            success: function( data ) {
                // console.log(data);
                if ("false" != data) {
                	alert("请注意，这节课你已经上过一次，已有"+data+"份作业，点击按钮课程将重新打开");
                }
            }
        });
	}
}