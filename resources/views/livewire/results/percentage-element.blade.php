<div class="col-12 bg-light rounded shadow p-4 my-4">
    <div class="row">
        @foreach($element as $key => $value)
            @if($key == 0)
                <div class="col-12">
                    <b>{{$value->text}}</b>
                </div>
            @else
                <div class="col-9 col-sm-3 pt-1">
                    <div class="progress">
                        <div class="progress-bar bg-info pl-1 text-left" role="progressbar" aria-valuenow="{{ $options[$key] ?? 0 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $options[$key] ?? 0 }}%">
                            <span class="d-none">{{ $options[$key] ?? 0 }}% </span>
                        </div>
                    </div>
                </div>
                <div class="col-3 col-sm-1 text-right pr-3">
                    {{ $options[$key] ?? 0 }}%
                </div>
                <div class="col-sm-8" title="{{$value->id}}">
                    {{$value->text}}
                </div>
            @endif
        @endforeach
    </div>
</div>
<!-- ./col -->
{{--dd($element, $options,$results)--}}