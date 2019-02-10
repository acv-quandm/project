@extends('layout')
@section('main-content')
    <div id='mainContent'>
        <departments-table></departments-table>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/departments.js')}}"></script>
@endsection
