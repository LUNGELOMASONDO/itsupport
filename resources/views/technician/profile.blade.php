@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h3>Your technician: {{$technician->name}}</h3>
                    <p>( {{$technician->id}} )</p>
                    <p>
                        {{$technician->cellphone}}, <a href="mailto:{{$technician->email}}">{{$technician->email}}</a> 
                    </p>
                    <div class="container" style="border-radius:15px;border-style:solid;border-color:#faf7f7;">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <a class="nav-item nav-link active" id="nav-complete-tab" data-toggle="tab" href="#nav-complete" role="tab" aria-controls="nav-complete" aria-selected="true">Complete</a>
                              <a class="nav-item nav-link" id="nav-backlog-tab" data-toggle="tab" href="#nav-backlog" role="tab" aria-controls="nav-backlog" aria-selected="false">Backlog</a>
                              <a class="nav-item nav-link" id="nav-availability-tab" data-toggle="tab" href="#nav-availability" role="tab" aria-controls="nav-availability" aria-selected="false">Availability</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-complete" role="tabpanel" aria-labelledby="nav-complete-tab">
                                Jobs complete in the last 2 months
                                <br/><br/>
                                <ul>
                                    @foreach($donejobs as $job)
                                    <li>
                                        {{$job->done_at}}: {{$job->issue}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="nav-backlog" role="tabpanel" aria-labelledby="nav-backlog-tab">
                                Pending jobs
                                <br/><br/>
                                <ul>
                                    @foreach($pendingjobs as $job)
                                    <li>
                                        {{$job->theday}}: {{$job->issue}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="nav-availability" role="tabpanel" aria-labelledby="nav-availability-tab">
                                Available jobs:
                                <br /> <br />
                                <ul>
                                    @foreach($availablejobs as $job)
                                    <li>
                                        {{$job->theday}}: {{$job->issue}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
