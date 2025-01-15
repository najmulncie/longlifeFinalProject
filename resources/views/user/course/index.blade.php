@extends('user.user_dashboard')

@section('title', 'all course section')

@section('body')

<div class="container">
                    @if(session('success'))
                    <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif                                  
<div class="row">
    @if($sections->isEmpty())
        <p>No sections available.</p>
    @else
    @foreach($sections as $categoryId => $sectionsByCategory)
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <a href="{{ route('course.sections.videos', ['id' => $categoryId]) }}">
                        @if($categoryId === 'no-category')
                            No category assigned
                        @else
                            {{ $sectionsByCategory->first()->category->name }}
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endforeach


    @endif
</div>

</div>

@endsection