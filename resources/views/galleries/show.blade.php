@extends('layouts.admin')

@section('title', 'Detail Galeri')
@section('page-title', 'Detail Galeri')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-lg">
    <h2 class="text-2xl font-bold mb-4">{{ $gallery->title }}</h2>
    <img src="{{ asset('storage/' . $gallery->image) }}" class="w-full h-64 object-cover mb-4">
    <p>{{ $gallery->description }}</p>
    <a href="{{ route('galleries.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">Kembali ke Galeri</a>
</div>
@endsection
