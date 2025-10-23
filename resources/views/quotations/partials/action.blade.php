<div class="d-flex align-items-center col-actions">
    <div class="dropdown">
        <a class="action-set show" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a href="{{ route('quotation.show', $id) }}" class="dropdown-item">
                    <i class="bx bx-show font-size-16 text-primary me-1"></i> View
                </a>
            </li>
            <li>
                <a href="{{ route('quotation.edit', $id) }}" class="dropdown-item">
                    <i class="bx bx-pencil font-size-16 text-primary me-1"></i> Edit
                </a>
            </li>
            {{-- @if ($status === 'approved') --}}
            <li>
                <a href="javascript:void(0)" onclick="createSaleInvoiceFromQuotation({{ $id }})"
                    class="dropdown-item">
                    <i class="bx bx-plus font-size-16 text-success me-1"></i> Create Sale Invoice
                </a>
            </li>
            {{-- @endif --}}
            <li>
                <form action="{{ route('quotation.destroy', $id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this work order?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="bx bx-trash font-size-16 text-danger me-1"></i> Delete
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>
