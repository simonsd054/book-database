@extends('layouts.app')

@section('content')
    <div class="container">
        <edit-book csrf="{{ csrf_token() }}" :authors="{{ $authors }}" :genres="{{ $genres }}" :book="{{ $book }}" :publishers="{{ $publishers }}" :prevpublisher="{{ $prevPublisher }}"></edit-book>
    </div>
@endsection
<script>
    import EditBoook from "../../js/components/EditBoook";
    export default {
        components: {EditBoook}
    }
</script>