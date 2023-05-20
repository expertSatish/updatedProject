<table class="table">
    <tbody>
        <tr>
            <th>Date:</th>
            <td>{{datetimeformat($lists->created_at)}}</td>
        </tr>
        <tr>
            <th>Job:</th>
            <td>
                @if(!empty($lists->jobs))
                <a href="{{url('career/'.$lists->jobs->alias)}}" target="_blank">
                    {{$lists->jobs->title ?? ''}}
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
            <th>User Phone:</th>
            <td> {{$lists->phone}} </td>
        </tr>
        <tr>
            <th>Message:</th>
            <td> {{$lists->message}} </td>
        </tr>
        <tr>
            <th>Experience:</th>
            <td> {{$lists->experience}} </td>
        </tr>
        @if(!empty($lists->resume) && file_exists(public_path('uploads/resume/'.$lists->resume)))                                
        <tr>
            <th>Resume:</th>
            <td> 
                <a href="{{asset('uploads/resume/'.$lists->resume)}}" download>
                    <i class="fa fa-download ms-1"></i> download
                </a>
            </td>
        </tr>
        @endif
        
    </tbody>
</table>