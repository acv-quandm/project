@extends('layout')
@section('main-content')
    <div id='mainContent'>
        <drugs-table></drugs-table>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/drugs.js')}}"></script>
@endsection
