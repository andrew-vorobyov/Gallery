<div class="col-lg-6 col-lg-offset-3">

    <div class="panel panel-primary">
        <div class="panel-heading">
            Add Photo
        </div>
        <div class="panel-body">
            <form enctype="multipart/form-data" method="POST" action="">
                <div class="form-group">
                    <label>Photo</label>
                    <input type="file" class="form-control" name="photo" />
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary form-control" />
                </div>

                <p class="text-center">
                    <a href="/user/michael">Back to Gallery</a>
                </p>
            </form>
        </div>
    </div>
</div>