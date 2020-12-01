@extends('layouts.app')

@section('content')
<script>
    window.onload = function(){
        $(document).on('click', '.view-btn', function (e) {
            window.location.href = "/technician/" + e.target.id;
        });
    }
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h3>Your technicians</h3>
                    @if(count($technicians) == 0)
                        You currently have no technicians. Click add technicians button below.
                    @else
                        <div class="container" style="border-radius:15px;border-style:solid;border-color:#faf7f7;">
                            @foreach($technicians as $tech)
                                <div class="row" style="background-color:#faf7f7;padding:4px;">
                                    <div class="col-6">
                                        {{$tech->name}}
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-success"> 
                                            <span class="material-icons view-btn" id="{{$tech->id}}" style="font-size:16px;">visibility</span> 
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <hr />
                    <a href="{{route('technician.add')}}" class="btn btn-primary" style="border-radius:75%;"> 
                        <span class="material-icons">person_add</span> 
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
