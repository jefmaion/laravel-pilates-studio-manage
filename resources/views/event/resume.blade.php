



<div class="modal " id="modal-event" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" data-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-purple">
                <h5 class="modal-title">
                    <span class="badge badge-pill badge-primary">Aula NOrmal</span>
                   
                </h5>
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
                
                
                
                
                
                
                {{-- <span class="badge badge-pill badge-warning">Matrícula vence hoje</span> --}}
                
                <div class="text-muted">
                    
                    <div class="text-muted">
                        <i class="fas fa-user-ninja    "></i>
                        {{ $event->instructor->user->name }}
                    </div>
                </div>
                
                <hr>
                
                <strong>Últimos Aparelhhos Utilizados</strong>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus voluptatibus expedita cum eius exercitationem, itaque dolorum cumque eos praesentium porro sint illo nulla officiis maxime accusamus dicta iste deleniti blanditiis?</p>
              
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Marcar Falta
                </button>

                <button type="button"  class="btn-success btn" data-dismiss="modal" onClick="setPresence({{ $event->id }})">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    Marcar Presença
                </button>
            </div>
        </div>
    </div>
</div>