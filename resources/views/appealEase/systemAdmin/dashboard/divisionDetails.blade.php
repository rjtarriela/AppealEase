<div class="row" style="text-align: left">
    <div class="col-md-6">
        <h5>Justices</h5>
        <ul>
            @foreach ($judges as $judge)
                <li>{{ $judge->name }}
                    ({{ $judge->judgeRole == 'head' ? 'Presiding Justice' : 'Justice' }})
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header" style="display: flex; align-items: center;">
        <svg class="svg-inline--fa fa-table me-1" width="16" height="16" aria-hidden="true" focusable="false"
            data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
            data-fa-i2svg="">
            <path fill="currentColor"
                d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z">
            </path>
        </svg>
        Existing Cases
    </div>
    <div class="card-body">
        <table id="caseTable" class="table">
            <thead>
                <tr class="text-center">
                    <th>Case Number</th>
                    <th>Case Type</th>
                    <th>Lower Court</th>
                    <th>Case Judge</th>
                    <th>Status</th>
                    <th>Verdict</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @if ($cases->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">No cases found</td>
                    </tr>
                @else
                    @foreach ($cases as $case)
                        <tr class="text-center">
                            <td>{{ $case->case_number }}</td>
                            <td>{{ ucfirst($case->case_type) }}</td>
                            <td>{{ $case->case_court }}</td>
                            <td>{{ $case->case_judge }}</td>
                            
                            <td>{{ $case->adminStatus }}</td>
                            <td>{{ $case->verdictStatus }}</td>
                            <td>
                                @include('appealEase.systemAdmin.dashboard.remarksModal')
                            </td> 
                            {{-- gawing button modal, show case_id user_id remarks --}}
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
