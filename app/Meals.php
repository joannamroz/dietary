<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Meals extends Model {
 
	protected $guarded = [];

	public function food() {
		
		return $this->belongsTo('App\Foods');
	}

	public static function getMealsWithTotals($selectedDate, $user_id) {

		$meals = Meals::select( \DB::raw('*, meals.id as meal_id') ) 
				->leftJoin('foods', 'meals.food_id', '=', 'foods.id')
				->where('planed_food', '0')
				->where('date', $selectedDate)
				->where('meals.user_id', $user_id)
				->orderBy('meals.created_at','desc')
				->paginate(100);

		$meals_planed = Meals::select( \DB::raw('*, meals.id as meal_id') ) 
				->leftJoin('foods', 'meals.food_id', '=', 'foods.id')
				->where('planed_food', '1')
				->where('date', $selectedDate)
				->where('meals.user_id', $user_id)
				->orderBy('meals.created_at','desc')
				->paginate(100);

		$totals = [
			'sum_weight' => 0,
			'sum_kcal' => 0,
			'sum_proteins' => 0,
			'sum_carbs' => 0, 
			'sum_fibre' => 0,
			'sum_fats' => 0
		];

		$totals_planed = [
			'sum_weight' => 0,
			'sum_kcal' => 0,
			'sum_proteins' => 0,
			'sum_carbs' => 0, 
			'sum_fibre' => 0,
			'sum_fats' => 0
		];


		foreach($meals as $meal) {
			$totals['sum_weight'] += $meal['weight'];
			$totals['sum_kcal'] += $meal['kcal'] * $meal['weight'] / 100;
			$totals['sum_proteins'] += $meal['proteins'] * $meal['weight'] / 100;
			$totals['sum_carbs'] += $meal['carbs'] * $meal['weight'] / 100;
			$totals['sum_fats'] += $meal['fats'] * $meal['weight'] / 100;	
			$totals['sum_fibre'] += $meal['fibre'] * $meal['weight'] / 100;
					
		}
		
		foreach($meals_planed as $meal) {
			$totals_planed['sum_weight'] += $meal['weight'];
			$totals_planed['sum_kcal'] += $meal['kcal'] * $meal['weight'] / 100;
			$totals_planed['sum_proteins'] += $meal['proteins'] * $meal['weight'] / 100;
			$totals_planed['sum_carbs'] += $meal['carbs'] * $meal['weight'] / 100;
			$totals_planed['sum_fats'] += $meal['fats'] * $meal['weight'] / 100;	
			$totals_planed['sum_fibre'] += $meal['fibre'] * $meal['weight'] / 100;
					
		}


		//TODO calculate totals above.
		//$totals = [];
		return ['meals'=>$meals, 'meals_planed'=>$meals_planed, 'totals'=>$totals, 'totals_planed'=>$totals_planed];
	}

}
