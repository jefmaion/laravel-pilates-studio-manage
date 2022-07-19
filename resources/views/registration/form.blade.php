
@if(!isset($registration->id))
    <form action="{{ route('registration.store') }}" method="post">
@else
    <form action="{{ route('registration.update', $registration) }}" method="post">
    @method('PUT')
@endif

@csrf


<div class="row">

    <div class="col-7">
        <div class="row">
            <input type="hidden" name="status" value="A">

            <x-adminlte-input name="date_start"     label="Data da Matrícula" type="date"  fgroup-class="col-12 col-lg-3 col-md-3 col-sm-6" enable-old-support value="{{ $registration->date_start ??  date('Y-m-d') }}"  />
        
            <x-adminlte-select2 name="student_id" id="student_id" label="Aluno" fgroup-class="col-12 col-lg-9 col-md-3 col-sm-6" enable-old-support> 
                <option value=""></option>
                @foreach($students as $student)
                <x-adminlte-options :options="[$student->id => $student->user->name]" :selected="$registration->student_id"  />
                @endforeach
            </x-adminlte-select2>

            
            
        
            <x-adminlte-select2 name="plan_id" id="plan_id" label="Plano" fgroup-class="col-12 col-lg-4 col-md-3 col-sm-6" onchange="getValueFromPlan(this)" enable-old-support> 
                <option value=""></option>
                @foreach($plans as $plan)
                <option value="{{ $plan->id }}" data-value="{{ $plan->value }}" {{ ($plan->id == $registration->plan_id) ? 'selected' : '' }}>{{ $plan->name . ' ('.$plan->value.')' }}</option>
                @endforeach
            </x-adminlte-select2>

            <x-adminlte-input name="class_per_week" label="Aulas por semana" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $registration->class_per_week }}" />
            
            <x-adminlte-input type="hidden" name="value" id="value" group-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $registration->value }}" />
            <x-adminlte-input name="discount" class="strong" id="discount" label="Desconto (%)" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" onkeyup="getValueDiscount(this.value)" value="{{ $registration->discount }}" enable-old-support  />
            <x-adminlte-input name="final_value" id="final_value" label="Valor Final" fgroup-class="col-12 col-lg-4 col-md-3 col-sm-6" enable-old-support value="{{ $registration->final_value }}" />
        </div>
    </div>

    <div class="col-5">
        <x-adminlte-textarea name="comments" rows="5" label="Observações" fgroup-class="col-12 col-lg-12 col-sm-6" enable-old-support>{{ $registration->comments }}</x-adminlte-textarea>
    </div>
</div>

<p class="text-muted"><strong>Aulas na Semana</strong></p>
<hr>

<table class="table tables-sm">
    <thead class="thead-light">

        <tr>
            <th></th>
            <th class="text-center">Segunda-Feira</th>
            <th class="text-center">Terça-Feira</th>
            <th class="text-center">Quarta-Feira</th>
            <th class="text-center">Quinta-Feira</th>
            <th class="text-center">Sexta-Feira</th>
            <th class="text-center">Sábado</th>
        </tr>

        <tr>
            <td class="table-active"><strong>Horário</strong></td>
            @foreach($weeks as $i => $week)

            <td>
                <input type="hidden" name="week[{{ $i }}][class_weekday]" value="{{ $week['weekday'] }}">
                <x-adminlte-select2 name="week[{{ $i }}][class_time]" id="select-week-{{ $i }}" fgroup-class="m-0"  enable-old-support > 
                    <option value=""></option>
                    @for($i=7;$i<=20;$i++)
                    <x-adminlte-options :options="[sprintf('%02d', $i).':00:00' =>  sprintf('%02d', $i) .':00:00']" :selected="$registration->getWeekClassByWeekday($week['weekday'], 'class_time')"  />
                    @endfor
                </x-adminlte-select2>
            </td>
            @endforeach
        </tr>

        <tr>
            <td class="table-active"><strong>Professor</strong></td>
            @foreach($weeks as $i => $week)
            <td>
                <x-adminlte-select2 name="week[{{ $i }}][instructor_id]" id="select-instructor-{{ $i }}" fgroup-class="m-0"  enable-old-support> 
                    <option value=""></option>
                    @foreach($instructors as $instructor)
                    <x-adminlte-options :options="[$instructor->id => $instructor->user->name]" :selected="$registration->getWeekClassByWeekday($week['weekday'], 'instructor_id')"  />
                    @endforeach
                </x-adminlte-select2>
            </td>
            @endforeach
        </tr>

    </thead>

</table>

@if($errors->has('week'))
    <p class="text-danger"><strong>{{ $errors->first('week') }}</strong></p>
@endif

<hr>



<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
<x-package-button-link label="Voltar" theme="light"  url="{{ route('registration.index') }}" icon="fas fa-chevron-left" />

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
