@extends('layout')
@section('main-content')
    <div id='mainContent'>
        <reports-table user_id="{{\Illuminate\Support\Facades\Auth::user()->id}}"></reports-table>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/reports.js')}}"></script>
@endsection
