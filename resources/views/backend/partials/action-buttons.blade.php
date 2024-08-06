{{-- resources/views/backend/partials/action-buttons.blade.php --}}
<button type="button" class="btn btn-sm btn-info edit-doctor" data-id="{{ $doctor->id }}" data-name="{{ $doctor->name }}" data-email="{{ $doctor->email }}" data-contact="{{ $doctor->contact }}" data-field="{{ $doctor->doctor->field }}">
    <i class="mdi mdi-pencil"></i> Edit
</button>
