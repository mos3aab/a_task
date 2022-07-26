@extends('home')
@section('content')
<a href="{{ route('addProduct') }}"><button class="btn btn-success" style="margin:10% 0% 1% 70%"> Add Product</button></a>
@if ($message = Session::get('success'))
<div style="margin-left:20%; width:60%" align="center" class="alert alert-success">
    <b>{{ $message }}</b>
</div>
@endif
<h3 class="mb-4" align="center">Products</h3>
<table class="table table-striped" id="products" style=" width:100%" align="center" >
    
    <thead>
        <th>Product Name </th>
        <th>Desc.</th>
        <th>Category</th>
        <th>Tags</th>
        <th></th>
    </thead>
    @if (count($products) > 0)
    @foreach ($products as $pr)
    <tr>
        <td><a href="editProduct/{{ $pr->id}}">{{ $pr->product_name }}</a></td>
        <td>{{ $pr->description }}</td>
        <td>{{ $pr->catageory_name}}</td>
        <td>{{ $pr->tags}}</td>
        <td><a href="deleteProduct/{{ $pr->id}}">Delete</a></td>

    </tr>
    @endforeach
    @else
    <tr>
        <td colspan="5" align="center"> <b>No Products</b> </td>
    </tr>
    @endif
</table>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<script type="">
    $(document).ready( function () {
        
    let table = new DataTable('#products', {
        responsive: true

    });
    
});
</script>