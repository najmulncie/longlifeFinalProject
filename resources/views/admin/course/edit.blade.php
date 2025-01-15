
@extends('admin.admin_dashboard')

@section('title', 'Edit Course')

@section('body')


    <h1>Edit Course Section</h1>
    <form action="{{ route('course.sections.update', $section->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $section->title }}" required>
        <br>
        <label for="video_url">Video URL:</label>
        <input type="url" name="video_url" id="video_url" value="{{ $section->video_url }}" required>
        <br>
        <button type="submit">Update Course Section</button>
    </form>