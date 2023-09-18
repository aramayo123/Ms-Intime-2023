<script>
    localStorage.removeItem("carrito");
    var carrito = []
    window.location.assign('{{ url('/shop')}}');
</script>