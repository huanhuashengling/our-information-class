$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	getPostCountPerClassWithSameGradeData1();
	getPostCountPerClassWithSameGradeData2();
	getMarkCountPerClassWithSameGradeData1();
	getMarkCountPerClassWithSameGradeData2();
	
});

function getPostCountPerClassWithSameGradeData1() {
	$.ajax({
        type: "GET",
        url: '/school/get-post-count-per-class-same-grade-data-1',
        success: function( returndata ) {

            var alldataset = JSON.parse(returndata);
            // console.log(alldataset);
            var colorNames = Object.keys(window.chartColors);
            var lessonsData = alldataset["lessonsData"];
            var postsData = alldataset["postsData"];
            var labelSet = [];
            var returndatasets = [];
			for(var i=0; i<lessonsData.length; i++) {
				labelSet.push(lessonsData[i].title);
			}

			for(var i=0; i<postsData.length; i++) {
				var postDataItem = postsData[i];
				var countdata = [];
				var colorName = colorNames[i % colorNames.length];
				var newColor = window.chartColors[colorName];
				for(var j=0; j<postDataItem.data.length; j++) {
					// console.log(postDataItem.data[j][0]["count"]);
					countdata.push(postDataItem.data[j][0]["count"]);

				}
				var datasetitem = {
					label: postDataItem.label,
					fill: false,
					backgroundColor: newColor,
			        borderColor: newColor,
			        data: countdata,
				}
				returndatasets.push(datasetitem);
			}
			// console.log(labelSet);
			var ctx = document.getElementById('posts-count-per-class-same-grade-chart-1').getContext('2d');
			var chart = new Chart(ctx, {
			    // 要创建的图表类型
			    type: 'line',

			    // 数据集
			    data: {
			        labels: labelSet,
			        datasets: returndatasets,
			    },

			    // 配置项
			    options: {
				datasetFill : false,
			}
			});
        }
    });
}

function getPostCountPerClassWithSameGradeData2() {
	$.ajax({
        type: "GET",
        url: '/school/get-post-count-per-class-same-grade-data-2',
        success: function( returndata ) {

            var alldataset = JSON.parse(returndata);
            // console.log(alldataset);
            var colorNames = Object.keys(window.chartColors);
            var lessonsData = alldataset["lessonsData"];
            var postsData = alldataset["postsData"];
            var labelSet = [];
            var returndatasets = [];
			for(var i=0; i<lessonsData.length; i++) {
				labelSet.push(lessonsData[i].title);
			}

			for(var i=0; i<postsData.length; i++) {
				var postDataItem = postsData[i];
				var countdata = [];
				var colorName = colorNames[i % colorNames.length];
				var newColor = window.chartColors[colorName];
				for(var j=0; j<postDataItem.data.length; j++) {
					// console.log(postDataItem.data[j][0]["count"]);
					countdata.push(postDataItem.data[j][0]["count"]);

				}
				var datasetitem = {
					label: postDataItem.label,
					fill: false,
					backgroundColor: newColor,
			        borderColor: newColor,
			        data: countdata,
				}
				returndatasets.push(datasetitem);
			}
			// console.log(labelSet);
			var ctx = document.getElementById('posts-count-per-class-same-grade-chart-2').getContext('2d');
			var chart = new Chart(ctx, {
			    // 要创建的图表类型
			    type: 'line',

			    // 数据集
			    data: {
			        labels: labelSet,
			        datasets: returndatasets,
			    },

			    // 配置项
			    options: {
				datasetFill : false,
			}
			});
        }
    });
}

function getMarkCountPerClassWithSameGradeData1() {
	$.ajax({
        type: "GET",
        url: '/school/get-mark-count-per-class-same-grade-data-1',
        success: function( returndata ) {

            var alldataset = JSON.parse(returndata);
            // console.log(alldataset);
            var colorNames = Object.keys(window.chartColors);
            var lessonsData = alldataset["lessonsData"];
            var marksData = alldataset["marksData"];
            var labelSet = [];
            var returndatasets = [];
			for(var i=0; i<lessonsData.length; i++) {
				labelSet.push(lessonsData[i].title);
			}

			for(var i=0; i<marksData.length; i++) {
				var postDataItem = marksData[i];
				var countdata = [];
				var colorName = colorNames[i % colorNames.length];
				var newColor = window.chartColors[colorName];
				for(var j=0; j<postDataItem.data.length; j++) {
					// console.log(postDataItem.data[j][0]["count"]);
					countdata.push(postDataItem.data[j][0]["count"]);

				}
				var datasetitem = {
					label: postDataItem.label,
					fill: false,
					backgroundColor: newColor,
			        borderColor: newColor,
			        data: countdata,
				}
				returndatasets.push(datasetitem);
			}
			// console.log(labelSet);
			var ctx = document.getElementById('mark-count-per-class-same-grade-chart-1').getContext('2d');
			var chart = new Chart(ctx, {
			    // 要创建的图表类型
			    type: 'line',

			    // 数据集
			    data: {
			        labels: labelSet,
			        datasets: returndatasets,
			    },

			    // 配置项
			    options: {
				datasetFill : false,
			}
			});
        }
    });
}

function getMarkCountPerClassWithSameGradeData2() {
	$.ajax({
        type: "GET",
        url: '/school/get-mark-count-per-class-same-grade-data-2',
        success: function( returndata ) {

            var alldataset = JSON.parse(returndata);
            // console.log(alldataset);
            var colorNames = Object.keys(window.chartColors);
            var lessonsData = alldataset["lessonsData"];
            var marksData = alldataset["marksData"];
            var labelSet = [];
            var returndatasets = [];
			for(var i=0; i<lessonsData.length; i++) {
				labelSet.push(lessonsData[i].title);
			}

			for(var i=0; i<marksData.length; i++) {
				var postDataItem = marksData[i];
				var countdata = [];
				var colorName = colorNames[i % colorNames.length];
				var newColor = window.chartColors[colorName];
				for(var j=0; j<postDataItem.data.length; j++) {
					// console.log(postDataItem.data[j][0]["count"]);
					countdata.push(postDataItem.data[j][0]["count"]);

				}
				var datasetitem = {
					label: postDataItem.label,
					fill: false,
					backgroundColor: newColor,
			        borderColor: newColor,
			        data: countdata,
				}
				returndatasets.push(datasetitem);
			}
			// console.log(labelSet);
			var ctx = document.getElementById('mark-count-per-class-same-grade-chart-2').getContext('2d');
			var chart = new Chart(ctx, {
			    // 要创建的图表类型
			    type: 'line',

			    // 数据集
			    data: {
			        labels: labelSet,
			        datasets: returndatasets,
			    },

			    // 配置项
			    options: {
				datasetFill : false,
			}
			});
        }
    });
}