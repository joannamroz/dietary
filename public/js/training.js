$(document).ready(function() {

  	var exercise_data = null;

	$(document).on('click','#add-exercise', function() {


		$("<div class='form-group'> <div class='col-sm-6'> <select name='exercise[]' class='form-control exercise-select new-exercise'> </select> </div>\
			<div class='col-sm-2'> <input name='exercise-series[]' class='exercise-series form-control' type=text value=0 /> </div> \
		<div class='col-sm-2'> <input name='exercise-reps[]' class='exercise-reps form-control col-sm-2' type=text value=0 /> </div>\
		<div class='col-sm-2'> <input name='exercise-time[]' class='exercise-time form-control col-sm-2' type=text value=0 /> </div> </div> ").insertBefore('#add-exercise');


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

					prepareNewExercisegInputs();




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

			prepareNewExercisegInputs();


			$(".new-exercise").removeClass('new-exercise');		
		}
	
	});

	
	$(document).on('change', '.exercise-select', function() {

		var time = $(this).select2('data')[0].time;

		if (time == 0) {
			//console.log($(this).parent().parent().find('.exercise-time'));
			$(this).parent().parent().find('.exercise-time').hide();
			$(this).parent().parent().find('.exercise-reps').show();
			$(this).parent().parent().find('.exercise-series').show();			
		} else {
			//console.log($(this).parent().parent().find('.exercise-reps'));
			$(this).parent().parent().find('.exercise-time').show();
			$(this).parent().parent().find('.exercise-reps').hide();
			$(this).parent().parent().find('.exercise-series').hide();
		}

	});



 	$('form.ajax-training').on('submit', function(event) {

 		//alert('aha');

 		event.preventDefault();

 		//return false;

            event.preventDefault();
          //  return false;
            var formData = $(this).serialize(); // form data as string
            var formAction = $(this).attr('action'); // form handler url
            var formMethod = $(this).attr('method'); // GET, POST

            $.ajax({
                type     : formMethod,
                url      : formAction,
                data     : formData,
                cache    : false,

                beforeSend : function() {
                    
                },

                success  : function(data) {

                	$('#training_template_id').val(data.id);
               //     return false;
                    //$('form.ajax')[0].reset();
                   // $('.use-select2-food').trigger('change');
                   // $('.use-select2-addFoodForUser').trigger('change');
                    
//
                  //  $('.select2').val('').trigger('change');
                   // updateMealsList();

                },

                error : function() {
                //	return false;
                }
            })

            return false;
        });

	function prepareNewExercisegInputs() {

		var time = $(".new-exercise").select2('data')[0].time;

		if (time == 0) {
			//console.log($(this).parent().parent().find('.exercise-time'));
			$(".new-exercise").parent().parent().find('.exercise-time').hide();
			$(".new-exercise").parent().parent().find('.exercise-reps').show();
			$(".new-exercise").parent().parent().find('.exercise-series').show();			
		} else {
			//console.log($(this).parent().parent().find('.exercise-reps'));
			$(".new-exercise").parent().parent().find('.exercise-time').show();
			$(".new-exercise").parent().parent().find('.exercise-reps').hide();
			$(".new-exercise").parent().parent().find('.exercise-series').hide();
		}

		$(".new-exercise").removeClass('new-exercise');			
	}
	


	//$('#add-exercise').trigger('click');
	
});
 