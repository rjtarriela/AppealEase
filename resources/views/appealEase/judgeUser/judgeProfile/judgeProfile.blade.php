<div class="card mb-4">
    <div class="card-header" style="display: flex; align-items: center;">
        <svg class="svg-inline--fa fa-table me-1" width="16" height="16" aria-hidden="true" focusable="false"
            data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
            data-fa-i2svg="">
            <path fill="currentColor"
                d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z">
            </path>
        </svg>
        Existing Justices
    </div>
    <div class="card-body">
        <table id="judgesTable" class="table">
            <thead>
                <tr class="text-center">
                    <th>Division</th>
                    <th>Justice Name</th>
                    <th>Email Address</th>
                    <th>Contact Number</th>
                </tr>
            </thead>
            <tbody>
                @if ($judges->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">No records of judges</td>
                    </tr>
                @else
                    @foreach ($judges as $judge)
                        <tr class="text-center">
                            <td class="align-content-center">{{ $judge->division }}</td>
                            <td class="align-content-center">{{ $judge->name }}</td>
                            <td class="align-content-center">{{ $judge->email }}</td>
                            <td class="align-content-center">{{ $judge->contact_number }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>