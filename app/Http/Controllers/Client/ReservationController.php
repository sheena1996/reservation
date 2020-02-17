<?php

namespace App\Http\Controllers\Client;

use Auth;
use App\Product;
use App\Client;
use App\Reservation;
use App\ReservationItem;
use App\User;
use Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function __construct()
    {
    
        $this->params = array(
            'menu' => 'reservations',
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $userID = Auth::User()->id;
        $client = Client::where('user_id', $userID)->first();
        $this->params['client'] = $client;
        $this->params['reservations'] = Reservation::where('client_id', $client->id )->get();
        // return $this->params;
        return view('client.index')->with($this->params);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $userID = Auth::User()->id;
        $client = Client::where('user_id', $userID)->first();
        $this->params['client'] = $client;
        $this->params['action'] = 'create';
        $this->params['products'] = Product::all();
        
        return view('client.reservation')->with($this->params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $userID = Auth::User()->id;
        $client = Client::where('user_id', $userID)->first();
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
        $reservation->client_id = $client->id;
        $reservation->classification = $request->classification;
        $reservation->status = 0;
        $reservation->total_amount = $total_cost;
        $reservation->save();

        foreach($request->product_ID as $product_id) {
            $reservation_item = new ReservationItem();
            $reservation_item->reservation_id = $reservation->id;
            $reservation_item->product_id = $product_id;
            $reservation_item->notes = "LOREM IPSUM DOLOR";
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

        $reservation_items = ReservationItem::where('reservation_id', $id)
            ->with( ['product' => function ($query) { $query->select('id'); }])->get();

        $productIDs = [];
        foreach($reservation_items as $item){
            $productIDs[] = $item->product->id;
        }
        
        $userID = Auth::User()->id;
        $client = Client::where('user_id', $userID)->first();
        $this->params['reservation_items'] = array_values($productIDs);
        $this->params['client'] = $client;
        $this->params['action'] = 'edit';
        $this->params['reservation'] = Reservation::find($id);
        $this->params['products'] = Product::all();
        // return $this->params;
        return view('client.reservation')->with($this->params);
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
        $reservation = Reservation::find($id);

        $userID = Auth::User()->id;
        $client = Client::where('user_id', $userID)->first();
        
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

        $reservation_items = ReservationItem::where('reservation_id', $id)->delete();

        $reservation->client_id = $client->id;
        $reservation->classification = $request->classification;
        $reservation->status = 0;
        $reservation->total_amount = $total_cost;
        $reservation->save();

        foreach($request->product_ID as $product_id) {
            $reservation_item = new ReservationItem();
            $reservation_item->reservation_id = $reservation->id;
            $reservation_item->product_id = $product_id;
            $reservation_item->notes = "LOREM IPSUM DOLOR";
            $reservation_item->save();
        }
        // return $this->params;
        return redirect()->back()->withSuccess("Reservation successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $reservation = Reservation::find($id);
        $reservation->delete();

        return redirect()->back()->withSuccess('Reservation Successfully Deleted!');
    }
}
