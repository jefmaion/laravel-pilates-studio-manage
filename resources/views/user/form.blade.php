<div class="row">
    @csrf

 
    <input type="hidden" name="user[password]" value="123">

    <x-adminlte-input name="user[cpf]" label="CPF" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $user->cpf }}" />

    <x-adminlte-input name="user[name]" label="Nome" fgroup-class="col-9 col-lg-6 col-md-6 col-sm-12" enable-old-support value="{{ $user->name }}"  />
    <x-adminlte-input name="user[nickname]" label="Apelido" fgroup-class="col-3 col-lg-2 col-md-6 col-sm-12" enable-old-support value="{{ $user->nickname }}"  />

    <x-adminlte-input name="user[birth_date]" label="Data de Nasc." type="date"  fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $user->birth_date }}"  />


    <x-adminlte-select2 name="user[gender]" id="gender" label="Sexo" fgroup-class="col-12 col-lg-3 col-md-3 col-sm-6" empty-option="Select an option..." > 
        <option value=""></option>
        <x-adminlte-options :options="['M' => 'Masculino', 'F' => 'Feminino']" :selected="[old('gender') ?? $user->gender]"  />
    </x-adminlte-select2>

    
    {{-- <x-adminlte-input name="user[rg]" label="RG" fgroup-class="col-12 col-lg-3 col-md-3 col-sm-6" enable-old-support  value="{{ $user->rg }}" /> --}}

    {{-- <div class="col-12 text-muted mt-3">
        <strong>Contato</strong>
        <hr class="mt-0">
    </div> --}}

    <x-adminlte-input name="user[phone]" label="Telefone (WhatsApp)" fgroup-class="col-12 col-lg-3 col-md-3 col-sm-6" enable-old-support value="{{ $user->phone }}"  />
    <x-adminlte-input name="user[phone2]" label="Telefone Recado" fgroup-class="col-12 col-lg-3 col-md-3 col-sm-6" enable-old-support value="{{ $user->phone2 }}" />
    <x-adminlte-input name="user[email]" label="Email" fgroup-class="col-12 col-lg-3 col-md-12 col-sm-12" enable-old-support value="{{ $user->email }}" />

    <div class="col-12 text-muted mst-3">
        <strong>Endereço</strong>
        <hr class="mt-0">
    </div>

    <x-adminlte-input name="user[zipcode]" label="CEP" fgroup-class="col-12 col-lg-2 col-sm-3" enable-old-support onblur="pesquisacep(this.value);" value="{{ $user->zipcode }}" />
    <x-adminlte-input name="user[address]" label="Endereço" fgroup-class="col-12 col-lg-5 col-sm-7" enable-old-support value="{{ $user->address }}" />
    <x-adminlte-input name="user[number]" label="Nº" fgroup-class="col-12 col-lg-1 col-sm-2" enable-old-support value="{{ $user->number }}" />
    <x-adminlte-input name="user[complement]" label="Complemento" fgroup-class="col-12 col-lg-4 col-sm-6" enable-old-support value="{{ $user->complement }}" />
    <x-adminlte-input name="user[district]" label="Bairro" fgroup-class="col-12 col-lg-6 col-sm-6" enable-old-support value="{{ $user->district }}" />
    <x-adminlte-input name="user[city]" label="Cidade" fgroup-class="col-12 col-lg-4 col-sm-6" enable-old-support value="{{ $user->city }}" />
    <x-adminlte-input name="user[state]" label="Estado" fgroup-class="col-12  col-lg-2 col-sm-6" enable-old-support value="{{ $user->state }}" />

        
    {{-- <x-adminlte-textarea name="user[comments]" rows="3" label="Observações" fgroup-class="col-12  col-lg-12 col-sm-6" enable-old-support>{{ $user->comments }}</x-adminlte-textarea> --}}
</div>





@section('plugins.Select2', true)

@section('js')
    <script src="{{ asset('js/viacep.js') }}">  </script>
@stop