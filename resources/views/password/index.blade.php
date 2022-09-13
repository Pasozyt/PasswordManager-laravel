<x-app-layout>      
    <div class="container">
      <h1 class="display-6">Hasła</h1>
      <div class="d-flex flex-row-reverse mb-4">
          <a href="{{ route('password.create') }}" type="button" class="btn btn-light" role="button">
            Stwórz hasło
          </a>
      </div> 
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nazwa serwisu</th>
            <th class="col-2">Hasło</th>
            <th>data utworzenia</th>
            <th>data modyfikacji</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($password as $password) 
          <tr>
            <td>{{ $password->id }}</td>
            <td>{{ $password->name }}</td>
            <td id="pass{{$password->id}}">
              ******
            </td>
            <td>{{ $password->created_at }}</td>
            <td>{{ $password->updated_at }}</td>
            <td>
              <div class="btn-group" role="group" aria-label="action buttons">
                <div class="btn btn-secondary showpassword" data-id="{{$password->id}}" id="button{{$password->id}}" data-show="0">
                    <i class="bi bi-eye"></i>
                </div>
                <x-datatables.action-link class="btn btn-primary"
                                          url="{{ route('password.edit', $password) }}" 
                                          title="{{ __('translations.labels.edit') }}">
                    <i class="bi-pencil"></i>
                </x-action-link>
                <x-datatables.action-link class="btn btn-danger"
                                          url="{{ route('password.destroy', $password) }}" 
                                          title="{{ __('translations.labels.destroy') }}">
                                          <i class="bi bi-trash"></i>
                </x-action-link>
              </div>
          </tr>
          @endforeach
        </tbody>
      </table>       
    </div>
    <script>
          $('.showpassword').click(function() {
            var id=$(this).data('id');
            if($(this).data('show')==0){
              $.ajax({
                url: "{{ route('password.show') }}",
                method: "get",
                data: {
                  id: $(this).data('id')
                },
                success: function(data) {
                    var test="#pass"+id;
                    var button="#button" + id;
                    $(test).html(data);
                    $(button).data('show', '1');
                    
                }
              });
            }
            else{
              var button="#button" + id;
              var test="#pass"+id;
              $(test).html("******");
              $(button).data('show', '0');
            }
          });
    </script>
</x-app-layout>
