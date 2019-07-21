$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$("[name='sclasses_id']").on("change", function(e) {
		checkSelection();
	});

	// $("[name='lessons_id']").on("change", function(e) {
	// 	checkSelection();
	// });

	$(".class-btn").on("click", function(e) {
		e.preventDefault();
		if (!$("#lessons-id").val()) {
			alert("请先选择课程");
			return;
		}
		$(".class-btn").removeClass("btn-primary");
		$(this).addClass("btn-primary");
		$("#sclasses-id").val($(this).val());
		checkSelection();
	});

	$("#submit-btn").on("click", function(e) {
		e.preventDefault();
		var sclassesId = $("#sclasses-id").val();
		var lessonsId = $("#lessons-id").val();
		alert(sclassesId + "  "  + lessonsId);
		$.ajax({
            type: "POST",
            url: '/teacher/createLessonLog',
            data: {sclassesId: sclassesId, lessonsId: lessonsId},
            success: function( data ) {
                if ("false" != data) {
                }
            }
        });
	});
});

function checkSelection() {
	var sclassesId = $("#sclasses-id").val();
	var lessonsId = $("#lessons-id").val();
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