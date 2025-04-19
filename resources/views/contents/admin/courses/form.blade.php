@extends('layouts.admin')

@section("content")

<!-- Create Form Card -->
<div class="col-12">
    <div class="card shadow mb-4 border-bottom-primary">
        <!-- Card Header -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ __("Course Form") }}</h6>
            <div class="dropdown no-arrow">
                <x-BackButton />
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <div class="text-center">

                @if(isset($course))
                    <form class="user" method="POST" action="{{ route('course.update', $course->id) }}" enctype="multipart/form-data">
                        @method('patch')
                @else
                    <form class="user" method="POST" action="{{ route('course.store') }}" enctype="multipart/form-data">
                @endif

                    @csrf

                    <!-- Title -->
                    <div class="form-group">
                        <label for="title" class="text-left w-100">Title</label>
                        <input name="title" type="text" class="form-control" id="title"
                            placeholder="Title" value="{{ old('title', $course->title ?? '') }}">
                        @error('title')
                            <span class="text-danger small d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Thumbnail Image Upload -->
                    <div class="form-group">
                        <label for="image" class="text-left w-100">Thumbnail Image</label>
                        <input name="image" type="file" class="form-control-file" id="image">
                        @if(isset($course) && $course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" alt="Current Thumbnail" class="img-thumbnail mt-2" width="150">
                        @endif
                        @error('image')
                            <span class="text-danger small d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Video Upload -->
                    <div class="form-group">
                        <label for="video_file" class="text-left w-100">Upload Video File</label>
                        <input name="video_file" type="file" class="form-control-file" id="video_file">
                        @if(isset($course) && $course->video_file)
                            <small class="form-text text-muted">Current file: {{ basename($course->video_file) }}</small>
                        @endif
                        @error('video_file')
                            <span class="text-danger small d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Video Link -->
                    <div class="form-group">
                        <label for="video_link" class="text-left w-100">Video Link (Optional)</label>
                        <input name="video_link" type="text" class="form-control" id="video_link"
                            placeholder="https://example.com/video" value="{{ old('video_link', $course->video_link ?? '') }}">
                        @error('video_link')
                            <span class="text-danger small d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Department -->
                    <div class="form-group">
                        <label for="department_id" class="text-left w-100">Department</label>
                        <x-forms.DropDown model="Department" name="department_id" selected="{{ $course->department_id ?? 0 }}" />
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description" class="text-left w-100">Description</label>
                        <textarea name="description" class="form-control editor" id="description" placeholder="Description">{{ old('description', $course->description ?? '') }}</textarea>
                        @error('description')
                            <span class="text-danger small d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-user btn-block" value="{{ __('Save') }}">
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
