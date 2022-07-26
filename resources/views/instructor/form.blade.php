



<div class="row">


     <div class="col-12 text-muted mt-3">
        <strong>Informações Profissionais</strong>
        <hr class="mt-0">
    </div>

    <x-adminlte-input name="instructor[profession]" label="Formação" fgroup-class="col-3 col-lg-3 col-md-6 col-sm-12" enable-old-support value="{{ $instructor->profession }}"  />

    <x-adminlte-input name="instructor[profession_document]" label="Registro" fgroup-class="col-3 col-lg-3 col-md-6 col-sm-12" enable-old-support value="{{ $instructor->profession_document }}"  />

    
    <x-adminlte-select2 name="instructor[payment_type]" id="payment_type" label="Modalidade de Pagamento" fgroup-class="col-12 col-lg-3 col-md-3 col-sm-6" empty-option="Select an option..." > 
        <option value=""></option>
        <x-adminlte-options :options="['P' => 'Percentual (%)', 'A' => 'Valor Por Aula']" :selected="[old('payment_type') ?? $instructor->payment_type]"  />
    </x-adminlte-select2>

    <x-adminlte-input name="instructor[payment_value]" label="Valor" fgroup-class="col-3 col-lg-3 col-md-6 col-sm-12" enable-old-support value="{{ $instructor->payment_value }}"  />


    <x-adminlte-textarea name="user[comments]" rows="3" label="Observações" fgroup-class="col-12  col-lg-12 col-sm-6" enable-old-support>{{ $user->comments ?? '' }}</x-adminlte-textarea>

    
</div>