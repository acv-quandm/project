@extends('layout')
@section('main-content')
    <div id='mainContent'>
        <annunciates-table user_id="{{\Illuminate\Support\Facades\Auth::user()->id}}"></annunciates-table>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/annunciates.js')}}"></script>
@endsection
