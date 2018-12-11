$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$("[name='score_report_sclasses_id']").on("change", function(e) {
		var sclassesId = $("[name='score_report_sclasses_id']").val();
		if(0 !=  sclassesId) {
			// alert(sclassesId + " --- " +lessonsId);
			// $('#score-report').bootstrapTable("refresh");

            $.ajax({
            type: "POST",
            url: '/teacher/getSclassTermsList',
            data: {sclassesId: sclassesId},
            success: function( data ) {
                // console.log(data);
                $("[name='score_report_terms_id']").html(data);
                // console.log($("[name='score_report_terms_id']"));
                $('#score-report').bootstrapTable("refresh");
            }
        });
		}
	});

    $("[name='score_report_terms_id']").on("change", function(e) {
        var termsId = $("[name='score_report_terms_id']").val();
        if(0 !=  termsId) {
            // alert(sclassesId + " --- " +lessonsId);
            $('#score-report').bootstrapTable("refresh");
        }
    });

	$('#email-all-out-btn').on("click", function(e) {
        // console.log($('#score-report').bootstrapTable('getSelections'));
        var data = $('#score-report').bootstrapTable('getSelections');
        for (var i = 0; i < data.length; i++) {
            if (data[i]["email"]) {
                emailOutStudentPostReport(data[i], i);
            }
        }
    });


	$('#score-report').bootstrapTable({
        method: 'post', 
        search: "true",
        url: "/teacher/getScoreReport",
        pagination:"true",
        pageList: [50, 30], 
        pageSize: 50,
        pageNumber: 1,
        toolbar:"#toolbar",
        showExport: true,                     //是否显示导出
        exportDataType: "basic",              //basic', 'all', 'selected'.
    	queryParams: function(params) {
    		var temp = { 
                sclassesId : $("[name='score_report_sclasses_id']").val(),
		        termsId : $("[name='score_report_terms_id']").val(),
		    };
		    return temp;
    	},
    	// clickToSelect: true,
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

function emailCol(value, row, index) {
    if (row.email) {
        return [
            '<a class="btn btn-info btn-sm email" data-unique-id="', row.users_id, '">发送</a>'
        ].join('');
    } else {
        return "无邮箱";
    }
}

window.emailActionEvents = {
    'click .email': function(e, value, row, index) {
        emailOutStudentPostReport(row, 1);
    },
}

function emailOutStudentPostReport(rowdata, emailCount) {
    var sclassesId = $("[name='score_report_sclasses_id']").val();
    var termsId = $("[name='score_report_terms_id']").val();
    $.ajax({
            type: "POST", 
            url: '/teacher/email-out',
            data: {sclassesId: sclassesId, termsId: termsId, rowdata: rowdata, emailCount: emailCount},
            success: function( data ) {
                console.log(data);
            }
        });
}
