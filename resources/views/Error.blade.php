@include('layouts.header')
@php
echo '<script>

swal({title: "'.$ErrorData['title'].'",text: "'.$ErrorData['text'].'",type: "'.$ErrorData['Type'].'"}, 

function() {window.location="/'.$ErrorData['location'].'";});
        
</script>';
@endphp