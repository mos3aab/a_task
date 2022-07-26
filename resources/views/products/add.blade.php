@extends('home')
<style>
    .row{
        margin-top: 2%
    }
</style>
@section('content')

<h2 align="center" style="margin-top:10%">Add Product</h2>
    
    <div class="container" >

        <form action="/addProduct" method="POST" enctype="multipart/form-data">
        
            <div class="row">
                <div class="col col-md-4">		
                    <label for=""> <b>Product Name</b></label>
                    <input class="form-control" required type="text" name="product_name" id="">
                </div>
            </div>
            <div class="row">
                <div class="col col-md-4">		
                    <label for=""> <b>Description</b></label><br>
                    <textarea class="form-control" name="description" id="" cols="10" rows="10"></textarea>
                </div>
            </div>
            @csrf <!-- {{ csrf_field() }} -->
            <div class="row">
                <div class="col col-md-3">
                    <label for=""><b> Parent</b> </label>
                    <select class="form-control" name="category" id="">
                        <option value="0">----- No Category -----</option>
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
                    <label for=""> <b>tags </b> <i> press space to add new Tag</i></label>
                    <input class="form-control"  id="tags" name="tags">


                </div>
            </div>
            <div class="row">
                <div class="col col-md-3">
                    <label for=""> <b>Picture </b></label>
                    <input class="form-control" type="file"  name="picture" id="">
                </div>
            </div>
            <div class="row">
                <div class="col col-md-3">
                    <input class="btn btn-info" type="submit" value="submit">
                </div>
            </div>
            
        </form>
    </div>
    <script>
        var a = document.getElementById('tags');
        a.addEventListener('keyup',addthis);
        
        function addthis() {
            b = a.value.replace('#',''); 
            a.value = '#'+b
        
            if (a.value.indexOf(' '))
            {
            a.value = a.value.replace(' ','#');
            }
        
        }
        </script>
    @endsection
