<div id="{{$element[0]->id}}" class="rounded shadow bg-light p-4 position-relative {{ $element[0]->visible === 0 ? 'hidden' : '' }} mt-5" alt="{{$element[0]->id}}">
    <b>{{$element[0]->text}} </b> 
    <br><br>
    <textarea class="w-100 input-border q{{$element[0]->id}}" type="text" rows="{{$rows}}" name="q{{$element[0]->id}}_t"></textarea>
</div>
