



{{-- <div class="modal" id="modal-event" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" datssa-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           
            <div class="modal-body"> --}}
                @include('event.header')
                <form action="{{ route('event.update', $event) }}" method="post">
                    @csrf
                    @method('PUT')

                
                <x-adminlte-select2 label="Professor" name="status" id="select-instructor" fgroup-class="m-0"  enable-old-support> 
                    <option value=""></option>
                    <option value="FF">Falta</option>
                    <option value="FJ">Falta Justificada</option>
                  
                </x-adminlte-select2>

                <x-adminlte-textarea name="absense_comments" rows="3" label="Comentários da aula" fgroup-class="" enable-old-support></x-adminlte-textarea>


            

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
            {{-- </div>
        
        </div>
    </div>
</div> --}}