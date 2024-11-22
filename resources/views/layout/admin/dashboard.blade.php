@extends('layout.admin')

@section('title')
    الرئيسيه
@endsection


@section('contentheader')
    HRMS
@endsection

@section('contentheaderactivelink')
    <a href={{ route('admin.dashboard') }}> الرئيسيه </a>
@endsection

@section('contentheaderactive')
    عرض
@endsection


@section('content')
    <div
        style="
    background-size: cover;
    width:100% ;
    min-height:600px ;
    background-image:url('{{ asset('images/login.jpg') }}')
    ">

    </div>
@endsection
