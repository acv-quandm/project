@extends('layout')
@section('main-content')
    <div id='mainContent'>
        <periodics-table></periodics-table>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/periodics.js')}}"></script>
@endsection
