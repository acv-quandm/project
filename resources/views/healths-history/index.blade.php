@extends('layout')
@section('main-content')
    <div id='mainContent'>
        <healths-history></healths-history>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/healths-history.js')}}"></script>
@endsection
