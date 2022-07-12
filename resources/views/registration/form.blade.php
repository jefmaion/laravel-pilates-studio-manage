<div class="row">

    @csrf




    <x-adminlte-select2 name="registration[student_id]" id="student_id" label="Aluno" fgroup-class="col-12 col-lg-12 col-md-3 col-sm-6" empty-option="Select an option..." > 
        <option value=""></option>
        @foreach($students as $student)
        <x-adminlte-options :options="[$student->id => $student->user->name]" :selected="$registration->student_id"  />
        @endforeach
    </x-adminlte-select2>


    <x-adminlte-input name="registration[date_start]" label="Data da Matrícula" type="date"  fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $registration->date_start ??  date('Y-m-d') }}"  />
    <x-adminlte-input name="registration[expiration_day]" label="Dia de Vencto." fgroup-class="col-9 col-lg-1 col-md-6 col-sm-12" enable-old-support value="{{ $registration->expiration_day }}"  />


    <x-adminlte-select2 name="registration[plan_id]" id="plan_id" label="Plano" fgroup-class="col-12 col-lg-3 col-md-3 col-sm-6" onchange="getValueFromPlan(this)" empty-option="Select an option..." > 
        <option value=""></option>
        @foreach($plans as $plan)

        <option value="{{ $plan->id }}" data-value="{{ $plan->value }}" {{ ($plan->id == $registration->plan_id) ? 'selected' : '' }}>{{ $plan->name . ' ('.$plan->value.')' }}</option>
        
        @endforeach
    </x-adminlte-select2>

    <x-adminlte-select2 name="registration[payment_type_id]" id="payment_id" label="Forma" fgroup-class="col-12 col-lg-3 col-md-3 col-sm-6" empty-option="Select an option..." > 
        <option value=""></option>
        @foreach($paymentMethods as $paymentMethod)

        <option value="{{ $paymentMethod->id }}" {{ ($paymentMethod->id == $registration->payment_method_id) ? 'selected' : '' }}>{{ $paymentMethod->name }}</option>
        
        @endforeach
    </x-adminlte-select2>

    <x-adminlte-input name="registration[value]" id="value" label="Valor" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $registration->value }}" />
    <x-adminlte-input name="registration[discount]" id="discount" label="Desconto" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" onkeyup="getValueDiscount(this.value)" value="{{ $registration->discount }}" enable-old-support  />
    <x-adminlte-input name="registration[final_value]" id="final_value" label="Valor Final" fgroup-class="col-12 col-lg-2 col-md-3 col-sm-6" enable-old-support value="{{ $registration->final_value }}" />



    <div class="col-12 text-muted mst-3">
        <strong>Aulas</strong>
        <hr class="mt-0">
    </div>

    <div class="col-12">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input check-weekday" name="" id="" value="2">
                            Segunda-Feira
                          </label>
                        </div>
                        
                    </th>
                    <th>
                        Terça-Feira
                    </th>
                    <th>
                        Quarta-Feira
                    </th>
                    <th>
                        Quinta-Feira
                    </th>
                    <th>
                        Sexta-Feira
                    </th>
                    <th>
                        Sábado
                    </th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    @for($i=2;$i<=7;$i++)
                    <td>

                        <input type="hidden" class="" name="weekclass[{{ $i }}][class_weekday]" value="{{ $i }}">

                        <x-adminlte-select2  name="weekclass[{{ $i }}][class_time]" id="time-class-{{ $i }}" empty-option="Select an option..." > 
                            <option value=""></option>
                            @for($j=7;$j<=20;$j++)
                            <x-adminlte-options :options="[$j.':00:00' => $j.':00:00']"   />
                            @endfor
                        </x-adminlte-select2>
    
                        <x-adminlte-select2 name="weekclass[{{ $i }}][instructor_id]" id="instructor_id_{{ $i }}" empty-option="Select an option..." > 
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

        $('.check-weekday').click(function (e) { 
           val = $(this).val();

           $('select[name="weekclass['+val+'][class_time]"]').prop('disabled', true);
            console.log()
        });

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
