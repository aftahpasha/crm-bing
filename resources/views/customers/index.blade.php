@extends('customers.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Sistem Aplikasi Pencatatan Kontrak</h2>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($due_contract_30)
        <div class="alert alert-warning ">
            <strong>Kontrak Dengan PT Berikut Akan berakhir dalam 1 Bulan:</strong>
            @foreach ($due_contract_30 as $dt30)
            <p>- {{ $dt30->nama_pt }} | {{ $dt30->no_kontrak }}</p>
            @endforeach
        </div>
    @endif
    @if ($due_contract_60)
    <div class="alert alert-warning ">
        <strong>Kontrak Dengan PT Berikut Akan berakhir dalam 2 Bulan:</strong>
        @foreach ($due_contract_60 as $dt60)
        <p>- {{ $dt60->nama_pt }} | {{ $dt60->no_kontrak }}</p>
        @endforeach
    </div>
@endif
@if ($due_contract_15)
<div class="alert alert-warning ">
    <strong>Kontrak Dengan PT Berikut Akan berakhir dalam 15 hari:</strong>
    @foreach ($due_contract_15 as $dt15)
    <p>- {{ $dt15->nama_pt }} | {{ $dt15->no_kontrak }}</p>
    @endforeach
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
            <td>{{ $customer->limit_day }} Hari</td>
            <td>
                <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">
       
                    <a class="btn btn-primary" href="{{ route('customers.edit',$customer->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                        <a class="btn btn-success" href="{{ route('customers.create') }}"> Create</a>

                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $customers->links() !!}
      
@endsection