<div class="col-12 bg-light rounded shadow p-4 my-4">
    <div class="row">
        <div class="col-12">
            <b>{{$element[0]->text}}</b>
        </div>
    </div>
    <!-- ./row -->
    <div class="row">
        <div class="col-12">
            <ul>
                @if(isset($this->results['q'.$element[0]->id.'_t']))
                    @foreach($this->results['q'.$element[0]->id.'_t'] as $value)
                        <li> {{$value}}</li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <!-- ./row -->
</div>
<!-- ./col -->
