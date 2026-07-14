@props([
    'id' => 'dataTable',
    'headers' => [],
    'searchable' => true,
    'exportable' => false,
    'pageLength' => 25
])

<div {{ $attributes->merge(['class' => 'card shadow-sm border-0']) }}>
    @if($searchable || $exportable)
    <div class="card-header bg-transparent">
        <div class="row align-items-center">
            <div class="col-md-6">
                @if($searchable)
                <div class="input-group input-group-sm" style="max-width: 300px;">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="search" class="form-control" id="{{ $id }}-search" placeholder="Search...">
                </div>
                @endif
            </div>
            <div class="col-md-6 text-end">
                @if($exportable)
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-secondary" onclick="exportTable('csv')">
                        <i class="bi bi-filetype-csv me-1"></i> CSV
                    </button>
                    <button class="btn btn-outline-secondary" onclick="exportTable('excel')">
                        <i class="bi bi-filetype-xlsx me-1"></i> Excel
                    </button>
                    <button class="btn btn-outline-secondary" onclick="exportTable('pdf')">
                        <i class="bi bi-filetype-pdf me-1"></i> PDF
                    </button>
                    <button class="btn btn-outline-secondary" onclick="window.print()">
                        <i class="bi bi-printer me-1"></i> Print
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0" id="{{ $id }}">
                <thead class="table-light">
                    <tr>
                        @foreach($headers as $header)
                        <th>{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = $('#{{ $id }}').DataTable({
            responsive: true,
            pageLength: {{ $pageLength }},
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
        
        $('#{{ $id }}-search').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>
@endpush