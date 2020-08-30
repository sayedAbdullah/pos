@if (session('success'))
    <script>
    $(function() {
      toastr.success("{{session('success')}}")
    });

    // new Noty({
    //     type: 'success',
    //     layout: 'topRight',
    //     text: "{{session('success')}}",
    //     timeoute:3000,
    //     killer:true
    // }).show();
    </script>
@endif
