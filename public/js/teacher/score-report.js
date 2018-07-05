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
                console.log($("[name='score_report_terms_id']"));
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
