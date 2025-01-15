@extends('user.user_dashboard')

@section('title', 'Course Videos')

@section('body')
    <div class="container">
        @forelse($sections as $section)
            <div class="section">
                <h4>{{ $section->name }}</h4>
                @if(empty($section->video_url))
                    <p>No videos available for this section.</p>
                @else
                    <div class="mb-2">
                        <iframe 
                            src="{{ $section->video_url }}" 
                            id="video" 
                            width="100%" 
                            height="300" 
                            frameborder="2" 
                            allowfullscreen>
                        </iframe>
                    </div>
                @endif
            </div>
        @empty
            <p>No sections available for this category.</p>
        @endforelse
    </div>

<!-- <script>
     $('.videoplay').on('click', function() {
    $("#video")[0].src += "?autoplay=1";
}); -->
</script>
   


@endsection
