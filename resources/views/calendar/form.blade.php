<div class="row">

    @csrf

    <x-adminlte-input name="name" label="Nome do Plano" fgroup-class="col-12 col-lg-4 col-md-3 col-sm-6" enable-old-support value="{{ $plan->name }}" />
    <x-adminlte-input name="duration" label="Duração" fgroup-class="col-9 col-lg-4 col-md-6 col-sm-12" enable-old-support value="{{ $plan->duration }}"  />
    <x-adminlte-input name="class_per_week" label="Aulas por Semana" fgroup-class="col-9 col-lg-4 col-md-6 col-sm-12" enable-old-support value="{{ $plan->class_per_week }}"  />
    <x-adminlte-input name="value" label="Valor" fgroup-class="col-3 col-lg-4 col-md-6 col-sm-12" enable-old-support value="{{ $plan->value }}"  />

</div>