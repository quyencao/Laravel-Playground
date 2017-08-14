@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <comment-form></comment-form>
            <list-comment :comments="{{ $rootComments }}"></list-comment>
        </div>
    </div>
@endsection
