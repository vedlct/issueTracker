@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h4>Company Info</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="shopTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
