<?php

namespace App\Http\Controllers;

use Log;
use App\Food;
use App\Brand;
use App\User;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
 
use Illuminate\Http\Request;
class BrandsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index() 
  {
      
    $brands = Brand::all();
   
    return view('brands.index')->withBrands($brands);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(Request $request) 
  {

    return view('brands.create');

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(BrandFormRequest $request) 
  {

    $brand = new Brand(); 
    $brand->name = $request->get('name');
    $brand->user_id = $request->user()->id;
    $brand->save();
    $message = "Brand has been successfully added";

   return redirect('/brand/index')->withMessage($message);

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Request $request, $id) 
  {
    $brand = Brand::where('id', $id)->first();
    $brand_foods = Food::where('brand_id', $id)->get();
   

    return view('brands.show')->with('brand', $brand)->with('brand_foods',  $brand_foods);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Request $request,$id) 
  {
      
    $brand = Brand::where('id',$id)->first();
    if ($brand && ($request->user()->id == $brand->user_id || $request->user()->is_admin()))
      return view('brands.edit')->with('brand', $brand);
    return redirect('/brand/index')->withErrors('You have not sufficient permissions');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request) 
  {

    $brand_id = $request->input('brand_id');
    $brand = Brand::find($brand_id);
    if ($brand && ($brand->user_id == $request->user()->id || $request->user()->is_admin())) {

      $brand->name = $request->input('name');  

      if ($request->has('save')) {

        $message = 'Brand saved successfully';
        $landing = 'brand/index';  
      }         
      
      $brand->save();
        return redirect($landing)->withMessage($message);
    } else {

      return redirect('/brand/index')->withErrors('You have not sufficient permissions');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request, $id)
  {

    $brand = Brand::find($id);

    if ($brand && ($brand->user_id == $request->user()->id || $request->user()->is_admin())) {

      $brand->delete();
      $data['message'] = 'Brand deleted Successfully';

    } else  {

      $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
    }
    
    return redirect('/brand/index')->with($data);
  }
}
