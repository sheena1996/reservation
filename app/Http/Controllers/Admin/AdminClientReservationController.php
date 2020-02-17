<?php

namespace App\Http\Controllers\Admin;


use Auth;
use App\User;
use App\Client;
use App\Product;
use App\Reservation;
use App\ReservationItem;
use Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminClientReservationController extends Controller
{
    public function __construct()
    {
        $this->params = array(
            'menu' => 'users'
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $this->params['reservations'] = Reservation::where('client_id', $id)->with('reservation_item.product')->get();
        $this->params['client']  = Client::find($id);
        // return $this->params;
        return view('user.reservation')->with($this->params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $this->params['products'] = Product::all();
        $this->params['client']  = Client::find($id);
        // return $this->params;
        return view('user.reserve')->with($this->params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //

        $rules = array(
            'classification'       => 'required|string|max:255',            
            'product_ID'            => 'required|array',            
        );
        // Validate data
        $validator = Validator::make( $request->all(), $rules );
        if ( $validator->fails() ) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $total_cost = 0;
        foreach($request->product_ID as $product_id) {
            $products = Product::select('cost')->where('id', $product_id)->get();
            foreach($products as $product ) {
                $total_cost += $product->cost; 
            }
        }

        $reservation = new Reservation();
        $reservation->client_id = $id;
        $reservation->classification = $request->classification;
        $reservation->status = 0;
        $reservation->total_amount = $total_cost;
        $reservation->save();

        foreach($request->product_ID as $product_id) {
            $reservation_item = new ReservationItem();
            $reservation_item->reservation_id = $reservation->id;
            $reservation_item->product_id = $product_id;
            $reservation_item->notes = "LOREM";
            $reservation_item->save();

        }
        // return $this->params;
        return redirect()->back()->withSuccess("New reservation successfully added!");


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $reservation)
    {
        //
        $reservation = Reservation::where('id', $reservation);
        $reservation->delete();

        return redirect()->back()->withSuccess('Reservation Successfully Deleted!');
    }


    
}