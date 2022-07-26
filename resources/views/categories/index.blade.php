@extends('home')
@section('content')
<a href="{{ route('addCategory') }}"><button class="btn btn-info" style="margin:10% 0% 1% 70%"> Add Category</button></a>
@if ($message = Session::get('success'))
<div style="margin-left:20%; width:60%" align="center" class="alert alert-success">
    <b>{{ $message }}</b>
</div>
@endif
<h3 class="mb-4" align="center">Categories</h3>
<table class="table table-striped" id="catalog" style=" width:100%" align="center" >
    <thead>
        <th> Name</th>
        <th>Parent</th>
        <th>Status </th>
        <th></th>
    </thead>
    @if (count($categories) >= 1)
    @foreach ($categories as $pr)
    <tr>
        <td> <a href="editCatalog/{{ $pr->id }}">{{ $pr->catageory_name }}</a></td>
        <td>{{ $pr->parentName == NULL? '-':$pr->parentName }}</td>
        <td class="{{ $pr->is_active == 1 ? 'text text-info' :'text text-danger' }}" > <b>{{ $pr->is_active == 1 ? 'Active' : 'Disabled' }}</b></td>
        <td> <a href="deleteCatalog/{{ $pr->id }}">Delete</a></td>
    </tr>
    @endforeach

    @else
    <tr>
        <td colspan="4" align="center"> <b>No Categories</b> </td>
    </tr>
    @endif
</table>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<script type="">
    $(document).ready( function () {
    let table = new DataTable('#catalog', {
        responsive: true

    });
    
});
</script>