@extends('layout.admin')

@section('content')
    <div class="container px-6 mx-auto grid">


        <div class="grid gap-6 my-8 md:grid-cols-2">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Détails de la demande - {{$demande->slug}}
            </h2>
            <div class="min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs">
                <img src="{{asset('images-bornes/'.$demande->slug.'/code-qr.png')}}">
            </div>
        </div>

    </div>
@endsection
