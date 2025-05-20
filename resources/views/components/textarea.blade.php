<div>
   @props(['label'])

<div class="mb-3">
<div class="card-header">    <label class="card-title">{{ $label }}</label></div>



  <textarea {{ $attributes->merge(['class' => 'form-control', 'rows'=>'8']) }}></textarea>




</div>

</div>
