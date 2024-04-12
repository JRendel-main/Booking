<!--JS RESOURCE-->
<script>
document.getElementById('start_date').addEventListener('input', function() {
    var startDate = this.value;
    document.getElementById('end_date').min = startDate;
});
</script>
<script src="main.js"></script>




</body>

</html>