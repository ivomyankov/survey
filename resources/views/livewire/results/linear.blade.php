<div class="col-12 bg-light rounded shadow p-4 my-4">
    <div class="row">
        <div class="col-12">
            <b>{{$element[0]->text}}</b>
        </div>
    </div>
    <!-- ./row -->
    <div class="row justify-content-center mt-2">
        <div class="col-6" >{{$bothOptions[0]->id}} {{$bothOptions[0]->text}}</div> 
        <div class="col-6 text-right" >{{$bothOptions[1]->id}} {{$bothOptions[1]->text}}</div>
            @for($i = 1; $i<=$scale; $i++)
                <div class="col-1 mx-2 text-center position-relative">
                    @if(isset($result[$i]))
                    <div class="progress vertical">
                        <div class="bar bg-info" style="height: {{round(($result[$i]/$devide)*100, 1)}}%;width:100%;position: absolute; bottom: 0;"></div>
                        <span class="position-absolute text-info" style="bottom: {{round(($result[$i]/$devide)*100)+5}}%; left:0;">{{round(($result[$i]/$devide)*100, 1)}}%</span>
                    </div>
                    @else
                    <div class="progress vertical">
                        <span class="text-info" style="position: absolute; bottom: 10px; left:30%;">0%</span>
                    </div>
                    @endif
                    <br>{{$i}} 
                </div>
            @endfor
        
    </div>
    <!-- ./row -->
</div>
<!-- ./col -->
