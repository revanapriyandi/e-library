<div>
    @if (!empty($filter))
    <div class="float-left">
        <select class="form-control selectric" {{ $filter }}>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>
    @endif

    @if (!empty($search))
    <div class="float-right">
        <div class="input-group">
            <input type="text" class="form-control" {{ $search }} placeholder="Search">
        </div>
    </div>
    @endif

    <div class="clearfix mb-3"></div>
</div>
