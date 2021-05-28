<x-guest-layout>
    <x-slot name="header">
        <h2 class="p-2">
            {{ $survey->name }}  
        </h2>
    </x-slot>
    
    <div class="container p-5" style="max-width:900px">{{--dd($elements)--}}
        <form action=" {!! route('submitSurvey',$survey->id) !!}" method="POST">
            @csrf
            <input type="hidden" name="required" value="{{implode(',', $required)}}">
            @if($elements)
                @foreach($elements as $element)
                    @livewire('element-builder', ['element'=>$element])                  
                @endforeach
            
                <button type="submit" class="btn btn-info w-25" value="Send" >Send</button>
            @endif
        </form>
    </div>
</x-guest-layout>

@push('scripts')
    <script>
        alert('test');
    </script>
@endpush