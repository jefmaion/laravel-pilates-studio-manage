<div class="modal-header bg-purple">
    <h5 class="modal-title" id="my-modal-title">Registrar Presença - {{ $event->extenseDate }}</h5>
    
    <button class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="p-3">
                @include('event.header')
                
                
                {{-- <h3 class="mb-2 font-weighst-light text-dark">
                     <strong>{{ $event->student->user->name }}</strong>  - Marcar Presença
                </h3>
                <p class="text-muted m-0">
                    {{ $event->extenseDate }} | {{ $event->time }} | Aula Normal
                </p>
                
               
                <hr>  --}}

                <form action="{{ route('event.update', $event) }}" method="post">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="status" value="{{ $status }}">
                
                <x-adminlte-select2 label="Professor" name="instructor_id_executed" id="select-instructor" fgroup-class="m-0"  enable-old-support> 
                    <option value=""></option>
                    @foreach($instructors as $instructor)
                    <x-adminlte-options :options="[$instructor->id => $instructor->user->name]" :selected="$event->instructor_id"  />
                    @endforeach
                </x-adminlte-select2>

                <x-adminlte-textarea name="comments" rows="3" label="Comentários da aula" fgroup-class="" enable-old-support></x-adminlte-textarea>


            

                <hr>

                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                    <div class="col-8 text-right">

        
                        <button type="submit"  class="btn-success btn">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                            Salvar
                        </button>





                    </div>
                  </div>
                </form>

</div>