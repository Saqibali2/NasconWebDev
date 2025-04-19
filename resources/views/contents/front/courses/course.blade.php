@extends('layouts.front.theme')

@section("content")
    <div class="space"></div> 

    <!-- Terms Start -->
    <div class="container-xxl py-5">
        <div class="container py-5 px-lg-5">
            <div class="wow fadeInUp" data-wow-delay="0.1s">
                <p class="section-title text-secondary justify-content-center">
                    <span></span>
                    {{ __('Terms') }}
                    <span></span>
                </p>
                <h1 class="text-center mb-5">What Solutions We Provide</h1>
            </div>

            <div class="row g-4">
                @forelse ($course->Terms as $term)
                    <x-front.term :term="$term" :iteration="$loop->iteration"/>
                @empty
                    <p class="text-center">No terms available.</p>
                @endforelse
            </div>

            <!-- Display Video if Exists -->
            @if($course->video)
                @php
                    try {
                        $videoPath = decrypt($course->video);
                    } catch (\Exception $e) {
                        $videoPath = null;
                    }
                @endphp

                @if($videoPath)
                    <div class="course-video mt-5">
                        <h2 class="text-center mb-4">Course Video</h2>
                        <video width="100%" height="auto" controls>
                            <source src="{{ asset('storage/' . $videoPath) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @else
                    <p class="text-center mt-4 text-danger">Unable to decrypt and display the video.</p>
                @endif
            @else
                <p class="text-center mt-4">No video available for this course.</p>
            @endif
        </div>
    </div>
    <!-- Terms End -->
@endsection
