@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
                <div style="text-align:right">
                    <a class="btn btn-secondary mb-2" href="{{ url('/home') }}">Back</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Activity</th>
                                <th scope="col">Causer</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logDetails as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->product_id }}</td>
                                <td>{{ $log->activity }}</td>
                                <td>{{ $log->causer }}</td>
                                <td>
                                    <a class="btn btn-dark" href="{{ route('log-data-details',$log->id) }}">Details</a>
                                    <a class="btn btn-danger" href="{{ route('log-details-delete',$log->id) }}">Delete</a>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="float:right">
                    {!! $logDetails->links() !!}
                    </div>
                </div>
          
        </div>
    </div>
</div>
@endsection