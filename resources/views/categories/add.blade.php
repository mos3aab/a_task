@extends('home')
<style>
    .row{
        margin-top: 2%
    }
</style>
@section('content')

<h2 align="center" style="margin-top:10%">Add Category</h2>
    
    <div class="container" >

        <form action="/addCatalog" method="POST">
        
            <div class="row">
                <div class="col col-md-4">		
                    <label for=""> <b>Category Name</b></label>
                    <input class="form-control" required type="text" name="catageory_name" id="">
                </div>
            </div>
            @csrf <!-- {{ csrf_field() }} -->
            <div class="row">
                <div class="col col-md-3">
                    <label for=""><b> Parent</b> </label>
                    <select class="form-control" name="parent_cateegory" id="">
                        <option value="0">----- No parent -----</option>
                        @if(count($categories) > 0 )
                        @foreach ($categories as $item)
                        @if($item->parent_cateegory == 0 )
                        <option value="{{$item->id}}">{{$item->catageory_name}}</option>
                        @endif
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col col-md-3">
                    <label for=""> <b>is Active</b></label>
                    <input required class="input ml-3" type="radio" name="is_active" value="1" id=""> Active
                    <input required class="input ml-3" type="radio" name="is_active" value="0" id=""> Disabled
                </div>
            </div>

            <div class="row">
                <div class="col col-md-3">
                    <input class="btn btn-info" type="submit" value="submit">
                </div>
            </div>
            
        </form>
    </div>
@endsection
