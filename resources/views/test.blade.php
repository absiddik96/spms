<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>sdfds</title>
    </head>
    <body>
        {{Form::open(['route'=>'test.store','method'=>'post','class'=>'form-horizontal','files'=>true])}}
            @include('includes.errors')

            <div class="form-group">
                <label class="col-sm-3 control-label">Image</label>
                <div class="col-sm-6">
                    <input type="file" name="avatar" value="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-6">
                    <div class="pull-right">
                        {{Form::submit('Save',['class'=>'btn btn-success'])}}
                    </div>
                </div>
            </div>

        {{Form::close()}}

        <img src="{{asset('storage/1515749897.jpg')}}" alt="ddd">
    </body>
</html>
