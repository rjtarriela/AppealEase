@php
    $userRole = Auth::user()->judgeRole;
@endphp
<ul class="nav nav-tabs justify-content-around" role="tablist">
    <li class="nav-item flex-grow-1 text-center">
        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Normal Judge</a>
    </li>
    @if ($userRole === 'head')
        <li class="nav-item flex-grow-1 text-center">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Head Judge</a>
        </li>
    @endif
</ul>
<!-- Tab panes -->
{{-- Civil --}}
<div class="tab-content">
    <div class="tab-pane active" id="tabs-1" role="tabpanel">
        <div class="card mb-4">
            <div class="card-body">
                <table id="caseTable1" class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Case Number</th>
                            <th>Case Type</th>
                            <th>Case Court</th>
                            <th>Case Judge</th>
                            <th>Case Requirements</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($cases->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">No records of cases</td>
                            </tr>
                        @else
                            @foreach ($cases as $case)
                                <tr class="text-center">
                                    <td class="align-content-center">{{ $case->case_number }}</td>
                                    {{-- <td class="align-content-center">{{ $case->case_type }}</td> --}}
                                    {{-- first letter capital --}}
                                    <td class="align-content-center">{{ ucfirst($case->case_type) }}</td>
                                    <td class="align-content-center">{{ $case->case_court }}</td>
                                    <td class="align-content-center">{{ $case->case_judge }}</td>
                                    <td class="align-content-center">
                                        @php
                                            $requirements = json_decode($case->case_requirement, true);
                                        @endphp
                                        @if (!empty($requirements))
                                            @foreach ($requirements as $requirement)
                                                <p style="margin-top: 16px">{{ $requirement }}</p>
                                            @endforeach
                                        @else
                                            No requirements
                                        @endif
                                    </td>
                                    <td class="align-content-center">
                                        <!-- Action buttons -->
                                        {{-- Decision ng Judge --}}
                                        <div style="display: flex; justify-content: center">
                                            @include('appealEase.judgeUser.dashboard.complete')
                                            @include('appealEase.judgeUser.dashboard.incomplete')
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="tabs-2" role="tabpanel">
        <div class="card mb-4">
            <div class="card-body">
                <table id="caseTable2" class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Case Number</th>
                            <th>Case Type</th>
                            <th>Case Court</th>
                            <th>Case Judge</th>
                            @foreach ($judges as $judge)
                                <th>Associate: {{ $judge->name }}</th>
                            @endforeach
                            <th>Case Requirements</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($cases->isEmpty())
                            <tr>
                                <td colspan="{{ 6 + count($judges) }}" class="text-center">No records of cases</td>
                            </tr>
                        @else
                            @foreach ($cases as $case)
                                <tr class="text-center">
                                    <td class="align-content-center">{{ $case->case_number }}</td>
                                    {{-- <td class="align-content-center">{{ $case->case_type }}</td> --}}
                                    {{-- first letter capital --}}
                                    <td class="align-content-center">{{ ucfirst($case->case_type) }}</td>
                                    <td class="align-content-center">{{ $case->case_court }}</td>
                                    <td class="align-content-center">{{ $case->case_judge }}</td>
                                    @foreach ($judges as $judge)
                                        <td class="align-content-center">
                                            @php
                                                $decision = $case->decisions->firstWhere('judge_id', $judge->id);
                                            @endphp
                                            {{ $decision ? ucfirst($decision->decision) : 'Pending' }}
                                        </td>
                                    @endforeach
                                    <td class="align-content-center">
                                        @php
                                            $requirements = json_decode($case->case_requirement, true);
                                        @endphp
                                        @if (!empty($requirements))
                                            @foreach ($requirements as $requirement)
                                                <p style="margin-top: 16px">{{ $requirement }}</p>
                                            @endforeach
                                        @else
                                            No requirements
                                        @endif
                                    </td>
                                    <td class="align-content-center">
                                        <!-- Action buttons -->
                                        {{-- Check and X Button - Cogie ikaw na bahala --}}
                                        @include('appealEase.judgeUser.dashboard.check')
                                        @include('appealEase.judgeUser.dashboard.cross')
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
