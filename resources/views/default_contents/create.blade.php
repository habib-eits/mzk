@extends('template.tmp')
@section('title', '')
@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <h2>{{ isset($default_content) ? 'Edit' : 'Add' }} Template</h2>

                <form method="POST"
                    action="{{ isset($default_content) ? route('default-content.update', $default_content) : route('default-content.store') }}">
                    @csrf
                    @if (isset($default_content))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label>Document Type</label>
                        <select name="document_type" class="form-control">
                            @foreach (config('default_content.document_types') as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('document_type', $default_content->document_type ?? '') === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Content Type</label>
                        <select name="content_type" class="form-control">
                            @foreach (config('default_content.content_types') as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('content_type', $default_content->content_type ?? '') === $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control"
                            value="{{ old('title', $default_content->title ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label>Content</label>
                        <textarea name="content" class="form-control tinymce">{{ old('content', $default_content->content ?? '') }}</textarea>
                    </div>

                    <button class="btn btn-success" type="submit">Save</button>
                    <a href="{{ route('default-content.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
