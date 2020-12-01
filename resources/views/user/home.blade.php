@extends('layouts.app')

@section('content')
<script>
     window.onload = function(){
        $(document).on('change', '#slotday', function (e) {
            var slot = new Date(document.getElementById('slotday').value);
            var today = new Date();
            if(slot.getDate() < today.getDate())
            {
                document.getElementById('slotday').value = null;
                alert('Can not select a date in the past');
            }
        });
    }
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">IT Support Dashboard</div>

                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Notifications(@isset($notifications){{count($notifications)}} @else 0 @endisset)</a>
                          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Appointments</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            @isset($notifications)
                                <ul>
                                @foreach($notifications as $note)
                                    <li>
                                        <div class="row">
                                            <div class="col-6">
                                                {{$note->message}}
                                            </div>
                                            <div class="col-6">
                                                <a class="btn btn-dark" href="/read/{{$note->id}}">
                                                    Read
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                                @else
                                    No notifications currently.
                            @endisset
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <b>Make an appointment:</b>
                            <br />
                            <form action="/makeappointment" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    Issue:
                                    <input type="text" id="issue" name="issue" class="form-control">
                                    
                                    @error('issue')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    Description:
                                    <textarea class="form-control" name="description"></textarea>
                                    
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    Day: 
                                    <input type="date" id="slotday" name="slotday" class="form-control">
                                
                                    @error('slotday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    Slots: (max 2 slots a day)
                                    <br />
                                    <select id="slottime1" name="slottime1" class="form-control">
                                        <option value=""></option>
                                    @foreach($slots as $slot)
                                        <option value="{{$slot->id}}">{{$slot->starttime}} - {{$slot->endtime}}</option> 
                                    @endforeach
                                    </select>
                                    @error('slottime1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <select id="slottime2" name="slottime2" class="form-control">
                                    <option value=""></option>
                                @foreach($slots as $slot)
                                    <option value="{{$slot->id}}">{{$slot->starttime}} - {{$slot->endtime}}</option> 
                                @endforeach
                                </select>
                                <br/>
                                <input type="submit" class="btn-primary" value="Book"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
