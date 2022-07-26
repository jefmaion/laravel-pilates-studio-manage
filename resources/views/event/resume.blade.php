<div class="modal-header bg-purple">
    <h5 class="modal-title" id="my-modal-title">{{ $event->extenseDate }}</h5>
    
    <button class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


<div class="p-3">
    @include('event.header')
  
    {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Comentários</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Última Evolução</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Mensalidades</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            {{ $event->absense_comments }}

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est similique, rem necessitatibus labore assumenda, rerum itaque optio nesciunt totam quia porro perferendis. Assumenda eius amet, tenetur quam consequuntur alias rerum.
    
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit, voluptatum rerum vel a quas reprehenderit libero in nihil, sint at velit saepe nesciunt nobis magnam! Sapiente laboriosam minima sequi cupiditate!
            </p>
            <small>Relatado em <b>12/12/2022</b> por <cite title="Source Title">{{ $event->instructor->user->name }}</cite></small>
         
            
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
    </div> --}}

    <strong>Últimas Anotações</strong>
    <p class="text-muted mb-0"><i>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Est similique, rem necessitatibus labore assumenda, rerum itaque optio nesciunt totam quia porro perferendis. Assumenda eius amet, tenetur quam consequuntur alias rerum.
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit, voluptatum rerum vel a quas reprehenderit libero in nihil, sint at velit saepe nesciunt nobis magnam! Sapiente laboriosam minima sequi cupiditate!
    </i>
    </p>
    <p>Relatado em <b>12/12/2022</b> por <cite title="Source Title">{{ $event->instructor->user->name }}</cite></p>
    

    <hr>

    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
        <div class="col-8 text-right">

            <div class="dropup show">
                <a class="btn bg-purple dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Gerenciar Aula
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                    <a class="dropdown-item" href="#" onClick="setPresence({{ $event->id }})">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        Registrar Presença
                    </a>


                    <a class="dropdown-item" href="#" onClick="setAbsense({{ $event->id }})">
                        <i class="fa fa-user-times" aria-hidden="true"></i>
                        Registrar Falta</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" onClick="rescheduleClass({{ $event->id }})">Reagendar Aula</a>

                </div>
            </div>
        </div>
    </div>


</div>