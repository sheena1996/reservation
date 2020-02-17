@extends('layouts.dashboard.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-primary">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="card-title ">User List</h4>
                    <p class="card-category"> List of registered user.</p>
                </div>
                <div class="col-md-2">
                    <a href="{{ url('admin/users/create') }}" class="btn btn-white btn-sm float-right">Add User</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                        <th>
                            ID
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Contact
                        </th>
                        <th class="text-right">
                            Actions
                        </th>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    {{ $user->id }}
                                </td>
                                <td>
                                    {{ $user->getFullNameAttribute() }}
                                </td>
                                <td>
                                    {{  $user->email }}
                                </td>
                                <td>
                                    {{  $user->client->contact_number }}
                                </td>
                                <td class="td-actions text-right">
                                    
                                                                 
                                   
                                    <a href="{{ route('users.edit', $user->id) }}" rel="tooltip" class="btn btn-success" data-original-title="" title="Edit">
                                        <i class="material-icons">edit</i>
                                        <div class="ripple-container"></div> 
                                    </a>

                                    {!! Form::open(array('action'=>['Admin\AdminUserController@destroy', $user->id ], 'method' => 'DELETE', 'class' => 'delete-item')) !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                        <button rel="tooltip" class="btn btn-danger" data-original-title="" title="Delete">
                                            <i class="material-icons">delete_forever</i> 
                                            <div class="ripple-container"></div> 
                                        </button>
                                    {!! Form::close() !!}

                                    <p style="color:gray; padding:0 6px; display:inline-block">|</p>

                                    <a href="{{ route('reservations.index', $user->client->id) }}" rel="tooltip" class="btn btn-primary" data-original-title="" title="Reservations">
                                        <i class="material-icons">playlist_add_check</i>
                                        <div class="ripple-container"></div> 
                                    </a>

                                    <a href="{{ route('reservations.create', $user->client->id) }}" rel="tooltip" class="btn btn-info" data-original-title="" title="Reserve">
                                        <i class="material-icons">event_available</i> 
                                        <div class="ripple-container"></div> 
                                    </a>
                                    
                                </td>
                            </tr>
                        @empty
                            <tr><td>No data to show</td></tr>
                        @endforelse                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

   
</div>
@endsection