$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$(".sclass-btn").click(function(e) {
		$("#group-list-title").text($(this).text() + " 班级分组列表");
		$('#group-list').bootstrapTable('destroy');
		// console.log($(this).val());
		var sclassesId = $(this).val();
		$("#create-group-btn").val($(this).val());
		$('#group-list').bootstrapTable({
	        method: 'post', 
	        search: "true",
	        url: "/school/getGroupsInSclass",
	        pagination:"true",
	        pageList: [10, 25, 50], 
	        pageSize: 10,
	        pageNumber: 1,
	        toolbar:"#toolbar",
        	queryParams: function(params) {
        		var temp = { 
			        sclasses_id : sclassesId
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

    $("#create-group-btn").click(function(e) {
        // alert($(this).val());
        $("#add-new-group-modal").modal("show");
    });

    $("#confirm-add-new-btn").click(function(e) {
        if("" == $("#group-name").val())
        {
            alert("组名不能为空！");
            return;
        }
        data = {
            'group_name' : $("#group-name").val(),
            'group_desc' : $("#group-desc").val(),
            'order_num' : $("#order-num").val(),
            'sclasses_id' : $("#create-group-btn").val(),
        }
        $.ajax({
            type: "POST",
            url: '/school/createGroupInSclass',
            data: data,
            success: function( data ) {
                $("#add-new-group-modal").modal("hide");
                $('#group-list').bootstrapTable('refresh');
            }
        });
    });

    $("#add-student-btn").click(function(e) {
        $.ajax({
            type: "POST",
            url: '/school/getStudentsInSclassButNotInGroupsBtns',
            data: {'sclasses_id' : $("#create-group-btn").val()},
            success: function( data ) {
            	$("#student-list-btn").html(data);
            }
        });

        $("#add-students-modal").modal("show");
    });

    $(document)
	   	.on('click', '.student-btn', function (e) {
	   		e.preventDefault();
            var orderInGroup = $('#student-list').bootstrapTable("getOptions").totalRows + 1;
	   		if ($(this).hasClass("btn-success")) {
	   			$(this).removeClass("btn-success");
	   			$(this).addClass("btn-primary");
	   			removeOneStudentOutGroup($(this).val());
	   		} else {
	   			$(this).removeClass("btn-primary");
		   		$(this).addClass("btn-success");
		   		$.ajax({
		            type: "POST",
		            url: '/school/addOneStudentIntoGroup',
		            data: {'groups_id' : $("#add-student-btn").val(), 'students_id' : $(this).val(), 'order_in_group' : orderInGroup},
		            success: function( data ) {
		            	$('#student-list').bootstrapTable('refresh');
		            }
		        });
	   		}
	   	});
});

function removeOneStudentOutGroup(id) {
	$.ajax({
        type: "POST",
        url: '/school/removeOneStudentOutGroup',
        data: {'students_id' : id},
        success: function( data ) {
        	$('#student-list').bootstrapTable('refresh');
        }
    });
}

function genderCol(value, row, index) {
    return [
        '<span>'+(("0" == value)?"女":"男")+'</span>'
    ].join('');
}

function classTitleCol(value, row, index) {
    return [
        "<span>" + row["enter_school_year"] + "级" + row["class_title"] + '班</span>'
    ].join('');
}

function groupActionCol(value, row, index) {
    return [
        ' <a class="btn btn-danger btn-sm edit">编辑</a> ',
        ' <a class="btn btn-danger btn-sm detail">详细</a> ',
        ' <a class="btn btn-danger btn-sm del">解散</a>'
    ].join('');
}

window.groupActionEvents = {
    'click .edit': function(e, value, row, index) {
        console.log("click edit students id "+row.id);
    },
    'click .detail': function(e, value, row, index) {
    	$("#add-student-btn").val(row.id);
    	$('#student-list').bootstrapTable('destroy');
        $('#student-list').bootstrapTable({
            method: 'post', 
            search: "true",
            url: "/school/getStudentsInGroup",
            pagination:"true",
            pageList: [10, 25, 50], 
            pageSize: 35,
            pageNumber: 1,
            toolbar:"#toolbar",
            queryParams: function(params) {
                var temp = { 
                    groupsId: row.id, 
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
    },
    'click .del': function(e, value, row, index) {
		if (confirm("确定解散一个小组吗？")) {
			$.ajax({
		        type: "POST",
		        url: '/school/removeOneGroup',
		        data: {'groups_id' : row.id},
		        success: function( data ) {
		        	$('#student-list').bootstrapTable('refresh');
		        	$('#group-list').bootstrapTable('refresh');
		        }
		    });
		}
        
    },
}

function studentActionCol(value, row, index) {
    return [
        ' <a class="btn btn-danger btn-sm edit">编辑</a> ',
        ' <a class="btn btn-danger btn-sm del">离开</a>'
    ].join('');
}

window.studentActionEvents = {
    'click .edit': function(e, value, row, index) {
        console.log("click edit students id "+row.studentsId);
    },
    'click .del': function(e, value, row, index) {
    	removeOneStudentOutGroup(row.id);
    },
}
