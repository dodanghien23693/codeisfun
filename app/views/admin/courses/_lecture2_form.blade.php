<li class="dd-item" data-id="{{ $chapter->id }}" >
    <div class="dd-handle">
        <span>.</span>
        <span>.</span>
        <span>.</span>
    </div>
    <div class="dd-content">

        <?php $lectures = $chapter->lectures(); ?>
        <div id='lecture-form' class="panel panel-primary" data-collapsed="1">

            <div class="panel-heading">
                <div class="panel-title">
                    {{$chapter->name}}
                </div>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                </div>
            </div>

            <div class="panel-body">

                <form id='create-lecture-form' class="form-inline" method="POST" action=''>
                    <label class="col-sm-3">New lecture</label>
                    <input id="lecture-name" name='lecture-name' type='text' class="col-sm-4" placeholder="name" class="form-control" />
                    <div  id="create-lecture-btn" class="btn btn-info" chapter-id="<?php echo $chapter->id; ?>">Create new chapter</div>
                </form>

                <div id="list-lecture" class="nested-list dd with-margins custom-drag-button"><!-- adding class "with-margins" will separate list items -->			
                    <ul class="dd-list">       
                        @foreach($lectures as $lecture)

                        <li class="dd-item" data-id="{{ $lecture->id }}" >
                            <div class="dd-handle">
                                <span>.</span>
                                <span>.</span>
                                <span>.</span>
                            </div>
                            <div class="dd-content">
                                {{ $lecture->name }}
                            </div>
                        </li>

                        @endforeach

                    </ul>
                    <div id="update-order-lecture" class="btn btn-info">Update order of chapter</div>

                </div>
            </div>
        </div>


    </div>
</li>

