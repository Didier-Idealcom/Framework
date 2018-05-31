@extends('admin.layout')

@section('content')
<!--Begin::Main Portlet-->
<div class="row">
    <div class="col-md-12">
    	<ul>
		<?php foreach ($modules as $module): ?>
		<li><?php echo $module->name; ?></li>
		<?php endforeach; ?>
    	</ul>
    </div>
</div>
<!--End::Main Portlet-->
@endsection
