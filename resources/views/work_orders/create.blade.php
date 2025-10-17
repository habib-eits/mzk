@extends('template.tmp')
@section('title', 'Work Order')
@section('content')
    <form id="create-update-form">
        @csrf
        <input type="hidden" name="id" id="record-id" value="{{ $workOrder->id }}"> <!-- Used for Edit -->

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">

                    <h3>WORK ORDER</h3>
                    <div class="row"></div>
                    <div class="col-6">

                        <div class="mb-1 row">
                            <div class="col-sm-4">
                                <label class="col-form-label" for="project-name">Project Name</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="project-name" class="form-control" name="project_name"
                                    value="{{ $workOrder->project_name }}">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-sm-4">
                                <label class="col-form-label" for="date">Date</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="date" id="date" class="form-control" name="date"
                                    value="{{ $workOrder->date != null ? $workOrder->date : date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-sm-4">
                                <label class="col-form-label" for="party_id">Customer</label>
                            </div>
                            <div class="col-sm-8">
                                <select id="party_id" class="form-control select2" name="party_id" style="width: 100%">
                                    <option value="">Select Party</option>
                                    {{-- Example options, replace with dynamic data as needed --}}
                                    @foreach ($parties as $party)
                                        <option @selected($workOrder->party_id == $party->PartyID) value="{{ $party->PartyID }}"
                                            data-address = "{{ $party->Address }} ">
                                            {{ $party->PartyName }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <div class="col-sm-4">
                                <label class="col-form-label" for="location">Location</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="location" class="form-control" name="location"
                                    value="{{ $workOrder->location }}">
                            </div>
                        </div>
                    </div>
                </div>



                <div class="d-flex ">

                    <div class="col-6">
                        <h4>Section 1 <span id="default_scope_of_work_btn" class="btn btn-sm btn-primary">Default
                                Content</span></h4>
                        <textarea class="form-control tinymce" id="scope_of_work" name="scope_of_work" placeholder="">{!! $scopeOfWork !!} </textarea>
                    </div>
                    <div class="col-6">
                        <h4>Section 2 <span id="default_terms_and_conditions_btn" class="btn btn-sm btn-primary">Default
                                Content</span></h4>
                        <textarea class="form-control tinymce" id="terms_and_conditions" name="terms_and_conditions" placeholder="">{!! $termsAndConditions !!} </textarea>
                    </div>
                </div>
                <br>

                <div class="">
                    <a href="{{ route('work-order.index') }}" type="button" class="btn btn-cancel me-2 btn-dark">Cancel</a>
                    <button type="submit" id="submit-btn" class="btn btn-submit btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#party_id').select2();

            $('#party_id').on('change', function() {
                var address = $(this).find('option:selected').data('address') || '';
                $('#location').val($.trim(address));
            });
        });


        $('#create-update-form').on('submit', function(e) {
            e.preventDefault();
            // Force TinyMCE to update the textarea values
            tinymce.triggerSave();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('work-order.store') }}",
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                data: formData,

                success: function(response) {

                    $('#create-update-form')[0].reset(); // Reset all form data

                    notyf.success({
                        message: response.message,
                        duration: 3000
                    });

                    setTimeout(function() {
                        window.location.href = "{{ route('work-order.index') }}";
                    }, 1500); // Redirect after 1.5 seconds
                },
                error: function(e) {
                    const msg = e.responseJSON?.errors ?
                        Object.values(e.responseJSON.errors)[0][0] :
                        e.responseJSON?.message || 'An error occurred';

                    notyf.error({
                        message: msg,
                        duration: 5000
                    });
                }

            });
        });


        $('#default_scope_of_work_btn').on('click', function() {

            if (confirm(
                    'Are you sure you want to replace the current content with the default content it cannot be undone?'
                )) {
                const defaultContent = @json($defaultScopeOfWork);
                tinymce.get('scope_of_work').setContent(defaultContent);
                tinymce.triggerSave();
            }
        });
        $('#default_terms_and_conditions_btn').on('click', function() {
            if (confirm(
                    'Are you sure you want to replace the current content with the default content it cannot be undone?'
                )) {
                const defaultContent = @json($defaultTermsAndConditions);
                tinymce.get('terms_and_conditions').setContent(defaultContent);
                tinymce.triggerSave();
            }
        });
    </script>



@endsection
