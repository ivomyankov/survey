<div class="col-12 bg-light rounded shadow p-4 my-4">
    <div class="row">        
        <div class="col-12">
            <b>{{$element[0]->text}}</b>
        </div>            
        <div class="col-12 pb-3">
            <b class="text-info">{{ $options[1] ?? 0 }}%</b> auf PKW , <b class="text-info">{{$options[2] ?? 0 }}%</b> auf Kleintransporter und Transporter bis 3,5 Tonnen, <b class="text-info">{{$options[3] ?? 0 }}%</b> Sonstige           
        </div>
    </div>
</div>
<!-- ./col -->