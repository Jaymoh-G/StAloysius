<div>
   @props(['label'])

<div class="mb-3">
    <label class="card-title">{{ $label }}</label>
    <input {{ $attributes->merge(['class' => 'form-control input-default ']) }} />
</div>

</div>
