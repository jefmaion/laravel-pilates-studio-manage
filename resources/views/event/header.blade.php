

{{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button> --}}
{{-- <p class="mb-3 text-muted">
    <i class="fas fa-circle  mr-2 text-success  "></i>  {{ $event->class_type }} - {{ $event->classStatus }} 
</p> --}}


<h3 class="mb-2 font-weighst-light text-dark">
     <strong>{{ $event->student->user->name }}</strong>  
     <small>
        <span class="float-right badge badge-pill bg-{{ $event->classStatusColor }} ">{{ $event->classStatus }} </span>
     </small>
</h3>




<p class="text-muted m-0">
     <i class="fa fa-calendar" aria-hidden="true"></i> {{ $event->extenseDate }} <span class="mx-2">|</span>
     <i class="fas fa-clock    "></i> {{ $event->time }} <span class="mx-2">|</span> 
     <i class="fas fa-user-ninja  mr-2 "></i> {{ $event->instructorReal->user->name }}
     @if(!$event->IsMainInstructor)
        <i class="text-purple fas fa-exchange-alt    "></i>
     @endif
     


    {{-- <p class="text-muted m-0"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $event->extenseDate }} </p>
    <p class="text-muted m-0"><i class="fas fa-clock    "></i> {{ $event->time }} </p>
    <p class="text-muted m-0"><i class="fas fa-user-ninja  mr-2 "></i>{{ $event->instructor->user->name }} </p>
    {{ $event->classStatus }} --}}

</p>



<div class="mt-2">
    @if($event->student->hasDebit->count())
        <span class="badge badge-pill badge-white border border-danger text-danger h2"> <i class="fas fa-exclamation-circle    "></i> Mensalidade em Atraso  </span>
    @endif

    @if($event->classParent)
     <h5><a href="#" onclick="showEvent({{ $event->class_parent_id }})" class="badge badge-pill bg-purple"><i class="fas fa-exclamation-circle    "></i> Reposição do dia   {{ $event->classParent->dateFormated }}</a></h5>
    @endif

    {{-- <span class="badge badge-pill badge-light border border-warning text-warning h2"><i class="fas fa-exclamation-circle    "></i> Renovação Pendente</span> --}}
</div>
{{-- 
@if($event->classParent)
<div class="p-2 mt-2 bg-light border border-light">
    <p class="m-0">Reposição do dia  <a href="#" onclick="showEvent({{ $event->class_parent_id }})">{{ $event->classParent->dateFormated }}</a></p>
</div>
@endif --}}



<hr>

