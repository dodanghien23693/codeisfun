

<form id='category-form-modal' class="form-horizontal" role="form">
             <input type="hidden" value="{{$category->id}}" name="id" class="form-control">
            <div class="form-group form-horizontal">
                <label for="name" class="control-label col-sm-4">Name</label>
                <div class="col-sm-8">
                    <input class="form-control" name="name" id="name" value="{{$category->name}}">
                </div>
            </div>    
            
             <div class="form-group form-horizontal">
                <label for="slug" class="control-label col-sm-4">Slug</label>
                <div class="col-sm-8">
                    <input class="form-control" name="slug" id="slug" value="{{$category->slug}}">
                </div>
            </div>    
            
             <div class="form-group form-horizontal">
                <label for="description" class="control-label col-sm-4">Description</label>
                <div class="col-sm-8">
                    <input class="form-control" name="description" id="description" value="{{$category->description}}">
                </div>
            </div>    
</form>