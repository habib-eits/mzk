@extends('template.tmp')
@section('title', '')
@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <h2>Default Content Templates</h2>
                <a href="{{ route('default-content.create') }}" class="btn btn-primary mb-3">Add New</a>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Document Type</th>
                            <th>Content Type</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($templates as $template)
                            <tr>
                                <td>{{ ucfirst($template->document_type) }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $template->content_type)) }}</td>
                                <td>{{ $template->title }}</td>
                                <td>
                                    <a href="{{ route('default-content.edit', $template) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('default-content.destroy', $template) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        {{-- <button onclick="return confirm('Delete this template?')"
                                            class="btn btn-sm btn-danger">Delete</button> --}}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
