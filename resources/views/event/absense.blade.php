<div class="modal fade" id="modal-absense" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" data-bacskdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body p-0">



                <div class="modal-header bg-danger ">
                    <strong> <i class="fa fa-times-circle" aria-hidden="true"></i> Registrar Falta</strong>
                
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                
                <div class="p-3">
                
                

                                @include('event.header')
                                <form id="form-absense" action="{{ route('event.update', $event) }}" method="post">
                                    @csrf
                                    @method('PUT')
                
                                
                                <x-adminlte-select2 label="Tipo da Falta" name="status" id="select-instructor" class="select2" fgroup-class="m-0"  enable-old-support> 
                                    <option value=""></option>
                                    <option value="FJ">Com Aviso</option>
                                    <option value="FF">Sem Aviso</option>
                                </x-adminlte-select2>
                
                                <x-adminlte-textarea name="absense_comments" rows="3" label="Motivo" fgroup-class="" enable-old-support></x-adminlte-textarea>

                
                                
                                </form>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i> 
                    Fechar
                </button>
                <button type="button" class="bg-danger  btn" onclick="sendForms('form-absense')">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    Salvar
                </button>
            </div>
        </div>
    </div>    
</div>

