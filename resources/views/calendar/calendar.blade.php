 <div class="container-fluid">
        <h4 class="display-4 mb-4 text-center">{{$date->format('F Y')}}</h4>
        <div class="row d-none d-sm-flex p-1 bg-dark text-white">
            <h5 class="col-sm p-1 text-center">Sunday</h5>
            <h5 class="col-sm p-1 text-center">Monday</h5>
            <h5 class="col-sm p-1 text-center">Tuesday</h5>
            <h5 class="col-sm p-1 text-center">Wednesday</h5>
            <h5 class="col-sm p-1 text-center">Thursday</h5>
            <h5 class="col-sm p-1 text-center">Friday</h5>
            <h5 class="col-sm p-1 text-center">Saturday</h5>
        </div>
        <div class="row border border-right-0 border-bottom-0">
        {!! $day !!}
        </div>
 </div>

