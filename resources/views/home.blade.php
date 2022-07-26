@extends('header')

@section('navbar')

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top p-3 ">
    <a class="navbar-brand pr-5" href="#">Admin Store</a>
    <a class="navbar-brand pr-5" href="{{ route('products') }}">Products</a>
    <a class="navbar-brand pr-5" href="{{ route('categories') }}"> Categories</a>
</nav>
@endsection



