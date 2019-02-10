@extends('layout')
@section('main-content')
    <div id='mainContent'>
        <healths-table></healths-table>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/healths.js')}}"></script>
@endsection
