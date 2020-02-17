@extends('layouts.dashboard.app') 
@section('content')

<div class="col-md-12">
    <h1 class="text-primary">{{ $client->first_name.' '.$client->last_name }}</h1>
    <p><small>{{ $client->user->email }} | {{ $client->contact_number }} </small></p>
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
            @if(isset($action) && $action == 'create')
                <form action="{{ route('client.reservations.store') }}" method="POST" id="reserve">
                @csrf
            @else
                {!! Form::open(['method' => 'PUT' ,'route' => ['client.reservations.update', $reservation->id]]) !!}
            @endif
                <div class="row">

                    
                        <div class="col-md-8 col-xs-12 align-self-center">
                            <div class="form-group">
                                <label for="reservationClassification">Reservation Classification</label>
                                <select class="form-control selectpicker" name="classification" data-style="btn btn-link" id="reservationClassification">
                                @if(isset($reservation))
                                <option value="{{ $reservation->classification }}">
                                    Selected : <strong class="text-primary">{{ $reservation->classification }}</strong>
                                </option>
                                @endif
                                <option value="regular" >Regular</option>
                                <option value="consignment">Consignment</option>
                                <option value="liquidation">Liquidation</option>
                                <option value="event">Event</option>
                                </select>
                            </div>
                            <br>
                        </div>
                        <div class="col-md-2 col-xs-12 align-self-center">
                            <div class="form-group">
                                <label for="totalCost">Total Cost</label>
                                <input type="text" readonly class="form-control totalCost" name="total_cost" id="totalCost" value="" placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12 align-self-center">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>

                    <div class="col-md-12">
                        <hr>
                        <!-- <div class="card "> -->
                            <div class="table-responsive tbl-reservation">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            Select
                                        </th>
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
                                        @forelse ($products as $product)
                                            <tr>
                                                <td class="pl-3">
                                                    <div class="form-check productID">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" 
                                                                id="{{ $product->id }}" 
                                                                name="product_ID[]" 
                                                                type="checkbox" 
                                                                value="{{ $product->id }}" 
                                                                data-cost="{{ $product->cost }}"
                                                                @if(!empty($reservation_items))
                                                                    @php echo (in_array($product->id, $reservation_items)) ? 'checked="checked"' : '' @endphp
                                                                @endif
                                                                >

                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $product->name }}
                                                </td>
                                                <td>
                                                    {{  $product->sku }}
                                                </td>
                                                <td>
                                                    {{  $product->cost }}
                                                </td>
                                                
                                            </tr>
                                        @empty
                                            <tr><td>No data to show</td></tr>
                                        @endforelse                        
                                    </tbody>
                                </table>
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
            </form>
            
            
        </div>
    </div>

   
</div>

<script>

(function( $ ) {
    $(document).ready(function(){
        totalCost();
    });

    $(".tbl-reservation input[type=checkbox]").change(function(){
        totalCost();
    });
    function totalCost(){
        var sum = 0;
        $(".tbl-reservation input[type=checkbox]:checked").each(function(){
        sum += parseFloat($(this).data("cost"));
        });
        $("input#totalCost").val(sum);
    }

})(jQuery);

</script>

@endsection