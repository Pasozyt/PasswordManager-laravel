{{-- @props([
  // 'action', 'method',
  // 'button-class', 'button-title',
  // 'message', 'icon',
  // 'confirm-text', 'confirm-class',
  // 'cancel-text', 'cancel-class'  
]) --}}
<form method="POST" action="{{ $attributes->get('action') }}" name="confirm-action"
  data-confirm-text="{{ $attributes->get('confirm-text') }}" data-confirm-class="{{ $attributes->get('confirm-class') }}"
  data-cancel-text="{{ $attributes->get('cancel-text') }}" data-cancel-class="{{ $attributes->get('cancel-class') }}"
  data-message="{{ $attributes->get('message') }}"
  data-icon="{{ $attributes->get('icon') }}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <input type="hidden" name="_method" value="{{ $attributes->get('method') }}">      
  <button type="submit" class="{{ $attributes->get('button-class') }}"
    data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $attributes->get('button-title') }}" 
    >{!! $slot !!}</button>
</form>    
