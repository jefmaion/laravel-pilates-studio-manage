<h4 class="mb-2">
    <b>{{ $event->student->user->name }}</b>
</h4>

<div class="text-muted">
    <i class="fa fa-phone" aria-hidden="true"></i>
    {{ $event->student->user->phone }}
</div>

<div class="text-muted">
    <i class="fas fa-clock    "></i>
    {{ $event->time }} 
</div>




{{-- <span class="badge badge-pill badge-warning">Matrícula vence hoje</span> --}}

<div class="text-muted">
    
    <div class="text-muted">
        <i class="fas fa-user-ninja    "></i>
        {{ $event->instructor->user->name }}
    </div>
</div>

<hr>

<strong>Últimos Aparelhhos Utilizados</strong>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus voluptatibus expedita cum eius exercitationem, itaque dolorum cumque eos praesentium porro sint illo nulla officiis maxime accusamus dicta iste deleniti blanditiis?</p>
<strong>Ultimo relatório</strong>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde officia eius perferendis repellat harum. Tempora velit, laudantium aut odio fugit ut, officia modi exercitationem facilis quidem excepturi iusto est amet!</p>