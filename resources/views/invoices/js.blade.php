 <script>
     $(document).ready(function() {
         let id = @json($invoice->InvoiceMasterID);
         if (id == null) {
             addRow();
         }
     });
     $('#create-update-form').on('submit', function(e) {
         e.preventDefault();

         // Disable all clickable elements
         $('button, a').addClass('disabled').prop('disabled', true);
         tinymce.triggerSave();
         let formData = new FormData(this);
         $.ajax({
             type: "POST",
             url: "{{ route('invoice.store') }}",
             dataType: 'json',
             contentType: false,
             processData: false,
             cache: false,
             data: formData,

             success: function(response) {

                 $('#create-update-form')[0].reset(); // Reset all form data

                 setTimeout(function() {
                     window.location.href = "{{ route('invoice.index') }}";
                 }, 1500); // Redirect after 1.5 seconds

                 notyf.success({
                     message: response.message,
                     duration: 3000
                 });


             },
             error: function(e) {
                 const msg = e.responseJSON?.errors ?
                     Object.values(e.responseJSON.errors)[0][0] :
                     e.responseJSON?.message || 'An error occurred';

                 notyf.error({
                     message: msg,
                     duration: 5000
                 });
                 // Enable all clickable elements
                 $('button, a').removeClass('disabled').prop('disabled', false);
             }

         });
     });


     $(document).on('change', '.row-item-select', function() {

         const selectedOption = $(this).find('option:selected');
         const unitName = selectedOption.data('unitname');
         const sellingPrice = selectedOption.data('sellingprice');


         const row = $(this).closest('tr');
         row.find('.row-unit-select').val('').trigger('change');
         row.find('.row-rate').val('');

         row.find('.row-unit-select').val(unitName).trigger('change');
         row.find('.row-rate').val(sellingPrice);
     });


     function addRow() {
         const table = $('#table tbody');
         const row = `
        <tr>
            <td>
                <select name="service_type_id[]" class="form-control select2" style="width: 100%">
                    <option value="">Select</option>
                    @foreach ($serviceTypes as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select name="ItemID[]" class="form-control select2 row-item-select" style="width: 100%">
                    <option value="">Select</option>
                    @foreach ($items as $item)
                        <option 
                        value="{{ $item->ItemID }}"
                            data-UnitName="{{ $item->UnitName }}"
                            data-SellingPrice="{{ $item->SellingPrice }}"


                        >{{ $item->ItemName . $item->UnitName . $item->SellingPrice }}</option>
                    @endforeach
                </select>
            </td>
            <td> <textarea name="Description[]" rows="1" class="form-control"></textarea></td>
            <td>
                <select name="UnitName[]" class="form-select form-control-sm select2 row-unit-select"
                    style="width: 100%">
                    <option value="">Select</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->UnitName }}">{{ $unit->UnitName }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="Rate[]" class="form-control row-rate">
            </td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="removeRow(this, event)">
                    <span class="bx bx-trash"></span> 
                </button>
            </td>
           
        </tr>`;

         table.append(row);
         $('.select2').select2();
     }

     function removeRow(row, e) {
         e.preventDefault();
         if (confirm('Are you sure you want to remove row')) {
             $(row).closest('tr').remove();
             if ($('#table tbody tr').length == 0) {
                 addRow();
             }
         }


     }
 </script>
