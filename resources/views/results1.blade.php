<x-result-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $survey->name }}  
        </h2>
    </x-slot>
    
    <section class="content">
      <div class="container">
 fgdfgdfgzdfg
        <div class="row">
          @foreach($surveyTree as $element)
            @if($element[0]->parent_id == 0)
              @if($element[0]->type == 'checkbox' || $element[0]->type == 'radio')
                @livewire('results.checkbox', ['element'=>$element, 'results'=>$results])
              @elseif($element[0]->type == 'multy_checkbox' || $element[0]->type == 'multy_radio')
                @livewire('results.multy-option', ['element'=>$element, 'results'=>$results])
              @elseif($element[0]->type == 'linear_scale')
                @livewire('results.linear', ['element'=>$element, 'results'=>$results])
              @elseif($element[0]->type == 'short_text' || $element[0]->type == 'long_text')
                @livewire('results.text', ['element'=>$element, 'results'=>$results])
              @endif
            @endif
          @endforeach
        </div>
        <!-- /.row -->
        
        
      </div><!-- /.container-fluid -->
    </section>
</x-result-layout>