@props([
    'id' => $id ?? 'monthPicker_' . uniqid(),
    'name' => $name ?? 'month',
    'value' => $value ?? old($name),       // "Aug-2025" preferred; can be null
    'placeholder' => $placeholder ?? 'MMM-YYYY',
    'autofocus' => $autofocus ?? false,
    'required' => $required ?? false,
    'class' => $class ?? '',
])

@once
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">
    @endpush

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>

        <script>
            (function initMonthPickers(){
                function init() {
                    $('.js-month-picker').each(function(){
                        const $el = $(this);
                        if ($el.data('monthpicker-initialized')) return;
                        $el.datepicker({
                            format: "M-yyyy",      // e.g., Aug-2025
                            startView: "months",
                            minViewMode: "months",
                            autoclose: true
                        });
                        $el.data('monthpicker-initialized', true);
                    });
                }
                // Init on DOM ready (for first load) and also after Turbo/Livewire if needed
                if (document.readyState !== 'loading') init();
                document.addEventListener('DOMContentLoaded', init);
            })();
        </script>
    @endpush
@endonce

<input
    type="text"
    id="{{ $id }}"
    name="{{ $name }}"
    value="{{ $value }}"
    placeholder="{{ $placeholder }}"
    autocomplete="off"
    @class(["form-control", "js-month-picker", $class])
    @if($autofocus) autofocus @endif
    @if($required) required @endif
/>
