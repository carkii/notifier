<div class="modal fade" id='myModal'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Notification title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">        
        <img width=100% src="{{asset('/images/exampleImage.jpg')}}" alt="#">
        <p>Notification body text goes here.</p>
      </div>
      <div class="modal-footer">
        {!! $acknowledgedButton !!}
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#myModal').modal('show')
</script>
