@extends('frontend_master')

@section('content')
<table cellpadding="0" cellspacing="0" border="0" width="100percent">
	<tr>
		<td width="450" valign="top">
			<p>Title: {{$image->title}}</p>
			{{HTML::image(Config::get('Image.thumb_folder').'/'.$image->image)}}
		</td>
        <td valign="top">
        	<p>Direct Image URL</p>
        	<input onclick="this.select()" type="text" width="100percent" value="{{URL::to(Config::get('Image.upload_folder').'/'.$image->image)}}" />
         	<p>Thumbnail Forum BBCode</p>
         	<input onclick="this.select()" type="text" width="100percent" value="[url={{URL::to('snatch/'.$image->id)}}][img]{{URL::to(Config::get('Image.thumb_folder').'/'.$image->image)}}[/img][/url]" />
         	<p>Thumbnail HTML Code</p>
         	<input onclick="this.select()" type="text" width="100percent" value="{{HTML::entities(HTML::link(URL::to('snatch/'.$image->id),HTML::image(Config::get('Image.thumb_folder').'/'.$image->image)))}}" />
		</td>
	</tr>
</table>
@stop