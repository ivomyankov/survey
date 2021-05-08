<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $survey->name }}  
        </h2>
    </x-slot>
    
    <div class="container p-5" style="max-width:900px">{{--dd($elements)--}}
        <form action=" {!! route('submitSurvey',$survey->id) !!}" method="POST">
            @csrf
            <input type="hidden" name="required" value="{{implode(',', $required)}}">
            @foreach($elements as $element)
                @livewire('element-builder', ['element'=>$element])                  
            @endforeach

            <button type="submit" class="btn btn-info w-25" value="Send" >Send</button>
        </form>
    </div>
</x-guest-layout>