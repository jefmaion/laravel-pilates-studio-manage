<div class="row">

    @csrf




    <x-adminlte-select2 name="student_id" id="student_id" label="Aluno" fgroup-class="col-12 col-lg-12 col-md-3 col-sm-6" empty-option="Select an option..." > 
        <option value=""></option>
        @foreach($students as $student)
        <x-adminlte-options :options="[$student->id => $student->user->name]" :selected="$registration->student_id"  />
        @endforeach
    </x-adminlte-select2>


    <x-adminlte-input name="date_start" label="Data da Matrícula" type="date"  fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $registration->date_start ??  date('Y-m-d') }}"  />
    <x-adminlte-input name="expiration_day" label="Dia de Vencto." fgroup-class="col-9 col-lg-1 col-md-6 col-sm-12" enable-old-support value="{{ $registration->expiration_day }}"  />


    <x-adminlte-select2 name="plan_id" id="plan_id" label="Plano" fgroup-class="col-12 col-lg-3 col-md-3 col-sm-6" onchange="getValueFromPlan(this)" empty-option="Select an option..." > 
        <option value=""></option>
        @foreach($plans as $plan)

        <option value="{{ $plan->id }}" data-value="{{ $plan->value }}" {{ ($plan->id == $registration->plan_id) ? 'selected' : '' }}>{{ $plan->name . ' ('.$plan->value.')' }}</option>
        
        @endforeach
    </x-adminlte-select2>

    <x-adminlte-input name="value" label="Valor" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $registration->value }}" />
    <x-adminlte-input name="discount" label="Desconto" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" onkeyup="getValueDiscount(this.value)" value="{{ $registration->discount }}" enable-old-support  />
    <x-adminlte-input name="final_value" label="Valor Final" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $registration->final_value }}" />
    {{-- <x-adminlte-input name="duration" label="Duração" fgroup-class="col-9 col-lg-4 col-md-6 col-sm-12" enable-old-support value=""  />
    <x-adminlte-input name="value" label="Valor" fgroup-class="col-3 col-lg-4 col-md-6 col-sm-12" enable-old-support value=""  /> --}}


    <div class="col-12 text-muted mst-3">
        <strong>Aulas</strong>
        <hr class="mt-0">
    </div>

    <div class="col-12">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Segunda-Feira</th>
                    <th>Terça-Feira</th>
                    <th>Quarta-Feira</th>
                    <th>Quinta-Feira</th>
                    <th>Sexta-Feira</th>
                    <th>Sábado</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    @for($i=1;$i<=6;$i++)
                    <td>
                        <x-adminlte-select2 name="time_class[{{ $i }}]" id="time-class-{{ $i }}" empty-option="Select an option..." > 
                            <option value=""></option>
                            @for($j=7;$j<=20;$j++)
                            <x-adminlte-options :options="[$j.':00:00' => $j.':00:00']"   />
                            @endfor
                        </x-adminlte-select2>
    
                        <x-adminlte-select2 name="instructor_id[{{ $i }}]" id="instructor_id_{{ $i }}" empty-option="Select an option..." > 
                            <option value=""></option>
                            @foreach($instructors as $instructor)
                            <x-adminlte-options :options="[$instructor->id => $instructor->user->name]"   />
                            @endforeach
                        </x-adminlte-select2>
                    
                    </td>
                    @endfor
                </tr>
    
              
               
            </tbody>
        </table>
    
    </div>

</div>

@section('plugins.Select2', true)

@section('js')
    <script>

        function getValueFromPlan(obj) {
            value = $('option:selected', obj).data('value');
            $('input[name="value"]').val(value)


            calculateDiscount(value, $('input[name="discount"]').val());
        }
        function getValueDiscount(discount) {
            calculateDiscount($('input[name="value"]').val(), discount)
        }

        function calculateDiscount(value, discount) {

            if(discount == '' || discount == 0) {
                final = value
            } else {
                final = value - (value * (discount / 100));
            }

            


            $('input[name="final_value"]').val(final)
            

        }

    </script>
@stop
