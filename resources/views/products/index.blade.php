@extends('home')
@section('content')
<a href="{{ route('addProduct') }}"><button class="btn btn-success" style="margin:10% 0% 1% 70%"> Add Product</button></a>
@if ($message = Session::get('success'))
<div style="margin-left:20%; width:60%" align="center" class="alert alert-success">
    <b>{{ $message }}</b>
</div>
@endif
<h3 class="mb-4" align="center">Products</h3>
<table class="table table-stripped" style=" width:60%" align="center" >
    <thead>
        
        <th>Product Name </th>
        <th>Desc.</th>
        <th>Category</th>
        <th>Tags</th>
        <th></th>
    </thead>
    @if (count($products) > 1)
    @foreach ($proucts as $pr)
    <tr>
        <td>{{ $pr->id }}</td>
        <td>{{ $pr->product_name }}</td>
        <td>{{ $pr->description }}</td>
        <td>{{ $pr->tags}}</td>
    </tr>
    
@endforeach

    @else
    <tr>
        <td colspan="5" align="center"> <b>No Products</b> </td>
    </tr>
    @endif
</table>

@endsection
