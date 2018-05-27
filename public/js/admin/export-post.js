$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $("#classes-selection").change(function(e){
    	// alert($("#classes-selection").val());
    	if (0 == $("#classes-selection").val()) {
    		$("#lesson-log-selection").html("<option>选择上课记录</option>");
    		return;
    	}
    	$.ajax({
            type: "POST",
            url: '/admin/load-lesson-log-info',
            data: {sclassesId: $("#classes-selection").val()},
            success: function( data ) {
            	$("#lesson-log-selection").html(data);
            	// console.log(data);
            }
        });
    });

    $("#export-btn").click(function(e){
        $.ajax({
            type: "POST",
            url: '/admin/export-post-files',
            data: {exportDir: $("#output-dir").val(), sclassesId: $("#classes-selection").val(), lessonlogsId: $("#lesson-log-selection").val()},
            success: function( data ) {
                // $("#lesson-log-selection").html(data);
                console.log(data);

            }
        });
    });

    $("#lesson-log-selection").change(function(e){
    	// alert("asasas");
    	$('#posts-list').bootstrapTable("refresh");
    	$('#posts-list').bootstrapTable({
	        method: 'post', 
	        search: "true",
	        url: "/admin/load-post-list",
	        pagination:"true",
	        pageList: [55, 60], 
	        pageSize: 55,
	        pageNumber: 1,
	        toolbar:"#toolbar",
        	queryParams: function(params) {
        		var temp = { 
			        lessonlogsId : $("#lesson-log-selection").val(),
			    };
			    return temp;
        	},
        	clickToSelect: true,
        	columns: [{  
                        checkbox: true  
                    },{  
                        title: '序号',
                        formatter: function (value, row, index) {  
                            return index+1;  
                        }  
                    }],
	        responseHandler: function (res) {
	        	// console.log(res);
	            return res;
	        },
	    });
    });
});

function genderCol(value, row, index) {
    return [
        '<span>'+(("0" == value)?"女":"男")+'</span>'
    ].join('');
}

function commentCol(value, row, index) {
    return [
        '<span>'+((value)?"有":"－")+'</span>'
    ].join('');
}

function classTitleCol(value, row, index) {
    return [
        "<span>" + row["enter_school_year"] + "级" + row["class_title"] + '班</span>'
    ].join('');
}