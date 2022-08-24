@extends('admin.layouts.app')
@section('title', 'All Applicants')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb-4">
            <h1 class="title-bar">{{ __('All Applicants') }}</h1>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-end ">
            {{-- <div class="col-left">
                @if (!empty($rows))
                    <form method="post" action="{{ route('job.admin.applicants.bulkEdit') }}"
                        class="filter-form filter-form-left d-flex justify-content-start">
                        {{ csrf_field() }}
                        <select name="action" class="form-control">
                            <option value="">{{ __(' Bulk Actions ') }}</option>
                            <option value="approved">{{ __('Approved') }}</option>
                            <option value="rejected">{{ __('Rejected') }}</option>
                        </select>
                        <button data-confirm="{{ __('Do you want to delete?') }}"
                            class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{ __('Apply') }}</button>
                        <a class="btn btn-warning btn-icon" href="{{ route('job.admin.applicants.export') }}"
                            target="_blank" title="{{ __('Export to excel') }}"><i
                                class="icon ion-md-cloud-download"></i>&nbsp;{{ __('Export') }}
                        </a>
                    </form>
                @endif
            </div> --}}
            <div class="col-left">
                <form method="get" action="{{ route('job.admin.allApplicants') }} "
                    class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row" role="search">
                    @if (is_admin())
                        <?php
                        $company = \Modules\Company\Models\Company::find(Request()->input('company_id'));
                        \App\Helpers\AdminForm::select2(
                            'company_id',
                            [
                                'configs' => [
                                    'ajax' => [
                                        'url' => route('company.admin.getForSelect2'),
                                        'dataType' => 'json',
                                    ],
                                    'allowClear' => true,
                                    'placeholder' => __('-- Select Company --'),
                                ],
                            ],
                            !empty($company->id) ? [$company->id, $company->name . ' (#' . $company->id . ')'] : false,
                        );
                        
                        $candidate = \App\User::find(Request()->input('candidate_id'));
                        \App\Helpers\AdminForm::select2(
                            'candidate_id',
                            [
                                'configs' => [
                                    'ajax' => [
                                        'url' => route('candidate.admin.getForSelect2'),
                                        'dataType' => 'json',
                                    ],
                                    'allowClear' => true,
                                    'placeholder' => __('-- Select Candidate --'),
                                ],
                            ],
                            !empty($candidate->id) ? [$candidate->id, $candidate->getDisplayName() . ' (#' . $candidate->id . ')'] : false,
                        );
                        ?>
                    @endif
                    @php
                        $job = \Modules\Job\Models\Job::find(Request()->input('job_id'));
                        \App\Helpers\AdminForm::select2(
                            'job_id',
                            [
                                'configs' => [
                                    'ajax' => [
                                        'url' => route('job.admin.getForSelect2'),
                                        'dataType' => 'json',
                                    ],
                                    'allowClear' => true,
                                    'placeholder' => __('-- Select Job --'),
                                ],
                            ],
                            !empty($job->id) ? [$job->id, $job->title . ' (#' . $job->id . ')'] : false,
                        );
                        
                        \App\Helpers\AdminForm::select2(
                            'job_id',
                            [
                                'configs' => [
                                    'ajax' => [
                                        'url' => route('job.admin.getForSelect2'),
                                        'dataType' => 'json',
                                    ],
                                    'allowClear' => true,
                                    'placeholder' => __('-- Select City --'),
                                ],
                            ],
                            !empty($job->id) ? [$job->id, $job->education_level . ' (#' . $job->id . ')'] : false,
                        );
                    @endphp

                    <button class="btn-info btn btn-icon btn_search" type="submit">{{ __('Search') }}</button>
                </form>
                <form method="post" action="{{ route('job.admin.applicants.bulkEdit') }}"
                    class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row">
                    {{ csrf_field() }}
                    <select name="action" class="form-control">
                        <option value="">{{ __(' Bulk Actions ') }}</option>
                        <option value="approved">{{ __('Approved') }}</option>
                        <option value="rejected">{{ __('Rejected') }}</option>
                    </select>
                    <button data-confirm="{{ __('Do you want to delete?') }}"
                        class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{ __('Apply') }}</button>
                    <a class="btn btn-warning btn-icon ml-3" href="{{ route('job.admin.applicants.export') }}"
                        target="_blank" title="{{ __('Export to excel') }}"><i
                            class="icon ion-md-cloud-download"></i>&nbsp;{{ __('Export') }}
                    </a>
                </form>
            </div>
        </div>
        <div class="row">

        </div>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
                font-family: Arial;
            }

            /* Style the tab */
            .tab {
                overflow: hidden;
                border: 1px solid #ccc;
                background-color: #f1f1f1;
            }

            /* Style the buttons inside the tab */
            .tab button {
                background-color: inherit;
                float: left;
                border: none;
                outline: none;
                cursor: pointer;
                padding: 14px 16px;
                transition: 0.3s;
                font-size: 17px;
            }

            /* Change background color of buttons on hover */
            .tab button:hover {
                background-color: #ddd;
            }

            /* Create an active/current tablink class */
            .tab button.active {
                background-color: #ccc;
            }

            /* Style the tab content */
            .tabcontent {
                display: none;
                padding: 6px 12px;
                border: 1px solid #ccc;
                border-top: none;
            }
        </style>
        {{-- <div class="row"> --}}

        <div class="tab">
            {{-- <button class="tablinks" onclick="openCity(event, 'Paris')">({{ \Modules\Job\Models\JobCandidate::where('status', 'pending')->count() }}) Profile Not Completed</button>
                <button class="tablinks" onclick="openCity(event, 'London')">({{ \Modules\Job\Models\JobCandidate::where('status', 'profile_completed')->count() }}) Ready to Approve</button> --}}
            <button class="tablinks"
                onclick="openCity(event, 'Andri')">({{ \Modules\Job\Models\JobCandidate::all()->count() }}) All</button>
            <button class="tablinks"
                onclick="openCity(event, 'Tokyo')">({{ \Modules\Job\Models\JobCandidate::where('status', 'approved')->count() }})
                Approved</button>
            <button class="tablinks"
                onclick="openCity(event, 'Kelsi')">({{ \Modules\Job\Models\JobCandidate::where('status', 'rejected')->count() }})
                Rejected</button>

        </div>


        <div id="London" class="tabcontent">
            <h3>Profile Completed</h3>
            <p>Sudah Lengkap dan Siap di Approve Atau Reject.</p>
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                                <table class="table table-hover table-vertical-middle">
                                    <thead>
                                        <tr>
                                            <th class="title"> {{ __('Action') }}</th>
                                            <th width="60px"><input type="checkbox" class="check-all"></th>

                                            <th class="title"> {{ __('Candidate') }}</th>
                                            <th> {{ __('Job Title') }}</th>
                                            <th width="150px"> {{ __('CV') }}</th>
                                            <th width="150px"> {{ __('Date Applied') }}</th>
                                            <th width="100px"> {{ __('Status') }}</th>
                                            {{-- <th width="100px"> {{ __('Remarks') }}</th>
                                                <th width="100px"> {{ __('Crew Code') }}</th>
                                                <th width="100px"> {{ __('Source') }}</th>
                                                <th width="100px"> {{ __('Applied Position') }}</th>
                                                <th width="100px"> {{ __('Department') }}</th>
                                                <th width="100px"> {{ __('Gender') }}</th>
                                                <th width="100px"> {{ __('D.O.B') }}</th>
                                                <th width="100px"> {{ __('Age') }}</th>
                                                <th width="100px"> {{ __('vaccination yf') }}</th>
                                                <th width="100px"> {{ __('vaccination covid 19') }}</th>
                                                <th width="100px"> {{ __('CID') }}</th>
                                                <th width="100px"> {{ __('COC') }}</th>
                                                <th width="100px"> {{ __('Rating Able') }}</th>
                                                <th width="100px"> {{ __('CCM') }}</th>
                                                <th width="100px"> {{ __('Experience') }}</th>
                                                <th width="100px"> {{ __('Application Form') }}</th>
                                                <th width="100px"> {{ __('Contact No') }}</th>
                                                <th width="100px"> {{ __('interview date') }}</th>
                                                <th width="100px"> {{ __('interview by') }}</th>
                                                <th width="100px"> {{ __('interview result') }}</th> --}}
                                            <th width="100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($rows->total() > 0)
                                            @foreach ($rows as $row)
                                                {{-- @dump($row) --}}
                                                @if ($row->status == 'profile_completed')
                                                    <tr class="{{ $row->status }}">
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary btn-sm dropdown-toggle"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    {{ __('Actions') }}
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    {{-- <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'edit', 'id' => $row->id]) }}">{{ __('Edit') }}</a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                                        data-target="#modal-applied-{{ $row->id }}">{{ __('Detail') }}</a> --}}
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'edit', 'id' => $row->id]) }}">{{ __('Approved ') }}</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'rejected', 'id' => $row->id]) }}">{{ __('Rejected') }}</a>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade" id="modal-applied-{{ $row->id }}">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">

                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">
                                                                                {{ __('Applied Detail') }}</h4>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="info-form">
                                                                                <div class="applied-list">
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Candidate:') }}</div>
                                                                                        <div class="val">
                                                                                            @if (!empty($row->candidateInfo->getAuthor->getDisplayName()))
                                                                                                <a href="{{ $row->candidateInfo->getDetailUrl() }}"
                                                                                                    target="_blank">
                                                                                                    <img src="{{ $row->candidateInfo->getAuthor->getAvatarUrl() }}"
                                                                                                        style="border-radius: 50%"
                                                                                                        class="company-logo" />
                                                                                                    {{ $row->candidateInfo->getAuthor->getDisplayName() ?? '' }}
                                                                                                </a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Job Title:') }}</div>
                                                                                        <div class="val">
                                                                                            <a href="{{ $row->jobInfo->getDetailUrl() }}"
                                                                                                target="_blank">{{ $row->jobInfo->title }}</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('CV:') }}</div>
                                                                                        <div class="val">
                                                                                            @if (!empty($row->cvInfo->file_id))
                                                                                                @php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) @endphp
                                                                                                <a href="{{ \Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id) }}"
                                                                                                    target="_blank"
                                                                                                    download>
                                                                                                    {{ $file->file_name . '.' . $file->file_extension }}
                                                                                                </a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Message:') }}</div>
                                                                                        <div class="val">
                                                                                            {{ $row->message }}</div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Date Applied:') }}</div>
                                                                                        <div class="val">
                                                                                            {{ display_date($row->created_at) }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Status:') }}</div>
                                                                                        <div class="val"><span
                                                                                                class="badge badge-{{ $row->status }}">{{ $row->status }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <span class="btn btn-secondary"
                                                                                data-dismiss="modal">{{ __('Close') }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><input type="checkbox" name="ids[]" class="check-item"
                                                                value="{{ $row->id }}">
                                                        </td>
                                                        <td>
                                                            @if (!empty($row->candidateInfo->getAuthor->getDisplayName()))
                                                                <a href="{{ $row->candidateInfo->getDetailUrl() }}"
                                                                    target="_blank">
                                                                    <img src="{{ $row->candidateInfo->getAuthor->getAvatarUrl() }}"
                                                                        style="border-radius: 50%" class="company-logo" />
                                                                    {{ $row->candidateInfo->getAuthor->getDisplayName() ?? '' }}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="title">
                                                            <a href="{{ $row->jobInfo->getDetailUrl() }}"
                                                                target="_blank">{{ $row->jobInfo->title }}</a>
                                                        </td>
                                                        <td>
                                                            @if (!empty($row->cvInfo->file_id))
                                                                @php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) @endphp
                                                                <a href="{{ \Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id) }}"
                                                                    target="_blank" download>
                                                                    {{ $file->file_name . '.' . $file->file_extension }}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>{{ display_date($row->created_at) }}</td>
                                                        <td><span
                                                                class="badge badge-{{ $row->status }}">{{ $row->status }}</span>
                                                        </td>
                                                        {{-- <td>{{ $row->remarks }}</td>
                                                        <td>{{ $row->crew_code }}</td>
                                                        <td>{{ $row->source }}</td>
                                                        <td>{{ $row->applied_position }}</td>
                                                        <td>{{ $row->department }}</td>
                                                        <td>{{ $row->gender }}</td>
                                                        <td>{{ $row->d_o_b }}</td>
                                                        <td>{{ $row->age }}</td>
                                                        <td>{{ $row->vaccination_yf }}</td>
                                                        <td>{{ $row->vaccination_covid_19 }}</td>
                                                        <td>{{ $row->cid }}</td>
                                                        <td>{{ $row->coc }}</td>
                                                        <td>{{ $row->rating_able }}</td>
                                                        <td>{{ $row->ccm }}</td>
                                                        <td>{{ $row->experience }}</td>
                                                        <td>{{ $row->application_form }}</td>
                                                        <td>{{ $row->contact_no }}</td>
                                                        <td>{{ $row->interview_date }}</td>
                                                        <td>{{ $row->interview_by }}</td>
                                                        <td>{{ $row->interview_result }}</td> --}}
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">{{ __('No data') }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        {{ $rows->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div id="Paris" class="tabcontent">
            <h3>Pending</h3>
            <p>Cek Kelengkapan Pelamar.</p>
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                                <table class="table table-hover table-vertical-middle">
                                    <thead>
                                        <tr>
                                            <th class="title"> {{ __('Action') }}</th>
                                            <th width="60px"><input type="checkbox" class="check-all"></th>

                                            <th class="title"> {{ __('Candidate') }}</th>
                                            <th> {{ __('Job Title') }}</th>
                                            <th width="150px"> {{ __('CV') }}</th>
                                            <th width="150px"> {{ __('Date Applied') }}</th>
                                            <th width="100px"> {{ __('Status') }}</th>
                                            {{-- <th width="100px"> {{ __('Remarks') }}</th>
                                                <th width="100px"> {{ __('Crew Code') }}</th>
                                                <th width="100px"> {{ __('Source') }}</th>
                                                <th width="100px"> {{ __('Applied Position') }}</th>
                                                <th width="100px"> {{ __('Department') }}</th>
                                                <th width="100px"> {{ __('Gender') }}</th>
                                                <th width="100px"> {{ __('D.O.B') }}</th>
                                                <th width="100px"> {{ __('Age') }}</th>
                                                <th width="100px"> {{ __('vaccination yf') }}</th>
                                                <th width="100px"> {{ __('vaccination covid 19') }}</th>
                                                <th width="100px"> {{ __('CID') }}</th>
                                                <th width="100px"> {{ __('COC') }}</th>
                                                <th width="100px"> {{ __('Rating Able') }}</th>
                                                <th width="100px"> {{ __('CCM') }}</th>
                                                <th width="100px"> {{ __('Experience') }}</th>
                                                <th width="100px"> {{ __('Application Form') }}</th>
                                                <th width="100px"> {{ __('Contact No') }}</th>
                                                <th width="100px"> {{ __('interview date') }}</th>
                                                <th width="100px"> {{ __('interview by') }}</th>
                                                <th width="100px"> {{ __('interview result') }}</th> --}}
                                            <th width="100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($rows->total() > 0)
                                            @foreach ($rows as $row)
                                                @if ($row->status == 'pending')
                                                    <tr class="{{ $row->status }}">
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary btn-sm dropdown-toggle"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    {{ __('Actions') }}
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    {{-- <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'edit', 'id' => $row->id]) }}">{{ __('Edit') }}</a> --}}
                                                                    {{-- <a class="dropdown-item" href="{{ $row->candidateInfo->getDetailUrl() }}" data-toggle="modal"
                                                                        data-target="{{ $row->candidateInfo->getDetailUrl() }}">{{ __('Detail') }}</a>
                                                                        <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'profile_completed', 'id' => $row->id]) }}">{{ __('Approved Kelengkapan') }}</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'pending', 'id' => $row->id]) }}">{{ __('Rejected Kelengkapan') }}</a> --}}
                                                                </div>
                                                            </div>
                                                            <div class="modal fade"
                                                                id="modal-applied-{{ $row->id }}">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">

                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">
                                                                                {{ __('Applied Detail') }}</h4>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="info-form">
                                                                                <div class="applied-list">
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Candidate:') }}</div>
                                                                                        <div class="val">
                                                                                            @if (!empty($row->candidateInfo->getAuthor->getDisplayName()))
                                                                                                <a href="{{ $row->candidateInfo->getDetailUrl() }}"
                                                                                                    target="_blank">
                                                                                                    <img src="{{ $row->candidateInfo->getAuthor->getAvatarUrl() }}"
                                                                                                        style="border-radius: 50%"
                                                                                                        class="company-logo" />
                                                                                                    {{ $row->candidateInfo->getAuthor->getDisplayName() ?? '' }}
                                                                                                </a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Job Title:') }}</div>
                                                                                        <div class="val">
                                                                                            <a href="{{ $row->jobInfo->getDetailUrl() }}"
                                                                                                target="_blank">{{ $row->jobInfo->title }}</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('CV:') }}</div>
                                                                                        <div class="val">
                                                                                            @if (!empty($row->cvInfo->file_id))
                                                                                                @php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) @endphp
                                                                                                <a href="{{ \Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id) }}"
                                                                                                    target="_blank"
                                                                                                    download>
                                                                                                    {{ $file->file_name . '.' . $file->file_extension }}
                                                                                                </a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Message:') }}</div>
                                                                                        <div class="val">
                                                                                            {{ $row->message }}</div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Date Applied:') }}</div>
                                                                                        <div class="val">
                                                                                            {{ display_date($row->created_at) }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Status:') }}</div>
                                                                                        <div class="val"><span
                                                                                                class="badge badge-{{ $row->status }}">{{ $row->status }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <span class="btn btn-secondary"
                                                                                data-dismiss="modal">{{ __('Close') }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><input type="checkbox" name="ids[]" class="check-item"
                                                                value="{{ $row->id }}">
                                                        </td>
                                                        <td>
                                                            @if (!empty($row->candidateInfo->getAuthor->getDisplayName()))
                                                                <a href="{{ $row->candidateInfo->getDetailUrl() }}"
                                                                    target="_blank">
                                                                    <img src="{{ $row->candidateInfo->getAuthor->getAvatarUrl() }}"
                                                                        style="border-radius: 50%" class="company-logo" />
                                                                    {{ $row->candidateInfo->getAuthor->getDisplayName() ?? '' }}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="title">
                                                            <a href="{{ $row->jobInfo->getDetailUrl() }}"
                                                                target="_blank">{{ $row->jobInfo->title }}</a>
                                                        </td>
                                                        <td>
                                                            @if (!empty($row->cvInfo->file_id))
                                                                @php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) @endphp
                                                                <a href="{{ \Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id) }}"
                                                                    target="_blank" download>
                                                                    {{ $file->file_name . '.' . $file->file_extension }}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>{{ display_date($row->created_at) }}</td>
                                                        <td><span
                                                                class="badge badge-{{ $row->status }}">{{ $row->status }}</span>
                                                        </td>
                                                        {{-- <td>{{ $row->remarks }}</td>
                                                        <td>{{ $row->crew_code }}</td>
                                                        <td>{{ $row->source }}</td>
                                                        <td>{{ $row->applied_position }}</td>
                                                        <td>{{ $row->department }}</td>
                                                        <td>{{ $row->gender }}</td>
                                                        <td>{{ $row->d_o_b }}</td>
                                                        <td>{{ $row->age }}</td>
                                                        <td>{{ $row->vaccination_yf }}</td>
                                                        <td>{{ $row->vaccination_covid_19 }}</td>
                                                        <td>{{ $row->cid }}</td>
                                                        <td>{{ $row->coc }}</td>
                                                        <td>{{ $row->rating_able }}</td>
                                                        <td>{{ $row->ccm }}</td>
                                                        <td>{{ $row->experience }}</td>
                                                        <td>{{ $row->application_form }}</td>
                                                        <td>{{ $row->contact_no }}</td>
                                                        <td>{{ $row->interview_date }}</td>
                                                        <td>{{ $row->interview_by }}</td>
                                                        <td>{{ $row->interview_result }}</td> --}}
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">{{ __('No data') }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        {{ $rows->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div id="Tokyo" class="tabcontent">
            <h3>Approved</h3>
            <p>Pelamar yang Sudah di Approved.</p>
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                                <table class="table table-hover table-vertical-middle">
                                    <thead>
                                        <tr>
                                            <th class="title"> {{ __('Action') }}</th>
                                            <th width="60px"><input type="checkbox" class="check-all"></th>

                                            {{-- <th class="title"> {{ __('Candidate') }}</th> --}}
                                            {{-- <th> {{ __('Job Title') }}</th> --}}
                                            {{-- <th width="150px"> {{ __('CV') }}</th> --}}
                                            {{-- <th width="150px"> {{ __('Date Applied') }}</th> --}}
                                            {{-- <th width="100px"> {{ __('Status') }}</th> --}}
                                            <th width="100px"> {{ __('Remarks') }}</th>
                                            <th width="100px"> {{ __('Crew Code') }}</th>
                                            <th width="100px"> {{ __('Source') }}</th>
                                            <th width="100px"> {{ __('Applied Position') }}</th>
                                            <th width="100px"> {{ __('Department') }}</th>
                                            <th width="100px"> {{ __('Gender') }}</th>
                                            <th width="100px"> {{ __('D.O.B') }}</th>
                                            <th width="100px"> {{ __('Age') }}</th>
                                            <th width="100px"> {{ __('vaccination yf') }}</th>
                                            <th width="100px"> {{ __('vaccination covid 19') }}</th>
                                            <th width="100px"> {{ __('CID') }}</th>
                                            <th width="100px"> {{ __('COC') }}</th>
                                            <th width="100px"> {{ __('Rating Able') }}</th>
                                            <th width="100px"> {{ __('CCM') }}</th>
                                            <th width="100px"> {{ __('Experience') }}</th>
                                            <th width="100px"> {{ __('Application Form') }}</th>
                                            <th width="100px"> {{ __('Contact No') }}</th>
                                            <th width="100px"> {{ __('interview date') }}</th>
                                            <th width="100px"> {{ __('interview by') }}</th>
                                            <th width="100px"> {{ __('interview result') }}</th>
                                            <th width="100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($rows->total() > 0)
                                            @foreach ($rows as $row)
                                                @if ($row->status == 'approved')
                                                    <tr class="{{ $row->status }}">
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary btn-sm dropdown-toggle"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    {{ __('Actions') }}
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    {{-- <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'edit', 'id' => $row->id]) }}">{{ __('Edit') }}</a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                                        data-target="#modal-applied-{{ $row->id }}">{{ __('Detail') }}</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'approved', 'id' => $row->id]) }}">{{ __('Approved') }}</a> --}}
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'rejected', 'id' => $row->id]) }}">{{ __('Rejected') }}</a>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade"
                                                                id="modal-applied-{{ $row->id }}">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">

                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">
                                                                                {{ __('Applied Detail') }}</h4>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="info-form">
                                                                                <div class="applied-list">
                                                                                    {{-- <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Candidate:') }}</div>
                                                                                        <div class="val">
                                                                                            @if (!empty($row->candidateInfo->getAuthor->getDisplayName()))
                                                                                                <a href="{{ $row->candidateInfo->getDetailUrl() }}"
                                                                                                    target="_blank">
                                                                                                    <img src="{{ $row->candidateInfo->getAuthor->getAvatarUrl() }}"
                                                                                                        style="border-radius: 50%"
                                                                                                        class="company-logo" />
                                                                                                    {{ $row->candidateInfo->getAuthor->getDisplayName() ?? '' }}
                                                                                                </a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Job Title:') }}</div>
                                                                                        <div class="val">
                                                                                            <a href="{{ $row->jobInfo->getDetailUrl() }}"
                                                                                                target="_blank">{{ $row->jobInfo->title }}</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('CV:') }}</div>
                                                                                        <div class="val">
                                                                                            @if (!empty($row->cvInfo->file_id))
                                                                                                @php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) @endphp
                                                                                                <a href="{{ \Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id) }}"
                                                                                                    target="_blank" download>
                                                                                                    {{ $file->file_name . '.' . $file->file_extension }}
                                                                                                </a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Message:') }}</div>
                                                                                        <div class="val">
                                                                                            {{ $row->message }}</div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Date Applied:') }}</div>
                                                                                        <div class="val">
                                                                                            {{ display_date($row->created_at) }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Status:') }}</div>
                                                                                        <div class="val"><span
                                                                                                class="badge badge-{{ $row->status }}">{{ $row->status }}</span>
                                                                                        </div>
                                                                                    </div> --}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <span class="btn btn-secondary"
                                                                                data-dismiss="modal">{{ __('Close') }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><input type="checkbox" name="ids[]" class="check-item"
                                                                value="{{ $row->id }}">
                                                        </td>
                                                        <td>
                                                            @if (!empty($row->candidateInfo->getAuthor->getDisplayName()))
                                                                <a href="{{ $row->candidateInfo->getDetailUrl() }}"
                                                                    target="_blank">
                                                                    <img src="{{ $row->candidateInfo->getAuthor->getAvatarUrl() }}"
                                                                        style="border-radius: 50%" class="company-logo" />
                                                                    {{ $row->candidateInfo->getAuthor->getDisplayName() ?? '' }}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="title">
                                                            <a href="{{ $row->jobInfo->getDetailUrl() }}"
                                                                target="_blank">{{ $row->jobInfo->title }}</a>
                                                        </td>
                                                        <td>
                                                            @if (!empty($row->cvInfo->file_id))
                                                                @php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) @endphp
                                                                <a href="{{ \Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id) }}"
                                                                    target="_blank" download>
                                                                    {{ $file->file_name . '.' . $file->file_extension }}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>{{ display_date($row->created_at) }}</td>
                                                        <td><span
                                                                class="badge badge-{{ $row->status }}">{{ $row->status }}</span>
                                                        </td>
                                                        <td>{{ $row->remarks }}</td>
                                                        <td>{{ $row->crew_code }}</td>
                                                        <td>{{ $row->source }}</td>
                                                        <td>{{ $row->applied_position }}</td>
                                                        <td>{{ $row->department }}</td>
                                                        <td>{{ $row->gender }}</td>
                                                        <td>{{ $row->d_o_b }}</td>
                                                        <td>{{ $row->age }}</td>
                                                        <td>{{ $row->vaccination_yf }}</td>
                                                        <td>{{ $row->vaccination_covid_19 }}</td>
                                                        <td>{{ $row->cid }}</td>
                                                        <td>{{ $row->coc }}</td>
                                                        <td>{{ $row->rating_able }}</td>
                                                        <td>{{ $row->ccm }}</td>
                                                        <td>{{ $row->experience }}</td>
                                                        <td>{{ $row->application_form }}</td>
                                                        <td>{{ $row->contact_no }}</td>
                                                        <td>{{ $row->interview_date }}</td>
                                                        <td>{{ $row->interview_by }}</td>
                                                        <td>{{ $row->interview_result }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">{{ __('No data') }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        {{ $rows->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div id="Kelsi" class="tabcontent">
            <h3>Rejected Applicants</h3>
            <p>Pelamar yang ditolak.</p>
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                                <table class="table table-hover table-vertical-middle">
                                    <thead>
                                        <tr>
                                            <th class="title"> {{ __('Action') }}</th>
                                            <th width="60px"><input type="checkbox" class="check-all"></th>

                                            {{-- <th class="title"> {{ __('Candidate') }}</th> --}}
                                            {{-- <th> {{ __('Job Title') }}</th> --}}
                                            {{-- <th width="150px"> {{ __('CV') }}</th> --}}
                                            {{-- <th width="150px"> {{ __('Date Applied') }}</th> --}}
                                            {{-- <th width="100px"> {{ __('Status') }}</th> --}}
                                            <th width="100px"> {{ __('Remarks') }}</th>
                                            <th width="100px"> {{ __('Crew Code') }}</th>
                                            <th width="100px"> {{ __('Source') }}</th>
                                            <th width="100px"> {{ __('Applied Position') }}</th>
                                            <th width="100px"> {{ __('Department') }}</th>
                                            <th width="100px"> {{ __('Gender') }}</th>
                                            <th width="100px"> {{ __('D.O.B') }}</th>
                                            <th width="100px"> {{ __('Age') }}</th>
                                            <th width="100px"> {{ __('vaccination yf') }}</th>
                                            <th width="100px"> {{ __('vaccination covid 19') }}</th>
                                            <th width="100px"> {{ __('CID') }}</th>
                                            <th width="100px"> {{ __('COC') }}</th>
                                            <th width="100px"> {{ __('Rating Able') }}</th>
                                            <th width="100px"> {{ __('CCM') }}</th>
                                            <th width="100px"> {{ __('Experience') }}</th>
                                            <th width="100px"> {{ __('Application Form') }}</th>
                                            <th width="100px"> {{ __('Contact No') }}</th>
                                            <th width="100px"> {{ __('interview date') }}</th>
                                            <th width="100px"> {{ __('interview by') }}</th>
                                            <th width="100px"> {{ __('interview result') }}</th>
                                            <th width="100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($rows->total() > 0)
                                            @foreach ($rows as $row)
                                                @if ($row->status == 'approved')
                                                    <tr class="{{ $row->status }}">
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary btn-sm dropdown-toggle"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    {{ __('Actions') }}
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    {{-- <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'edit', 'id' => $row->id]) }}">{{ __('Edit') }}</a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                                        data-target="#modal-applied-{{ $row->id }}">{{ __('Detail') }}</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'approved', 'id' => $row->id]) }}">{{ __('Approved') }}</a> --}}
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'rejected', 'id' => $row->id]) }}">{{ __('Rejected') }}</a>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade"
                                                                id="modal-applied-{{ $row->id }}">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">

                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">
                                                                                {{ __('Applied Detail') }}</h4>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="info-form">
                                                                                <div class="applied-list">
                                                                                    {{-- <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Candidate:') }}</div>
                                                                                        <div class="val">
                                                                                            @if (!empty($row->candidateInfo->getAuthor->getDisplayName()))
                                                                                                <a href="{{ $row->candidateInfo->getDetailUrl() }}"
                                                                                                    target="_blank">
                                                                                                    <img src="{{ $row->candidateInfo->getAuthor->getAvatarUrl() }}"
                                                                                                        style="border-radius: 50%"
                                                                                                        class="company-logo" />
                                                                                                    {{ $row->candidateInfo->getAuthor->getDisplayName() ?? '' }}
                                                                                                </a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Job Title:') }}</div>
                                                                                        <div class="val">
                                                                                            <a href="{{ $row->jobInfo->getDetailUrl() }}"
                                                                                                target="_blank">{{ $row->jobInfo->title }}</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('CV:') }}</div>
                                                                                        <div class="val">
                                                                                            @if (!empty($row->cvInfo->file_id))
                                                                                                @php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) @endphp
                                                                                                <a href="{{ \Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id) }}"
                                                                                                    target="_blank" download>
                                                                                                    {{ $file->file_name . '.' . $file->file_extension }}
                                                                                                </a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Message:') }}</div>
                                                                                        <div class="val">
                                                                                            {{ $row->message }}</div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Date Applied:') }}</div>
                                                                                        <div class="val">
                                                                                            {{ display_date($row->created_at) }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Status:') }}</div>
                                                                                        <div class="val"><span
                                                                                                class="badge badge-{{ $row->status }}">{{ $row->status }}</span>
                                                                                        </div>
                                                                                    </div> --}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <span class="btn btn-secondary"
                                                                                data-dismiss="modal">{{ __('Close') }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><input type="checkbox" name="ids[]" class="check-item"
                                                                value="{{ $row->id }}">
                                                        </td>
                                                        <td>
                                                            @if (!empty($row->candidateInfo->getAuthor->getDisplayName()))
                                                                <a href="{{ $row->candidateInfo->getDetailUrl() }}"
                                                                    target="_blank">
                                                                    <img src="{{ $row->candidateInfo->getAuthor->getAvatarUrl() }}"
                                                                        style="border-radius: 50%" class="company-logo" />
                                                                    {{ $row->candidateInfo->getAuthor->getDisplayName() ?? '' }}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="title">
                                                            <a href="{{ $row->jobInfo->getDetailUrl() }}"
                                                                target="_blank">{{ $row->jobInfo->title }}</a>
                                                        </td>
                                                        <td>
                                                            @if (!empty($row->cvInfo->file_id))
                                                                @php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) @endphp
                                                                <a href="{{ \Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id) }}"
                                                                    target="_blank" download>
                                                                    {{ $file->file_name . '.' . $file->file_extension }}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>{{ display_date($row->created_at) }}</td>
                                                        <td><span
                                                                class="badge badge-{{ $row->status }}">{{ $row->status }}</span>
                                                        </td>
                                                        <td>{{ $row->remarks }}</td>
                                                        <td>{{ $row->crew_code }}</td>
                                                        <td>{{ $row->source }}</td>
                                                        <td>{{ $row->applied_position }}</td>
                                                        <td>{{ $row->department }}</td>
                                                        <td>{{ $row->gender }}</td>
                                                        <td>{{ $row->d_o_b }}</td>
                                                        <td>{{ $row->age }}</td>
                                                        <td>{{ $row->vaccination_yf }}</td>
                                                        <td>{{ $row->vaccination_covid_19 }}</td>
                                                        <td>{{ $row->cid }}</td>
                                                        <td>{{ $row->coc }}</td>
                                                        <td>{{ $row->rating_able }}</td>
                                                        <td>{{ $row->ccm }}</td>
                                                        <td>{{ $row->experience }}</td>
                                                        <td>{{ $row->application_form }}</td>
                                                        <td>{{ $row->contact_no }}</td>
                                                        <td>{{ $row->interview_date }}</td>
                                                        <td>{{ $row->interview_by }}</td>
                                                        <td>{{ $row->interview_result }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">{{ __('No data') }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        {{ $rows->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div id="Andri" class="tabcontent">
            <h3>All Applicants</h3>
            <p>Semua Pelamar Cipta Wira Tirta.</p>
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                                <table class="table table-hover table-vertical-middle">
                                    <thead>
                                        <tr>
                                            <th class="title"> {{ __('Action') }}</th>
                                            <th width="60px"><input type="checkbox" class="check-all"></th>

                                            {{-- <th class="title"> {{ __('Candidate') }}</th> --}}
                                            {{-- <th> {{ __('Job Title') }}</th> --}}
                                            {{-- <th width="150px"> {{ __('CV') }}</th> --}}
                                            {{-- <th width="150px"> {{ __('Date Applied') }}</th> --}}
                                            {{-- <th width="100px"> {{ __('Status') }}</th> --}}
                                            <th width="100px"> {{ __('Remarks') }}</th>
                                            <th width="100px"> {{ __('Crew Code') }}</th>
                                            <th width="100px"> {{ __('Source') }}</th>
                                            <th width="100px"> {{ __('Applied Position') }}</th>
                                            <th width="100px"> {{ __('Department') }}</th>
                                            <th width="100px"> {{ __('Gender') }}</th>
                                            <th width="100px"> {{ __('D.O.B') }}</th>
                                            <th width="100px"> {{ __('Age') }}</th>
                                            <th width="100px"> {{ __('vaccination yf') }}</th>
                                            <th width="100px"> {{ __('vaccination covid 19') }}</th>
                                            <th width="100px"> {{ __('CID') }}</th>
                                            <th width="100px"> {{ __('COC') }}</th>
                                            <th width="100px"> {{ __('Rating Able') }}</th>
                                            <th width="100px"> {{ __('CCM') }}</th>
                                            <th width="100px"> {{ __('Experience') }}</th>
                                            <th width="100px"> {{ __('Application Form') }}</th>
                                            <th width="100px"> {{ __('Contact No') }}</th>
                                            <th width="100px"> {{ __('interview date') }}</th>
                                            <th width="100px"> {{ __('interview by') }}</th>
                                            <th width="100px"> {{ __('interview result') }}</th>
                                            <th width="100px"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($rows->total() > 0)
                                            @foreach ($rows as $row)
                                                @if ($row->status == 'approved')
                                                    <tr class="{{ $row->status }}">
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-primary btn-sm dropdown-toggle"
                                                                    type="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    {{ __('Actions') }}
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    {{-- <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'edit', 'id' => $row->id]) }}">{{ __('Edit') }}</a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                                        data-target="#modal-applied-{{ $row->id }}">{{ __('Detail') }}</a>
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'approved', 'id' => $row->id]) }}">{{ __('Approved') }}</a> --}}
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('job.admin.applicants.changeStatus', ['status' => 'rejected', 'id' => $row->id]) }}">{{ __('Rejected') }}</a>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade"
                                                                id="modal-applied-{{ $row->id }}">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">

                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">
                                                                                {{ __('Applied Detail') }}</h4>
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <div class="info-form">
                                                                                <div class="applied-list">
                                                                                    {{-- <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Candidate:') }}</div>
                                                                                        <div class="val">
                                                                                            @if (!empty($row->candidateInfo->getAuthor->getDisplayName()))
                                                                                                <a href="{{ $row->candidateInfo->getDetailUrl() }}"
                                                                                                    target="_blank">
                                                                                                    <img src="{{ $row->candidateInfo->getAuthor->getAvatarUrl() }}"
                                                                                                        style="border-radius: 50%"
                                                                                                        class="company-logo" />
                                                                                                    {{ $row->candidateInfo->getAuthor->getDisplayName() ?? '' }}
                                                                                                </a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Job Title:') }}</div>
                                                                                        <div class="val">
                                                                                            <a href="{{ $row->jobInfo->getDetailUrl() }}"
                                                                                                target="_blank">{{ $row->jobInfo->title }}</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('CV:') }}</div>
                                                                                        <div class="val">
                                                                                            @if (!empty($row->cvInfo->file_id))
                                                                                                @php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) @endphp
                                                                                                <a href="{{ \Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id) }}"
                                                                                                    target="_blank" download>
                                                                                                    {{ $file->file_name . '.' . $file->file_extension }}
                                                                                                </a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Message:') }}</div>
                                                                                        <div class="val">
                                                                                            {{ $row->message }}</div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Date Applied:') }}</div>
                                                                                        <div class="val">
                                                                                            {{ display_date($row->created_at) }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="applied-item">
                                                                                        <div class="label">
                                                                                            {{ __('Status:') }}</div>
                                                                                        <div class="val"><span
                                                                                                class="badge badge-{{ $row->status }}">{{ $row->status }}</span>
                                                                                        </div>
                                                                                    </div> --}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <span class="btn btn-secondary"
                                                                                data-dismiss="modal">{{ __('Close') }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><input type="checkbox" name="ids[]" class="check-item"
                                                                value="{{ $row->id }}">
                                                        </td>
                                                        <td>
                                                            @if (!empty($row->candidateInfo->getAuthor->getDisplayName()))
                                                                <a href="{{ $row->candidateInfo->getDetailUrl() }}"
                                                                    target="_blank">
                                                                    <img src="{{ $row->candidateInfo->getAuthor->getAvatarUrl() }}"
                                                                        style="border-radius: 50%" class="company-logo" />
                                                                    {{ $row->candidateInfo->getAuthor->getDisplayName() ?? '' }}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td class="title">
                                                            <a href="{{ $row->jobInfo->getDetailUrl() }}"
                                                                target="_blank">{{ $row->jobInfo->title }}</a>
                                                        </td>
                                                        <td>
                                                            @if (!empty($row->cvInfo->file_id))
                                                                @php $file = (new \Modules\Media\Models\MediaFile())->findById($row->cvInfo->file_id) @endphp
                                                                <a href="{{ \Modules\Media\Helpers\FileHelper::url($row->cvInfo->file_id) }}"
                                                                    target="_blank" download>
                                                                    {{ $file->file_name . '.' . $file->file_extension }}
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>{{ display_date($row->created_at) }}</td>
                                                        <td><span
                                                                class="badge badge-{{ $row->status }}">{{ $row->status }}</span>
                                                        </td>
                                                        <td>{{ $row->remarks }}</td>
                                                        <td>{{ $row->crew_code }}</td>
                                                        <td>{{ $row->source }}</td>
                                                        <td>{{ $row->applied_position }}</td>
                                                        <td>{{ $row->department }}</td>
                                                        <td>{{ $row->gender }}</td>
                                                        <td>{{ $row->d_o_b }}</td>
                                                        <td>{{ $row->age }}</td>
                                                        <td>{{ $row->vaccination_yf }}</td>
                                                        <td>{{ $row->vaccination_covid_19 }}</td>
                                                        <td>{{ $row->cid }}</td>
                                                        <td>{{ $row->coc }}</td>
                                                        <td>{{ $row->rating_able }}</td>
                                                        <td>{{ $row->ccm }}</td>
                                                        <td>{{ $row->experience }}</td>
                                                        <td>{{ $row->application_form }}</td>
                                                        <td>{{ $row->contact_no }}</td>
                                                        <td>{{ $row->interview_date }}</td>
                                                        <td>{{ $row->interview_by }}</td>
                                                        <td>{{ $row->interview_result }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7">{{ __('No data') }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        {{ $rows->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>

        <script>
            function openCity(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>
        <script type="text/javascript"></script>

        {{-- </div> --}}
    </div>
@endsection
