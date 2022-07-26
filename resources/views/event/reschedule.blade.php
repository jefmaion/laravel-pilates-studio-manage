



{{-- <div class="modal " id="modal-event" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" data-bacskdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body"> --}}

                @include('event.header')

                <form id="form-reschedule" action="{{ route('event.reschedule.store', $event) }}" method="POST">
                    @csrf

                <input type="hidden" name="class_parent_id" value="{{ $event->id }}">
                <input type="hidden" name="class_type" value="RP">
                <input type="hidden" name="status" value="AA">

                <div class="row">
                    <x-adminlte-input name="date" label="Nova Data" type="date" value="{{ $event->date }}"  fgroup-class="col-6" enable-old-support value=""  />

                    <x-adminlte-select2 name="time" label="Horário" id="select-week-" fgroup-class="col-6"  enable-old-support > 
                        <option value=""></option>
                        @for($i=7;$i<=20;$i++)
                        <x-adminlte-options :options="[sprintf('%02d', $i).':00:00' =>  sprintf('%02d', $i) .':00:00']"  :select="$event->time"  />
                        @endfor
                    </x-adminlte-select2>


                    <x-adminlte-select2 name="instructor_id" label="Professor" id="select-week-" fgroup-class="col-12"  enable-old-support > 
                        <option value=""></option>
                        @foreach($instructors as $instructor)
                        <x-adminlte-options :options="[$instructor->id =>  $instructor->user->name]"   />
                        @endforeach
                    </x-adminlte-select2>

                    <x-adminlte-textarea name="comments" rows="3" label="Observações" fgroup-class="col-12" enable-old-support></x-adminlte-textarea>
                </div>

            
            <hr>

              <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
                <div class="col-8 text-right">

                    <button type="submit"  class="bg-purple btn" >
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        Salvar Reagendamento
                    </button>

                    
              </div>
            </form>
                
                

{{--              
            </div>
          
        </div>
    </div>
</div> --}}