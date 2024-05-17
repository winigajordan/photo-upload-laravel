@extends('layout.client')

@section('content')

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-8">
        <div class="relative">
            <img src="https://placehold.co/600x400" alt="Image 1" class="w-full h-auto cursor-pointer" onclick="openModal('https://placehold.co/600x400')">
        </div>
        <div class="relative">
            <img src="https://via.placeholder.com/400" alt="Image 2" class="w-full h-auto cursor-pointer" onclick="openModal('https://via.placeholder.com/800')">
        </div>
        <div class="relative">
            <img src="https://via.placeholder.com/500" alt="Image 3" class="w-full h-auto cursor-pointer" onclick="openModal('https://via.placeholder.com/800')">
        </div><div class="relative">
            <img src="https://via.placeholder.com/400" alt="Image 2" class="w-full h-auto cursor-pointer" onclick="openModal('https://via.placeholder.com/800')">
        </div>
        <div class="relative">
            <img src="https://via.placeholder.com/500" alt="Image 3" class="w-full h-auto cursor-pointer" onclick="openModal('https://via.placeholder.com/800')">
        </div><div class="relative">
            <img src="https://via.placeholder.com/400" alt="Image 2" class="w-full h-auto cursor-pointer" onclick="openModal('https://via.placeholder.com/800')">
        </div>
        <div class="relative">
            <img src="https://via.placeholder.com/500" alt="Image 3" class="w-full h-auto cursor-pointer" onclick="openModal('https://via.placeholder.com/800')">
        </div><div class="relative">
            <img src="https://via.placeholder.com/400" alt="Image 2" class="w-full h-auto cursor-pointer" onclick="openModal('https://via.placeholder.com/800')">
        </div>
        <div class="relative">
            <img src="https://via.placeholder.com/500" alt="Image 3" class="w-full h-auto cursor-pointer" onclick="openModal('https://via.placeholder.com/800')">
        </div><div class="relative">
            <img src="https://via.placeholder.com/400" alt="Image 2" class="w-full h-auto cursor-pointer" onclick="openModal('https://via.placeholder.com/800')">
        </div>
        <div class="relative">
            <img src="https://via.placeholder.com/500" alt="Image 3" class="w-full h-auto cursor-pointer" onclick="openModal('https://via.placeholder.com/800')">
        </div>
        <!-- Ajoutez autant d'images que nécessaire -->
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content  items-center">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="modalImage" src="" alt="Modal Image">
            <a id="downloadLink" class="download-btn" href="#" download>Download Image</a>
        </div>
    </div>


@endsection
