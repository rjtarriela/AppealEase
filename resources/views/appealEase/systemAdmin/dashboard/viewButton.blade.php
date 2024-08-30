<button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $judge->id }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="cyan"
        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
        <path d="M1 12S5 4 12 4s11 8 11 8-4 8-11 8S1 12 1 12z" />
        <circle cx="12" cy="12" r="3" />
    </svg>
</button>

<!-- The Modal -->
<div class="modal" id="viewModal{{ $judge->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">View Cases for Judge {{ $judge->name }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-header" style="display: flex; align-items: center;">
                        <svg class="svg-inline--fa fa-table me-1" width="16" height="16" aria-hidden="true"
                            focusable="false" data-prefix="fas" data-icon="table" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
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
                                    <th>Case Court</th>
                                    <th>Case Judge</th>
                                    <th>Case Requirements</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $judgeCases = $cases->where('case_judgeID', $judge->id);
                                @endphp

                                @if ($judgeCases->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">No cases found for this judge</td>
                                    </tr>
                                @else
                                    @foreach ($judgeCases as $case)
                                        <tr class="text-center">
                                            <td>{{ $case->case_number }}</td>
                                            <td>{{ ucfirst($case->case_type) }}</td>
                                            <td>{{ $case->case_court }}</td>
                                            <td>{{ $judge->name }}</td>
                                            <td>
                                                @php
                                                    $requirements = json_decode($case->case_requirement, true);
                                                @endphp
                                                @if (!empty($requirements))
                                                    @foreach ($requirements as $requirement)
                                                        <p>{{ $requirement }}</p>
                                                    @endforeach
                                                @else
                                                    No requirements
                                                @endif
                                            </td>
                                            <td>{{ $case->remarks }}</td>
                                            </td>
                                            <td>{{ $case->adminStatus }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
