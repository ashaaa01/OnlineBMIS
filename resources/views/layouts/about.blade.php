
@include('welcome')

    <div class="breadcrumb" style="position: inline;">
        <h3>Welcome to About Page</h3>
    </div>
          <p style="font-size: 50px";><center>Pajo is a barangay in the municipality of Alfonso, in the province of Cavite. Its population as determined by the 2015 Census was 2,013. This represented 3.88% of the total population of Alfonso.</center></p>
    </div>
    
    </body>
    
    <script type="text/javascript">
      $(function() {
          $("#table").dataTable({
             "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
          });
      });
    </script>
    </html>