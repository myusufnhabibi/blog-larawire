@extends('layouts/user-lay')
@section('space-work')
    {{-- here we include the my-posts component --}}
    <livewire:EditPost :postdata='$post_data'>
    @endsection
