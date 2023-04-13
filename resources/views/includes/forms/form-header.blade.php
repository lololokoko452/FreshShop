<div class="card-header align-items-center d-flex">
    @if($entity?->id)
        <h4 class="card-title mb-0 flex-grow-1">
            <i class="ri-edit-box-fill align-bottom me-1"></i>
            {{ $editTitle }}
        </h4>
    @else
        <h4 class="card-title mb-0 flex-grow-1">
            <i class="ri-add-box-fill align-bottom me-1"></i>
            {{ $newTitle }}
        </h4>
    @endif
    <div class="flex-shrink-0">
        <a class="btn btn-warning btn-sm" href="{{ $listUrl }}">
            <i class="ri-arrow-left-line align-bottom me-1"></i> Back to list
        </a>
    </div>
</div>
