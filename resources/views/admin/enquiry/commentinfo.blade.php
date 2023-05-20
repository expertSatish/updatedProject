<table class="table">
    <tbody>
        <tr>
            <th>Date:</th>
            <td>{{datetimeformat($lists->created_at)}}</td>
        </tr>
        <tr>
            <th>Blog:</th>
            <td>
                @if(!empty($lists->blog))
                <a href="{{url('blog/'.$lists->blog->alias)}}" target="_blank">
                    {{$lists->blog->title ?? ''}}
                </a>
                @endif
            </td>
        </tr>
        <tr>
            <th>User Name:</th>
            <td> {{$lists->name}} </td>
        </tr>
        <tr>
            <th>User Email:</th>
            <td> {{$lists->email}} </td>
        </tr>
        <tr>
            <th>Message:</th>
            <td> {{$lists->message}} </td>
        </tr>
        <tr>
            <th>Sequence:</th>
            <td> {{$lists->sequence}} Position</td>
        </tr>
        <tr>
            <th>Is Publish</th>
            <td>
                @if($lists->is_publish==1) <span class="text-success">Yes</span> @endif
                @if($lists->is_publish==0) <span class="text-danger">No</span> @endif
            </td>
        </tr>
    </tbody>
</table>