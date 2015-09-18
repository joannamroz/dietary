$(document).ready(function() {

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});



	$(".use-select2").select2({
		
		width:'100%'
	});

	$(".use-select2-addFoodForUser").select2({
		placeholder:'Add for other user',
		width:'100%'
	});

	$(".use-select2-food").select2({
		placeholder:'Select food from the list',
		width:'100%'
	});
	

	//Calendar day click event
	$(document).on('click','.calendar-day', function() {




		$('#selectedDay').val($(this).children('.day-number').text());
		$('#selectedMonth').val($('.calendar').data('month'));		
		$('#selectedYear').val($('.calendar').data('year'));
		$('.calendar-day').removeClass('today');
		$(this).addClass('today');

	});

	$(document).on('click','.calendar-day', updateMealsList );

	$('#addMeasure').on('click', function() {
		$('#measureForm').toggle();
	});



 	$('form.ajax').on('submit', function(event) {

            event.preventDefault();

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
                    
                    $('form.ajax')[0].reset();
                    $('.use-select2-food').trigger('change');
                    $('.use-select2-addFoodForUser').trigger('change');
                    

                    $('.select2').val('').trigger('change');
                    updateMealsList();

                },

                error : function() {

                }
            })

            return false;
        });

		function updateMealsList() {

			var month = $('.calendar').data('month');
			var year = $('.calendar').data('year');

	  		var values = {
		    	'day':$('#selectedDay').val(),
		    	'month':month,
		    	'year':year
		    }

	  		$.ajax({
		        url: "/meal/ajax_meal",
		        type: "get",
		        data: values,
		        success: function(response){

		        	if(response.success == true){

		        		$('#meals-content').html(response.html);

		        	} else {

		        	}

		        },

		        error:function(){

		        }
		    });

  	}

  	var ingredient_data = null;

	$(document).on('click','#add-ingredient', function() {


		$("<div class='form-group'><select name='ingredient[]' class='form-control select2-ingredient new-ingredient'> </select> <input name='ingredient-weight[]' class='ingredient-weight form-control' type=text value=0 /> </div> ").insertBefore('#add-ingredient');


		if (ingredient_data == null) {

	  		$.ajax({
		        url: "/meal/all",
		        type: "get",
		    
		        success: function(response){

		        	
		        	var data = [];
		        	var data_by_id = [];

		        	for (var i in response.data) {
		        		
		        		food = {};

		        		food.id = response.data[i]['id'];
		        		food.text = response.data[i]['name'];
		        		food.kcal = response.data[i]['kcal'];
		        		food.proteins = response.data[i]['proteins'];
		        		food.carbs = response.data[i]['carbs'];
		        		food.fats = response.data[i]['fats'];
		        		food.fibre = response.data[i]['fibre'];

		        		//Data for select2
		        		data.push(food);

		        	}
		        	
					$(".new-ingredient").select2({ 
						data: data,
						width: '70%'
					});

					$(".new-ingredient").removeClass('new-ingredient');	
					
					// indexed 0.. n-1 ( for select2, should raise a bug about that...)
					ingredient_data = data; 
					   	
		        },

		        error:function(){

		        }
		    });


		} else {

			$(".new-ingredient").select2({ 
				data: ingredient_data,
				width: '70%'
			});

			$(".new-ingredient").removeClass('new-ingredient');		
		}
		



	});


	$(document).on("change", ".select2-ingredient", function (e) { 

		$("#divForTable").html(drawTable());
		addDataToInputs();
		
	});

	$(document).on("keyup", ".ingredient-weight", function (e) { 
	
		$("#divForTable").html(drawTable());
		addDataToInputs();
		
	});

	// Check if on page there is div with class need-meals-data if so then we run ajax request to get meals
    if ($('div.need-meals-data').length > 0) {
        
        loadMeals();
    }

	function loadMeals() {

		$.ajax({
	        url: "/meal/all",
	        type: "get",
	    
	        success: function(response){

	        	
	        	var data = [];
	        	var data_by_id = [];

	        	for (var i in response.data) {
	        		
	        		food = {};

	        		food.id = response.data[i]['id'];
	        		food.text = response.data[i]['name'];
	        		food.kcal = response.data[i]['kcal'];
	        		food.proteins = response.data[i]['proteins'];
	        		food.carbs = response.data[i]['carbs'];
	        		food.fats = response.data[i]['fats'];
	        		food.fibre = response.data[i]['fibre'];

	        		//Data for select2
	        		data.push(food);

	        	}
	        	
				$(".new-ingredient").select2( { 
					data: data, 
					theme: "bootstrap" 
				});

				$(".new-ingredient").removeClass('new-ingredient');	
				
				// indexed 0.. n-1 ( for select2, should raise a bug about that...)
				ingredient_data = data; 

			   	

	        },

	        error:function(){

	        }
		});
	}




	$('#addNewFood').on('mouseenter', function(){
		$(this).text('Add new food');
	});
	$('#addNewFood').on('mouseleave', function(){
		$(this).text(' + ');
	});

	function drawTable() {

		var table = 
			"<table class='table table-bordered'> \
				<tr> \
					<th >Name</th> \
					<th >Weight</th> \
					<th >Kcal</td> \
					<th >Proteins</th> \
					<th >Carbs</th> \
					<th >Fats</th> \
					<th >Fibre</th> \
				</tr>";

		$('.select2-ingredient').each( function(index) {

			
			var weight = $(this).next().next().val();

			var mealId = $(this).select2('data')[0].id;
			var mealName = $(this).select2('data')[0].text;
			var mealKcal = $(this).select2('data')[0].kcal * weight/100;
			var mealProteins = $(this).select2('data')[0].proteins * weight/100;
			var mealCarbs = $(this).select2('data')[0].carbs * weight/100;
			var mealFats = $(this).select2('data')[0].fats * weight/100;
			var mealFibre = $(this).select2('data')[0].fibre * weight/100;


			table += "<tr><td>"+mealName+"</td><td>"+weight+"</td><td>"+mealKcal+"</td><td>"+mealProteins+"</td><td>"+mealCarbs+"</td><td>"+mealFats+"</td><td>"+mealFibre+"</td></tr>";

		});

		table += "</table>";

		return table;
	}


	$('#compound_food').on('click',function() {
		$('.compound_food').show();
		if ($("#compound_food").is(':checked')) {
			$('.compound_food').show();
			$('.simple_food').hide();

		} else {

			$('.compound_food').hide();
			$('.simple_food').show();

		}

	});

	$('.planed_food').on("click", function() {

		if ($('.planed_food').is(':checked')) {


			$(".planed_food").val('1');


		} else {

			$('.planed_food').val('0');
		}
	});

	function addDataToInputs() {

		var kcal = 0;
		var proteins = 0;
		var carbs = 0;
		var fats = 0;
		var fibre = 0;
		var weight = 0;
		
		$('.select2-ingredient').each( function(index) { 
			
			var ingredient_weight = parseFloat($(this).next().next().val());

			weight += ingredient_weight;
			kcal += $(this).select2('data')[0].kcal * ingredient_weight / 100;
			proteins += $(this).select2('data')[0].proteins * ingredient_weight / 100;
			carbs += $(this).select2('data')[0].carbs * ingredient_weight / 100;
			fats += $(this).select2('data')[0].fats * ingredient_weight / 100;
			fibre += $(this).select2('data')[0].fibre * ingredient_weight / 100;

			$('input[name$="weight"]').val(weight);
			$('input[name$="kcal"]').val(kcal / weight * 100);
			$('input[name$="proteins"]').val(proteins / weight * 100);
			$('input[name$="carbs"]').val(carbs / weight * 100);
			$('input[name$="fats"]').val(fats / weight * 100);
			$('input[name$="fibre"]').val(fibre / weight * 100);
		});

	}

	//Initializing popver 
	$(function () {
  		$('[data-toggle="popover"]').popover()
	})
	
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})

	$(document).on('click','.fa-flag', function(){
		
		alert("Consumed? If not delete this position from your food list");
		var values = {
    		'id':$(this).data('meal-id')
 
    	}
    	$.ajax({
		        url: "/meal/planed",
		        type: "post",
		        data: values,
		        success: function(response){
		        	updateMealsList();
		        },
		        error:function(){

		        }
		    });

	});

	$('#btnNewBrand').on('click', function(){
		$('#brandForm').show();
		$('#btnNewBrand').hide();
	});
	$('#showRanges').on('click', function(){
		$('#rangesInfo').toggle('slow');
	});

	$('#calculateBMIBtn').on('click', calculateBMI);

	calculateBMI();
	function calculateBMI() {

		if (!$('#weightBMI').val() || !$('#heightBMI').val()) {
			
			return false;
		} else {
			var weight = $('#weightBMI').val();
			var height = $('#heightBMI').val();
			var result = weight/((height/100)*(height/100));
			result = parseFloat(result).toFixed(2);
			$('#resultBMI').val(result);
			
		}	
	};

	$('#calculateBMRBtn').on('click', function() {

		if (!$('#weightBMR').val() || !$('#heightBMR').val() || !$('#ageBMR').val() || !$('#sexBMR').val() || !$('#activityBMR').val()) {
			
			return false;
		} else {

			var weight = $('#weightBMR').val();
			var height = $('#heightBMR').val();
			var age = $('#ageBMR').val();
			var sex = $('#sexBMR').val();
			var activity = $('#activityBMR').val();

			if( sex == 'female') {
				var result = (655 + (9.6 * weight) + (1.8 * height) - (4.7 * age)) * activity;
			} else {

				var result = (66 + (13.7 * weight) + (5 * height) - (6.8 * age)) * activity;
			}
			result = parseFloat(result).toFixed(2);
			$('#resultBMR').val(result);		
		}	
	});
	
    $(function() {
       $( "#datepicker" ).datepicker({
       	dateFormat: "yy-mm-dd",
       	monthNames: [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ],
       	minDate: new Date(1915, 1 - 1, 1),
       	maxDate: "-1d",
       	yearRange: "1915:2015",
       	changeDay: true,
        changeMonth: true,
        changeYear: true
      });
    });
});
 
	