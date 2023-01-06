<table class="table">
    <thead>
        <tr>
            <th>Date Added</th>
            <th>Job Title</th>
            <th>Employer</th>
            <th>Location</th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $item)
            <tr class="job-search-link" id="job_{{$item->id}}">
                <td>{{$item->created_at}}</td>
                <td>{{$item->job_title}}</td>
                <td>{{$item->company}}</td>
                <td>{{$item->location}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
