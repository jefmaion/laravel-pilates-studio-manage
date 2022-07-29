

{{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button> --}}
{{-- <p class="mb-3 text-muted">
    <i class="fas fa-circle  mr-2 text-success  "></i>  {{ $event->class_type }} - {{ $event->classStatus }} 
</p> --}}


<h3 class="mb-2 font-weighst-light text-dark">
     <strong>{{ $event->student->user->name }}</strong>  
     
</h3>

<p class="text-muted m-0">

     <i class="fa fa-calendar" aria-hidden="true"></i> 
     {{ $event->extenseDate }} <span class="mx-2">|</span>

     <i class="fas fa-clock"></i> {{ $event->time }} 
     <span class="mx-2">|</span> 

     <i class="fas fa-user-ninja  mr-2 "></i> 
     {{ $event->instructorReal->user->name }}

     @if(!$event->IsMainInstructor)
        <i class="text-purple fas fa-exchange-alt    "></i>
     @endif
</p>


<div class="mt-2">

    <h5>
        
        <span class="badge badge-pill mb-3 bg-{{ $event->classStatusColor }} ">{{ $event->classStatus }} </span>

        @if($event->student->hasDebit->count())
            <span class="badge badge-pill badge-white border border-danger text-danger h2"> <i class="fas fa-exclamation-circle    "></i> Mensalidade em Atraso  </span>
        @endif

        @if($event->classParent)
            <a href="#" data-dismiss="modal" onclick="showEvent({{ $event->class_parent_id }})" class="badge badge-pill bg-warning-600"><i class="fas fa-exclamation-circle    "></i> Reposição do dia   {{ $event->classParent->dateFormated }}</a>
        @endif

    </h5>

</div>



<hr class="m-0">

