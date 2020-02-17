<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Reservation;
use Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->params = array(
            'menu' => 'reservations'
        );
    }

    public function index()
    {
        // $products = Product::pluck('name', 'id');
        // $this->params['products'] = $products;

        $reservations = Reservation::all();
        $this->params['reservations'] = $reservations;
        return view('reservation.index')->with($this->params);
    }

    public function edit($id)
    {
        $products = Product::pluck('name', 'id');
        $this->params['products'] = $products;
        $reservation = Reservation::where('id',$id)->with('reservation_item')->with('client')->first();
        $this->params['reservation'] = $reservation;
        // return $this->params;
        return view('reservation.edit')->with($this->params);
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        $rules = array(
            'classification'    => 'required|string|max:255',            
            'status'            => 'required|boolean',            
        );
        // Validate data
        $validator = Validator::make( $request->all(), $rules );
        if ( $validator->fails() ) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $reservation->classification = $request->get('classification');
        $reservation->status         = $request->get('status');

        $reservation->save();

        return redirect()->back()->withSuccess("Successfully updated!");


    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();

        return redirect()->back()->withSuccess('Reservation Successfully Deleted!');
    }
}
