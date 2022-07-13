<div class="btn-group">

    <a class="text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bars"></i>
    </a>

    <div class="dropdown-menu">

        <h6 class="dropdown-header text-left">Ações</h6>

        <a class="dropdown-item" href="{{ $urlEdit }}">
            <i class="fas fa-edit"></i>
            Editar
        </a>

        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalMin{{ $dataId }}">
            <i class="fas fa-trash-alt"></i>
            Excluir
        </a>


        @if(isset($others))

            @foreach($others as $key => $other)

                @if($key == 'divider')
                <div class="dropdown-divider"></div>
                @endif

                @if(isset($other['header']))
                <h6 class="dropdown-header text-left">{{ $other['header'] }}</h6>
                @endif

                <a class="dropdown-item" href="{{ $other['url'] }}">
                    <i class="{{ $other['icon']}}"></i>
                    {{ $other['label'] }}
                </a>

            @endforeach
        @endif

      {{-- <a class="dropdown-item" href="#">Something else here</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Separated link</a> --}}
    </div>


    <x-adminlte-modal id="modalMin{{ $dataId }}" v-centered title="Excluir" icon="fas fa-trash" theme="danger">
        Deseja excluir esse registro?
        <x-slot name="footerSlot">
            <form action="{{ $urlDelete }}" method="post">
                @csrf
                @method('DELETE')
                <x-adminlte-button type="submit" icon="fa fa-trash" theme="danger" label="Excluir"/>
            </form>

            <x-adminlte-button theme="light" icon="fa fa-times"  label="Fechar" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-modal>
  </div>