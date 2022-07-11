<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="display-1 m-0 ">

            <i class="{{ $icon }}"></i>

            {{ $title }}
        </h1>
    </div>
    <div class="col-sm-6">
        @if($breadcrumb)
        <ol class="breadcrumb float-sm-right">

            {{$slot}}
        </ol>
        @endif
    </div>
</div>