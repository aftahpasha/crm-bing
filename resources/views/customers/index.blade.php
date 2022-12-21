@extends('customers.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Sistem Aplikasi Pencatatan Kontrak</h2>
            </div>
            <div class="pull-right mb-3">
                <a class="btn btn-success" href="{{ route('customers.create') }}"> Create New Customer</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nomor Kontrak</th>
            <th>Nama PT</th>
            <th>Deskripsi</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Limit Day</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($customers as $customer)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $customer->no_kontrak }}</td>
            <td>{{ $customer->nama_pt }}</td>
            <td>{{ $customer->deskripsi }}</td>
            <td>{{ $customer->start_date }}</td>
            <td>{{ $customer->end_date }}</td>
            <td>{{ $customer->limit_day }} Days</td>
            <td>
                <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">
       
                    <a class="btn btn-primary" href="{{ route('customers.edit',$customer->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $customers->links() !!}
      
@endsection