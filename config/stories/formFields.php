<div class="form-row">
    <div class="col-md-6 mb-4">
        <label for="validationCustom01">Story Name</label>
        <input value="<?php print Whiz::h($story->name) ?>" name="story[name]" type="text" class="form-control" id="validationCustom01"  required>
        <div class="invalid-feedback">
            Please enter a full name!
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <label for="validationCustom01">Story Genre</label>
        <input value="<?php print Whiz::h($story->genre) ?>" name="story[genre]" type="text" class="form-control" id="validationCustom01"  required>
        <div class="invalid-feedback">
            Please enter a genre name!
        </div>
    </div>
</div>
<div class="form-row">
<div class="col-md-6 mb-4">
        <label for="validationCustom01">Story Tags (CSV)</label>
        <input value="<?php print Whiz::h($story->tags) ?>" name="story[tags]" type="text" class="form-control" id="validationCustom01"  required>
        <div class="invalid-feedback">
            Please enter a tag!
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <label for="validationCustom01">About Story</label>
        <input value="<?php print Whiz::h($story->about) ?>" name="story[about]" type="text" class="form-control" id="validationCustom01"  required>
        <div class="invalid-feedback">
            Please tell us about the story!
        </div>
    </div>
</div>

