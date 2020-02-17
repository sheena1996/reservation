@extends('layouts.dashboard.app') 
@section('content')

<div class="col-md-12">
    <h1 class="text-primary">{{ $reservation->client->first_name." ".$reservation->client->last_name }}</h1>
    <p><small>{{ $reservation->client->user->email }} | {{ $reservation->client->contact_number }}</small></p>
    <hr>
    <br>
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title"> Reservation</h4>
                    <p class="card-category">Please select the product you want to reserve.</p>
                    
                </div>
                
            </div>
        </div>
        <div class="card-body">
                {!! Form::open(['method' => 'PUT' ,'route' => ['admin.reservations.update', $reservation->id] ]) !!}
               
                    <div class="row">
                        <div class="col-md-4 col-xs-12 align-self-center">
                            <div class="form-group">
                                <label for="reservationClassification">Reservation Classification</label>
                                <select class="form-control selectpicker" name="classification" data-style="btn btn-link" id="reservationClassification">
                                    <option value="{{ $reservation->classification }}">
                                        Selected : <strong class="text-primary">{{ $reservation->classification }}</strong>
                                    </option>
                                    <option value="regular">Regular</option>
                                    <option value="consignment">Consignment </option>
                                    <option value="liquidation">Liquidation </option>
                                    <option value="event" >Event</option>
                                </select>
                            </div>
                            <br>
                        </div>

                        <div class="col-md-4 col-xs-12 align-self-center">
                            <div class="form-group">
                                <label for="reservationClassification">Reservation Status</label>
                                <select class="form-control selectpicker" name="status" data-style="btn btn-link" id="reservationClassification">
                                    <option value="{{ $reservation->classification }}">
                                        Selected : <strong class="text-primary">{{ ($reservation->status == 1) ? 'Approved':'Declined' }}</strong>
                                    </option>
                                    <option value="1">Approved</option>
                                    <option value="0">Declined</option>
                                     <option value="2">Pending</option>
                                </select>
                            </div>
                            <br>
                        </div>
                        
                        <div class="col-md-2 col-xs-12 align-self-center">
                            <div class="form-group">
                                <label for="totalCost">Total Cost</label>
                                <input type="text" readonly class="form-control totalCost" name="total_cost" id="totalCost" placeholder="0" value="{{ $reservation->total_amount }}">
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12 align-self-center">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </form>
                <div class="row">

                    <!-- <div class="col-md-12 col-xs-12 align-self-center">
                        <div class="form-group">
                            <label for="reservationStatus">Add Prodcuts</label>
                            {!! Form::select('product', $products, null, ['class' => 'form-control selectpicker',' data-style'=>'btn btn-link'] ) !!}
                        </div>
                        <br>
                    </div> -->
            
                    <div class="col-md-12">
                        <hr>
                        <!-- <div class="card "> -->
                            <div class="table-responsive tbl-reservation">
                                <table class="table">
                                    <thead class=" text-primary">
                                    
                                        <th>
                                            Product
                                        </th>
                                        <th>
                                            SKU
                                        </th>
                                        <th>
                                            Cost
                                        </th>
                                    </thead>
                                    <tbody>
                                        @forelse($reservation->reservation_item as $item)
                                            <tr>
                                                
                                                <td class="pl-3">
                                                {{ ucwords($item->product->name) }}
                                                </td>
                                                <td>
                                                    {{ $item->product->sku }}
                                                </td>
                                                <td>
                                                    {{ $item->product->cost }}
                                                </td>
                                                
                                                
                                            </tr>
                                        @empty
                                            No data to show
                                        @endforelse      
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            
            
        </div>
    </div>

   
</div>

@endsection