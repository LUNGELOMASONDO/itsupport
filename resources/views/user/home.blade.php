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
                          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Notifications(0)</a>
                          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Appointments</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            No notifications currently.
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            Make an appointment:
                            <br />
                            Day: 
                            <input type="date" id="slotday" name="slotday" class="form-control">
                            <br/>
                            Slots: (max 2 slots a day)
                            <br />
                            <select id="slottime1" name="slottime1" class="form-control">
                                <option value=""></option>
                            @foreach($slots as $slot)
                                <option value="{{$slot->id}}">{{$slot->starttime}} - {{$slot->endtime}}</option> 
                            @endforeach
                            </select>
                            <br/>
                            <select id="slottime2" name="slottime2" class="form-control">
                                <option value=""></option>
                            @foreach($slots as $slot)
                                <option value="{{$slot->id}}">{{$slot->starttime}} - {{$slot->endtime}}</option> 
                            @endforeach
                            </select>
                            <br/>
                            <input type="submit" class="btn-primary" value="Book"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
