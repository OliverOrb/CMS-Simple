@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12 space-y-6 xl:col-span-12">
            !!!!!!!!!!!!!!!!Comments!!!!!!!!!!!!!!!
            @foreach($comments as $comment)
                <div class="border-b p-4">
                    <p><strong>{{ $comment->user->name }}</strong> said:</p>
                    <p>{{ $comment->body }}</p>
                    <small>On post: {{ $comment->post->title }}</small>
                </div>
            @endforeach
            <x-ecommerce.ecommerce-metrics />
        </div>
    </div>
@endsection
