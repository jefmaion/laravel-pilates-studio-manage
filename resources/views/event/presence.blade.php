



<div class="modal" id="modal-event" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title">Aula</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <h4 class="mb-2">
                    <b>{{ $event->student->user->name }}</b>
                    <span class="float-right"><small>{{ $event->classType->name }} </small></span>
                </h4>
                
                <div class="text-muted">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    {{ $event->student->user->phone }}
                </div>
                
                <div class="text-muted">
                    <i class="fas fa-clock    "></i>
                    {{ $event->date }}  {{ $event->time }} 
                </div>
                
              
                
                <td>
                    <x-adminlte-select2 name="instructor_id" id="select-instructor" fgroup-class="m-0"  enable-old-support> 
                        <option value=""></option>
                        @foreach($instructors as $instructor)
                        <x-adminlte-options :options="[$instructor->id => $instructor->user->name]" :selected="$event->instructor_id"  />
                        @endforeach
                    </x-adminlte-select2>
                </td>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Fechar</button>
                <button type="button"  class="btn-success btn">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    Salvar
                </button>
            </div>
        </div>
    </div>
</div>