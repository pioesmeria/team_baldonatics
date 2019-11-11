@extends('errors.illustrated-layout')

@section('code', '400')
@section('title', __('Error'))

@section('image')
    <div style="background-image: url({{ asset('/svg/403.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', $message ?? __('Bad Request. Server received an invalid Request'))

