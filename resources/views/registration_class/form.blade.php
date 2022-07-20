
@if(!isset($registration->id))
    <form action="{{ route('registration.store') }}" method="post">
@else
<form action="{{ route('registration.update', $registration) }}" method="post">
    @method('PUT')
@endif

<div class="row">
    @csrf

    <input type="hidden" name="status" value="A">

    <x-adminlte-select2 name="student_id" id="student_id" label="Aluno" fgroup-class="col-12 col-lg-12 col-md-3 col-sm-6" enable-old-support> 
        <option value=""></option>
        @foreach($students as $student)
        <x-adminlte-options :options="[$student->id => $student->user->name]" :selected="$registration->student_id"  />
        @endforeach
    </x-adminlte-select2>

    <x-adminlte-input name="date_start" label="Data da Matrícula" type="date"  fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $registration->date_start ??  date('Y-m-d') }}"  />

    <x-adminlte-select2 name="plan_id" id="plan_id" label="Plano" fgroup-class="col-12 col-lg-3 col-md-3 col-sm-6" onchange="getValueFromPlan(this)" enable-old-support> 
        <option value=""></option>
        @foreach($plans as $plan)
        <option value="{{ $plan->id }}" data-value="{{ $plan->value }}" {{ ($plan->id == $registration->plan_id) ? 'selected' : '' }}>{{ $plan->name . ' ('.$plan->value.')' }}</option>
        @endforeach
    </x-adminlte-select2>
    
    <x-adminlte-input name="value" id="value" label="Valor" fgroup-class="col-12 col-lg-1 col-md-3 col-sm-6" enable-old-support value="{{ $registration->value }}" />
    <input type="hidden" name="status" value="A">

    <x-adminlte-input name="discount" id="discount" label="Desconto" fgroup-class="col-12 col-lg-1 col-md-3 col-sm-6" onkeyup="getValueDiscount(this.value)" value="{{ $registration->discount }}" enable-old-support  />
    <x-adminlte-input name="final_value" id="final_value" label="Valor Final" fgroup-class="col-12 col-lg-5 col-md-3 col-sm-6" enable-old-support value="{{ $registration->final_value }}" />

    {{-- <x-adminlte-select2 name="payment_type_id" id="payment_id" label="Forma" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support> 
        <option value=""></option>
        @foreach($paymentMethods as $paymentMethod)
        <option value="{{ $paymentMethod->id }}" {{ ($paymentMethod->id == $registration->payment_method_id) ? 'selected' : '' }}>{{ $paymentMethod->name }}</option>
        @endforeach
    </x-adminlte-select2> --}}

    <x-adminlte-textarea name="comments" rows="3" label="Observações" fgroup-class="col-12  col-lg-12 col-sm-6" enable-old-support>{{ $registration->comments }}</x-adminlte-textarea>
{{-- 
    <x-adminlte-input name="expiration_day" label="Dia de Vencto." fgroup-class="col-9 col-lg-1 col-md-6 col-sm-12" enable-old-support value="{{ $registration->expiration_day }}"  /> --}}


</div>

<x-adminlte-button type="submit" label="Salvar"  icon="fas fa-lg fa-save"/>
<x-package-button-link class="bg-purple" label="Voltar" theme="light"  url="{{ route('registration.index') }}" icon="fas fa-chevron-left" />


</form>


@section('plugins.Select2', true)

@section('js')
    <script>

        function getValueFromPlan(obj) {
            value = $('option:selected', obj).data('value');
            $('#value').val(value)


            calculateDiscount(value, $('#discount').val());
        }
        function getValueDiscount(discount) {
            calculateDiscount($('#value').val(), discount)
        }

        function calculateDiscount(value, discount) {

            if(discount == '' || discount == 0) {
                final = value
            } else {
                final = value - (value * (discount / 100));
            }

            $('#final_value').val(final)
        }

    </script>
@stop
