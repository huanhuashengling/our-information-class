$(document).ready(function() {
    $("#import-student-account").fileinput({
		showPreview: false,
		language: "zh", 
		allowedFileExtensions: ["xls", "xlsx", "csv"],
	});

	$(".school-class-btn").click(function(e) {
		$('#student-list').bootstrapTable('destroy');
		// console.log($(this).val());
		var schoolClassName = $(this).val();

		$('#student-list').bootstrapTable({
	        method: 'get', 
	        search: "true",
	        url: "/admin/getStudentsData",
	        pagination:"true",
	        pageList: [10, 25, 50], 
	        pageSize: 10,
	        pageNumber: 1,
        	queryParams: function(params) {
        		var temp = { 
			        school_classes_title : schoolClassName
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
	        	console.log(res);
	            return res;
	        },
	    });
	});
});

function resetCol(value, row, index) {
    return [
        '<a class="btn btn-info btn-sm" data-unique-id="', row.id, '">重置</a>'
    ].join('');
}

function postsCol(value, row, index) {
    return [
        '<a class="btn btn-info btn-sm" data-unique-id="', row.id, '">查看</a>'
    ].join('');
}

function actionCol(value, row, index) {
    return [
        '<a class="btn btn-warning btn-sm">锁定</a> ',
        ' <a class="btn btn-danger btn-sm">编辑</a> ',
        ' <a class="btn btn-danger btn-sm">删除</a>'
    ].join('');
}
