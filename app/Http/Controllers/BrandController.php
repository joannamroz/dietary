<?php

namespace App\Http\Controllers;

use Log;
use App\Foods;
use App\Brands;
use App\User;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
 
use Illuminate\Http\Request;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        
        $brands = Brands::all();
        //page heading
        $title = 'Brand List';
        //return home.blade.php template from resources/views folder
        return view('brands.index')->withBrands($brands)->withTitle($title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request) {

        if ($request->user()->can_add_brand()) {

          return view('brands.create');

        } else {
            
          return redirect('/brand/index')->withErrors('You have not sufficient permissions for adding new brand.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(BrandFormRequest $request) {

        $brand = new Brands(); 
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
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request,$id) {
        
        $brand = Brands::where('id',$id)->first();
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
    public function update(Request $request) {

        $brand_id = $request->input('brand_id');
        $brand = Brands::find($brand_id);
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
    public function destroy(Request $request, $id) {

        $brand = Brands::find($id);

        if ($brand && ($brand->user_id == $request->user()->id || $request->user()->is_admin())) {

          $brand->delete();
          $data['message'] = 'Brand deleted Successfully';

        } else  {

          $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }
        
        return redirect('/brand/index')->with($data);
    }
}
