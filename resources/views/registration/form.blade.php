
@if(!isset($registration->id))
    <form action="{{ route('registration.store') }}" method="post">
@else
<form action="{{ route('registration.update', $registration) }}" method="post">
    @method('PUT')
@endif

<div class="row">

    <div class="col-7">


        <div class="row">
            @csrf
        
            <input type="hidden" name="status" value="A">
        
            <x-adminlte-select2 name="student_id" id="student_id" label="Aluno" fgroup-class="col-12 col-lg-10 col-md-3 col-sm-6" enable-old-support> 
                <option value=""></option>
                @foreach($students as $student)
                <x-adminlte-options :options="[$student->id => $student->user->name]" :selected="$registration->student_id"  />
                @endforeach
            </x-adminlte-select2>

            <x-adminlte-input name="class_per_week" id="fsinal_value" label="Aulas por semana" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $registration->class_per_week }}" />

        
            <x-adminlte-input name="date_start" label="Data da Matrícula" type="date"  fgroup-class="col-12 col-lg-3 col-md-3 col-sm-6" enable-old-support value="{{ $registration->date_start ??  date('Y-m-d') }}"  />
        
            <x-adminlte-select2 name="plan_id" id="plan_id" label="Plano" fgroup-class="col-12 col-lg-4 col-md-3 col-sm-6" onchange="getValueFromPlan(this)" enable-old-support> 
                <option value=""></option>
                @foreach($plans as $plan)
                <option value="{{ $plan->id }}" data-value="{{ $plan->value }}" {{ ($plan->id == $registration->plan_id) ? 'selected' : '' }}>{{ $plan->name . ' ('.$plan->value.')' }}</option>
                @endforeach
            </x-adminlte-select2>
            
            <x-adminlte-input name="value" id="value" label="Valor" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $registration->value }}" />
            <input type="hidden" name="status" value="A">
        
            <x-adminlte-input name="discount" id="discount" label="Desconto" fgroup-class="col-12 col-lg-1 col-md-3 col-sm-6" onkeyup="getValueDiscount(this.value)" value="{{ $registration->discount }}" enable-old-support  />
                <x-adminlte-input name="final_value" id="final_value" label="Valor Final" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $registration->final_value }}" />
                
                {{-- <x-adminlte-select2 name="payment_type_id" id="payment_id" label="Forma" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support> 
                <option value=""></option>
                @foreach($paymentMethods as $paymentMethod)
                <option value="{{ $paymentMethod->id }}" {{ ($paymentMethod->id == $registration->payment_method_id) ? 'selected' : '' }}>{{ $paymentMethod->name }}</option>
                @endforeach
            </x-adminlte-select2> --}}
        
        
        </div>

    </div>

    <div class="col-5">
        <x-adminlte-textarea name="comments" rows="5" label="Observações" fgroup-class="col-12  col-lg-12 col-sm-6" enable-old-support>{{ $registration->comments }}</x-adminlte-textarea>

    </div>
</div>



<p class="text-muted"><strong>Aulas na Semana</strong></p>
<hr>
{{-- 
<table class="table table-sstriped table-sm">
    <thead class="thead-light">
        <tr>
            <th>Semana</th>
            <th>Horario</th>
            <th>Instrutor</th>
        </tr>
    </thead>
    <tbody>
        @foreach($weeks as $week)
        <tr>
            <td scope="row" class="bg-light">{{ $week['week'] }}</td>
            <td>
                <x-adminlte-select2 name="student_id" id="student_id"  enable-old-support> 
                    <option value=""></option>
                    @foreach($students as $student)
                    <x-adminlte-options :options="[$student->id => $student->user->name]" :selected="$registration->student_id"  />
                    @endforeach
                </x-adminlte-select2>
            </td>
            <td>
                <x-adminlte-select2 name="student_id" id="student_id" class="m-0" fgroup-class="col-12 col-lg-12 col-md-3 col-sm-6" enable-old-support> 
                    <option value=""></option>
                    @foreach($instructors as $instructor)
                    <x-adminlte-options :options="[$instructor->id => $instructor->user->name]" :selected="$registration->student_id"  />
                    @endforeach
                </x-adminlte-select2>
            </td>
        </tr>
        @endforeach
    </tbody>
</table> --}}


<table class="table table-sstriped table-sm">
    <thead class="thead-light">
        <tr>
            <th>Semana</th>
            <th>Segunda-Feira</th>
            <th>Terça-Feira</th>
            <th>Quarta-Feira</th>
            <th>Quinta-Feira</th>
            <th>Sexta-Feira</th>
            <th>Sábado</th>
        </tr>
        <tr>
            <td>Horário</td>
            @foreach($weeks as $i => $week)
            <td>
                <input type="hidden" name="week[{{ $week['weekday'] }}][weekday]" value="{{ $week['weekday'] }}">
                <x-adminlte-select2 name="week[{{ $week['weekday'] }}][time]" id="select-week-{{ $i }}" class="m-0"  enable-old-support> 
                    <option value=""></option>
                    @for($i=7;$i<=20;$i++)
                    <x-adminlte-options :options="[$i.':00:00' => $i .':00:00']" :selected="$registration->student_id"  />
                    @endfor
                </x-adminlte-select2>
            </td>
            @endforeach
        </tr>


        <tr>
            <td>Instrutor</td>
            @foreach($weeks as $i => $week)
            <td>
                <x-adminlte-select2 name="week[{{ $week['weekday'] }}][instructor]" id="select-instructor-{{ $i }}" class="m-0"  enable-old-support> 
                    <option value=""></option>
                    @foreach($instructors as $instructor)
                    <x-adminlte-options :options="[$instructor->id => $instructor->user->name]" :selected="$registration->student_id"  />
                    @endforeach
                </x-adminlte-select2>
            </td>
            @endforeach
        </tr>
    </thead>

</table>

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
