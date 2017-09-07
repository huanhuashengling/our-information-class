$(document).ready(function() {
    $("#import-student-account").fileinput({
    		language: "zh", 
    		allowedFileExtensions: ["jpg", "png", "gif"],
    		showPreview: false,
    		// uploadUrl: "student/upload",
    		// uploadAsync: true
    	});
});