@extends('layout')
@section('main-content')
    <div id='mainContent'>
        <troubles-table user_id="{{\Illuminate\Support\Facades\Auth::user()->id}}"></troubles-table>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/troubles.js')}}"></script>
@endsection
