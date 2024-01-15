@extends('admin.index')
@section('content')
    <!-- Start block -->

    <x-crud-table :books="$books"></x-crud-table>
@endsection
