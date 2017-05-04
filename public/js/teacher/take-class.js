$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $('#close-lesson-log').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/teacher/updateLessonLog',
            data: {lessonLogId: $("#lesson-log-id").val(), action: "close-lesson-log"},
            success: function( data ) {
            	// alert(data);
                if ("true" == data) {
                	window.location.href = "/teacher/";
                } else {
                	alert('关闭失败!');
                }
            }
        });
    });

    $('.btn-success').on('click', function (e) {
        // alert(e.target.value);
        var postsId = (e.target.value).split(',')[0]; 
        var filePath = (e.target.value).split(',')[1]; 
        $('#post-show').attr("src", filePath);
        $('#myModal').modal();
    });
});