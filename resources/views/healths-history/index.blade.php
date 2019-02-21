@extends('layout')
@section('main-content')
    <div id='mainContent'>
        <healths-history user_id={{\Illuminate\Support\Facades\Auth::user()->id}}></healths-history>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/healths-history.js')}}"></script>
@endsection
