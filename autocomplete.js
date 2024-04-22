$('#search').autocomplete({ 
    source: function(request, response){
        $.ajax({
            url: "{{route('search.subastas')}}",
            dataType: 'json',
            data: {
                term: request.term
            },
            success: function(data){
                response(data)
            }
        });
    },
    select: function(event, ui) {
        window.location.href = "{{ route('subastas.show', '') }}/" + ui.item.slug;
    }
});