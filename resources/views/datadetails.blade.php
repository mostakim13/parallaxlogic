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
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{json_decode($logdata->data)->id}}</td>
                                <td>{{json_decode($logdata->data)->name}}</td>
                                <td>{{json_decode($logdata->data)->slug}}</td>
                                <td>{{json_decode($logdata->data)->quantity}}</td>
                                <td>{{json_decode($logdata->data)->price}}</td>
                        </tr>


                    </tbody>
                </table>
                <div style="float:right">

                </div>
            </div>

        </div>
    </div>
</div>
@endsection