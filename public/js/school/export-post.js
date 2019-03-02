$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $("#term-selection").change(function(){
        if (0 == $("#term-selection").val()) {
            $("#lesson-log-selection").html("<option>请选择学期</option>");
            return;
        }

        $.ajax({
            type: "POST",
            url: '/school/loadSclassSelection',
            data: {terms_id: $("#term-selection").val()},
            success: function( data ) {
                // console.log(data);
                $("#sclasses-selection").html(data);
            }
        });
    });
    $("#sclasses-selection").change(function(e){
        $("#export-url").html("");
    	// alert($("#sclasses-selection").val());
    	if (0 == $("#sclasses-selection").val()) {
    		$("#lesson-log-selection").html("<option>选择上课记录</option>");
    		return;
    	}
    	$.ajax({
            type: "POST",
            url: '/school/load-lesson-log-info',
            data: {sclassesId: $("#sclasses-selection").val()},
            success: function( data ) {
            	$("#lesson-log-selection").html(data);
            	// console.log(data);
            }
        });
    });

    $("#export-btn").click(function(e){
        $("#export-url").html("");
        $.ajax({
            type: "GET",
            url: '/school/create-zip',
            data: {sclassesId: $("#classes-selection").val(), lessonlogsId: $("#lesson-log-selection").val()},
            success: function( data ) {
                // $("#lesson-log-selection").html(data);
                // console.log(data);
                $("#export-url").html("<br /> <a href='" + data + "'>" + data.split("/")[4] + "</a>");
            }
        });
    });

    $("#clear-btn").click(function(e){
        $("#export-url").html("");
        $.ajax({
            type: "GET",
            url: '/school/clear-all-zip',
            success: function( data ) {
                // console.log(data);
                if ("true" == data) {
                    alert("清除所有Zip文件成功！")
                }
            }
        });
    });

    $("#lesson-log-selection").change(function(e){
        $("#export-url").html("");
    	// alert("asasas");
    	$('#posts-list').bootstrapTable("refresh");
    	$('#posts-list').bootstrapTable({
	        method: 'post', 
	        url: "/school/load-post-list",
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