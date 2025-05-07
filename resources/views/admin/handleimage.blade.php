@extends('layouts.admin')
@section('content')
<div class="main-content">
    <h3>Handle Image</h3>
    <form action="{{route('admin.handlestore')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="wg-box">
            <div class="body-title mb-10">Upload Image</div>
            <div class="upload-image mb-16">
                <div id="upload-file" class="item up-load">
                    <label class="uploadfile" for="myFile">
                        <span class="icon">
                            <i class="icon-upload-cloud"></i>
                        </span>
                        <span class="body-text">Drop your images here or select <span class="tf-color">click
                                to browse</span></span>
                        <input type="file" id="myFile" name="image" accept="image/*">
                    </label>
                </div>
            </div>
            <button>Submit</button>
        </div>
    </form>

    <div class="image-preview">
        <div class="image-preview-inner">
            <div class="image-preview-item">
                @if(session('uploadedImage'))
                <img src="{{ Storage::disk('s3')->url(session('uploadedImage'))}}" alt="Image Preview">
                @else
                <p>No image uploaded yet.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="image-preview">
        <div class="image-preview-inner">
            <div class="image-preview-item">
                <img src="{{ Storage::disk('s3')->url('images/1746640978.png')}}" alt="Image Preview">
            </div>
        </div>
    </div>
</div>
@endsection