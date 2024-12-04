<div class="card mb-4">
    <div class="card-header" style="display: flex; align-items: center;">
        <svg class="svg-inline--fa fa-table me-1" width="16" height="16" aria-hidden="true" focusable="false"
            data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
            data-fa-i2svg="">
            <path fill="currentColor"
                d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z">
            </path>
        </svg>
        Existing Case
    </div>
    <div class="card-body">
        <table id="caseTable" class="table">
            <thead>
                <tr class="text-center">
                    <th>Litigant Info</th>
                    <th>Case Title</th>
                    <th>Case Number</th>
                    <th>Case Type</th>
                    <th>Lower Court</th>
                    <th>Case Judge</th>
                    <th>Case Requirements</th>
                    <th>Actions</th>
                    <th>Case Submitted Under Deliberation</th>
                    <th>Period of Deliberaion</th>
                </tr>
            </thead>
            <tbody>
                @if ($cases->isEmpty())
                    <tr>
                        <td colspan="10" class="text-center">No records of cases</td>
                    </tr>
                @else
                    @foreach ($cases as $case)
                        <tr class="text-center">
                            <td>@include('appealEase.camisUser.dashboard.litigantModal')</td>
                            <td class="align-content-center">{{ $case->case_title }}</td>
                            <td class="align-content-center">{{ $case->case_number }}</td>
                            {{-- <td class="align-content-center">{{ $case->case_type }}</td> --}}
                            {{-- first letter capital --}}
                            <td class="align-content-center">{{ ucfirst($case->case_type) }}</td>
                            <td class="align-content-center">{{ $case->case_court }}</td>
                            <td class="align-content-center">{{ $case->case_judge }}</td>
                            <td class="align-content-center">
                                @include('appealEase.camisUser.dashboard.requirementModal')
                            </td>
                            <td class="align-content-center">
                                <!-- Action buttons -->
                                {{-- Check and X Button - Cogie ikaw na bahala --}}
                                @include('appealEase.judgeUser.dashboard.check')
                            </td>
                            <td class="align-content-center">
                                {{ $case->updated_at->toFormattedDateString() }}
                            </td>
                            <td class="align-content-center">
                                Until: {{ $case->deadline->toFormattedDateString() }}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
