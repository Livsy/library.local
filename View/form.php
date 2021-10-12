<!-- Форма -->
<div class="row">
    <div class="col-md-6">

        <div class="alert alert-success" role="alert">
            <? $p = &$_SESSION['post']?>

            <form class="row g-3" method="POST" action="/" enctype="multipart/form-data">
                <div class="col-md-12">
                    <label for="inputName4" class="form-label">Title*</label>
                    <input type="name" class="form-control" value="<?=$p['title'] ?? ''?>" name="title" id="inputName4">
                    <small id="nameHelpBlock" class="form-text text-danger">
                        <?=$_SESSION['message']['title'] ?? ''?>
                    </small>
                </div>

                <div class="col-md-12">
                    <label for="authorName4" class="form-label">Author*</label>
                    <input type="name" class="form-control" value="<?=$p['author'] ?? ''?>" name="author" id="authorName4">
                    <small id="nameHelpBlock" class="form-text text-danger">
                        <?=$_SESSION['message']['author'] ?? ''?>
                    </small>
                </div>

                <div class="col-12">
                    <label for="Textarea1" class="form-label">Description*</label>
                    <textarea class="form-control" name="description" rows="3"><?=$p['description'] ?? ''?></textarea>
                    <small id="msgHelpBlock" class="form-text text-danger">
                        <?=$_SESSION['message']['description'] ?? ''?>
                    </small>
                </div>

                <div class="col-12">
                    <label for="formFile" class="form-label">File</label>
                    <input class="form-control" type="file" name="file" id="formFile">
                    <small id="msgHelpBlock" class="form-text text-danger">
                        <?=$_SESSION['message']['file'] ?? ''?>
                    </small>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Форма -->
