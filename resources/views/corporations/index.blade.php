<p>会社一覧</p>
<hr>
<table>
	<tr>
		<td>ID</td>
		<td>名前</td>
		<td>サイトURL</td>
		<td>サポートTel</td>
		<td>サポートメール</td>
	</tr>
@foreach($corporations as $corporation)
    <tr>
        <td>{{ $corporation->id }}</td>
        <td>{{ $corporation->name }}</td>
        <td>{{ $corporation->corporation_site_url }}</td>
        <td>{{ $corporation->support_tel1 }}-{{ $corporation->support_tel2 }}-{{ $corporation->support_tel3 }}</td>
        <td>{{ $corporation->support_email }}</td>
    </tr>
@endforeach
</table>