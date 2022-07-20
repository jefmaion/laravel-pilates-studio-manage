<div class="row mb-2">
    <div class="col-sm-6">
        <div class="m-0 ">
            <span class="h1 font-weight-light">
            <i class="{{ $icon }}"></i>

            {{ $title }}

            </span>
        </div>
    </div>
    <div class="col-sm-6">
        @if($breadcrumb)
        <ol class="breadcrumb float-sm-right">

            {{$slot}}
        </ol>
        @endif
    </div>
</div>