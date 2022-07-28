<div class="modal fade" id="modal-presence" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" data-bacskdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body p-0">
                <div class="modal-header bg-purple">
                    Registrar Presença - {{ $event->extenseDate }}

                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="p-3">
                    @include('event.header')

                    <form id="form-presence" action="{{ route('event.update', $event) }}" method="post">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="status" value="{{ $status }}">

                        <x-adminlte-select2 label="Professor" name="instructor_id_executed" id="select-instructor" fgroup-class="m-0" enable-old-support>
                            <option value=""></option>
                            @foreach($instructors as $instructor)
                            <x-adminlte-options :options="[$instructor->id => $instructor->user->name]" :selected="$event->instructor_id" />
                            @endforeach
                        </x-adminlte-select2>

                        <x-adminlte-textarea name="comments" rows="3" label="Comentários da aula" fgroup-class="" enable-old-support></x-adminlte-textarea>


                        <hr>

                        <div class="float-right mb-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fa fa-times" aria-hidden="true"></i> Fechar</button>
                            <button type="button" class="bg-purple btn" onclick="sendForms('form-presence')">
                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                Salvar
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>