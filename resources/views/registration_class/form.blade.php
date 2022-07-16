
<form action="{{ route('registration.class.store', $registration) }}" method="post">
<div class="row">
    @csrf

    <input type="hidden" name="start_date" value="">

    <x-adminlte-select2 name="instructor_id" id="instructor_id" label="Instrutor" fgroup-class="col-12 col-lg-12 col-md-3 col-sm-6" enable-old-support> 
         <option value=""></option>
         @foreach($instructors as $instructor)
         <x-adminlte-options :options="[$instructor->id => $instructor->user->name]"   />
         @endforeach
     </x-adminlte-select2>
 
     <x-adminlte-select2 name="weekday" id="weekday" label="Dia da Semana" fgroup-class="col-12 col-lg-12 col-md-3 col-sm-6" enable-old-support> 
         <option value=""></option>
         @foreach($weeks as $week)
         <x-adminlte-options :options="[$week['weekday'] => $week['week']]"   />
         @endforeach
     </x-adminlte-select2>
 
     <x-adminlte-select2 name="time" id="time" label="Horário" fgroup-class="col-12 col-lg-12 col-md-3 col-sm-6" enable-old-support> 
         <option value=""></option>
         @for($i=7;$i<=20;$i++)
         <x-adminlte-options :options="[$i.':00:00' => $i.':00:00']"   />
         @endfor
     </x-adminlte-select2>
</div>

<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
<x-package-button-link label="Voltar" theme="light"  url="{{ route('registration.class.index', $registration) }}" icon="fas fa-chevron-left" />


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
