<div class="modal fade" id="modal-reschedule" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" data-bacskdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body p-0">

                <div class="modal-header bg-purple">
                    <h5 class="modal-title" id="my-modal-title">Reagendar/Remarcar Aula</h5>

                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="p-3">
                    @include('event.header')

                    <form id="form-reschedule" action="{{ route('event.reschedule.store', $event) }}" method="POST">
                        @csrf

                        <input type="hidden" name="class_parent_id" value="{{ $event->id }}">
                        <input type="hidden" name="class_type" value="RP">
                        <input type="hidden" name="status" value="AA">

                        <div class="row">
                            <x-adminlte-input name="date" label="Nova Data" type="date" value="{{ $event->date }}" fgroup-class="col-6" enable-old-support value="" />

                            <x-adminlte-select2 name="time" label="Horário" class="select2" fgroup-class="col-6" enable-old-support>
                                <option value=""></option>
                                @for($i=7;$i<=20;$i++) 
                                    <x-adminlte-options :options="[sprintf('%02d', $i).':00:00' =>  sprintf('%02d', $i) .':00:00']" :select="$event->time" />
                                @endfor
                            </x-adminlte-select2>


                            <x-adminlte-select2 name="instructor_id" label="Professor" class="select2" fgroup-class="col-12" enable-old-support>
                                <option value=""></option>
                                @foreach($instructors as $instructor)
                                <x-adminlte-options :options="[$instructor->id =>  $instructor->user->name]" />
                                @endforeach
                            </x-adminlte-select2>

                            <x-adminlte-textarea name="comments" rows="3" label="Observações" fgroup-class="col-12" enable-old-support></x-adminlte-textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Fechar
                </button>
                <button type="button" class="bg-purple btn" onclick="sendForms('form-reschedule')">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    Salvar Reagendamento
                </button>
            </div>
        </div>
    </div>
</div>