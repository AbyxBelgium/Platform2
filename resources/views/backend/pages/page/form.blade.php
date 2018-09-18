@extends('backend.layouts.default')

@section('content')
    <page-edit></page-edit>
@stop()

@section('javascript')
    @yield('javascript-extra')
@stop()

@section('custom-style')
    <style>
        .drop-column {
            margin-top: 15px;
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            min-height: 150px;
            padding-bottom: 15px;
            padding-top: 15px;
        }

        .plus-sign {
            display: block;
            padding-top: 33px;
            margin: auto auto 15px;
            fill: #bababa;
        }

        .plus-sign:hover {
            fill: #929292;
            cursor: pointer;
        }

        .mdl-dialog {
            z-index: 100;
        }

        .element-card {
            margin: 25px;
            width: 93%;
        }
    </style>
@stop()
