$(document).ready(function() {

  	var exercise_data = null;

	$(document).on('click','#add-exercise', function() {


		$("<div class='form-group'> <div class='col-sm-6'> <select name='exercise_id[]' class='form-control exercise-select new-exercise'> </select> </div>\
			<div class='col-sm-2'> <input name='series[]' class='exercise-series form-control' type=text value=0 /> </div> \
		<div class='col-sm-2'> <input name='reps[]' class='exercise-reps form-control col-sm-2' type=text value=0 /> </div>\
		<div class='col-sm-2'> <input name='duration[]' class='exercise-time form-control col-sm-2' type=text value=0 /> </div> </div> ").insertBefore('#add-exercise');


		if (exercise_data == null) {

	  		$.ajax({
		        url: "/exercise/all",
		        type: "get",
		    
		        success: function(response){

		        	
		        	var data = [];
		        	var data_by_id = [];

		        	for (var i in response.data) {
		        		
		        		exercise = {};

		        		exercise.id = response.data[i]['id'];
		        		exercise.text = response.data[i]['name'];
		        		exercise.time = response.data[i]['time'];
		        	
		        		//Data for select2
		        		data.push(exercise);

		        	}
		        	
					$(".new-exercise").select2({ 
						data: data,
						width: '100%'
					});

					prepareNewExerciseInputs();




					// indexed 0.. n-1 ( for select2, should raise a bug about that...)
					exercise_data = data; 
					   	
		        },

		        error:function(){

		        }
		    });


		} else {

			$(".new-exercise").select2({ 
				data: exercise_data,
				width: '100%'
			});

			prepareNewExerciseInputs();


			$(".new-exercise").removeClass('new-exercise');		
		}
	
	});

	
	$(document).on('change', '.exercise-select', function() {

		var time = $(this).select2('data')[0].time;

		if (time == 0) {
			
			$(this).parent().parent().find('.exercise-time').hide();
			$(this).parent().parent().find('.exercise-reps').show();
			$(this).parent().parent().find('.exercise-series').show();			
		} else {
			
			$(this).parent().parent().find('.exercise-time').show();
			$(this).parent().parent().find('.exercise-reps').hide();
			$(this).parent().parent().find('.exercise-series').hide();
		}

	});



 	$('form.ajax-training').on('submit', function(event) {

 		
 		event.preventDefault();

 		
      event.preventDefault();

      var formData = $(this).serialize(); // form data as string
      var formAction = $(this).attr('action'); // form handler url
      var formMethod = $(this).attr('method'); // GET, POST
      var formRedirect = $(this).data('redirecturl');

        $.ajax({
            type     : formMethod,
            url      : formAction,
            data     : formData,
            cache    : false,

            beforeSend : function() {
                
            },

            success  : function(data) {

            	$('#training_template_id').val(data.id);
              window.location.href = formRedirect;

            },

            error : function() {
            
            }
        })

    return false;
  });

	function prepareNewExerciseInputs() {

		var time = $(".new-exercise").select2('data')[0].time;

		if (time == 0) {
			
			$(".new-exercise").parent().parent().find('.exercise-time').hide();
			$(".new-exercise").parent().parent().find('.exercise-reps').show();
			$(".new-exercise").parent().parent().find('.exercise-series').show();			
		} else {
			
			$(".new-exercise").parent().parent().find('.exercise-time').show();
			$(".new-exercise").parent().parent().find('.exercise-reps').hide();
			$(".new-exercise").parent().parent().find('.exercise-series').hide();
		}

		$(".new-exercise").removeClass('new-exercise');			
	}
	

});
 