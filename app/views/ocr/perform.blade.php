@extends('layouts.master')

@section('master.content')
    <img src="images/ocrtemp/test2.jpg" alt="image" />
    <!-- {{ Session::get('text') }} -->     
    <textarea style="color:black"	 rows="4" cols="50">
    <?php echo $text; ?>	
    </textarea> 
    	
	@stop