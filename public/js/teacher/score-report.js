$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$("[name='no_post_sclasses_id']").on("change", function(e) {
		var sclassesId = $("[name='no_post_sclasses_id']").val();
		if(0 !=  sclassesId) {
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
    	queryParams: function(params) {
    		var temp = { 
		        sclassesId : $("[name='no_post_sclasses_id']").val(),
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
