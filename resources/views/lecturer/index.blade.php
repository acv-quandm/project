@extends('layout')
@section('main-content')
    <div id='mainContent'>
        <lecturers-table></lecturers-table>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/lecturers.js')}}"></script>
@endsection
