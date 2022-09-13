<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div class="toast-container">
    @if (session('success'))
      @if(is_array(session('success')))
        @foreach (session('success') as $message)
          <x-toast class="mb-4" type="success">
            {{ $message }}
          </x-toast>
        @endforeach
      @else
        <x-toast class="mb-4" type="success">
          {{ session('success') }}
        </x-toast>
      @endif
    @endif
    @if (session('warning'))
      @if(is_array(session('warning')))
        @foreach (session('warning') as $message)
          <x-toast class="mb-4" type="warning">
            {{ $message }}
          </x-toast>
        @endforeach
      @else
        <x-toast class="mb-4" type="warning">
          {{ session('warning') }}
        </x-toast>
      @endif
    @endif   
    @if (session('danger'))
      @if(is_array(session('danger')))
        @foreach (session('danger') as $message)
          <x-toast class="mb-4" type="danger">
            {{ $message }}
          </x-toast>
        @endforeach
      @else
        <x-toast class="mb-4" type="danger">
          {{ session('danger') }}
        </x-toast>
      @endif
    @endif   
  </div>
</div>