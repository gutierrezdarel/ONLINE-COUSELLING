 <!-- Delete Category Modal-->
 <div class="modal fade" id="delete-category" tabindex="-1" role="dialog" aria-labelledby="deletePost" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="{{route('manage.services.destroy')}}" method="post" id="deleteCategory">
          @csrf
          @method('DELETE')
          <input type="hidden" id="category_id" name="type_id">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Disable User Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this category?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>
</div>